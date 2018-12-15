<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Event\NotificationsEventListener;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\Utility\Inflector;
use Cake\I18n\Time;

class ForumController extends AppController {

	public $paginate = [
        "ForumThreads" => [
        	"limit" => 16
        ],
        "ForumReplies" => [
        	"limit" => 5
        ]
    ];

	public function initialize() {
		parent::initialize();

		// Autoriser l'accès aux visiteurs
		$this->Auth->allow();

		$this->Auth->deny([
			"createThread",
			"createReply",
			"deleteThread",
			"deleteReply",
			"togglePin"
		]);

		// Models
		$this->loadModel('ForumCategories');
		$this->loadModel('ForumThreads');
		$this->loadModel('ForumThreadsReads');
		$this->loadModel('ForumReplies');

		// Components
		$this->loadComponent('Paginator');
	}

	/**
	* Affiche les catégories des forums et ses statistiques
	*/
	public function index() {
		$this->set("title", __("Forum"));
		$this->set("description", __("Le forum est un lieu d'échanges sur HabboMotel où tu peux dire tout ce que tu veux."));

		$categories = $this->ForumCategories->find()
		->order(["order_num" => "ASC"])
		->all();

		$threads = $this->ForumThreads->find()
		->contain(['Players'])
		->order(["modified" => "DESC"])
		->limit(10);

		$players = $this->Players->find()
		->order(["forum_reply_count" => "DESC"])
		->limit(3);

		$this->set(compact("categories", "threads", "players"));
	}

	/**
	* Affiche les discussions dans une catégorie
	* @param string $slug
	*/
	public function category($slug = null) {
		if(is_null($slug))
			return $this->redirect($this->referer());

		$category = $this->ForumCategories->findBySlug($slug)
		->first();

		if(is_null($category))
			return $this->redirect($this->referer());

		$threads = $this->paginate($this->ForumThreads->find()
			->contain([
				'Players',
				'ForumThreadsReads' => function($q) {
					return $q->where(['ForumThreadsReads.player_id' => $this->Auth->user('id')]);
				}
			])
			->where(["ForumThreads.category_id" => $category->id])
			->order([
				'ForumThreads.has_pin'  => 'DESC',
				'ForumThreads.modified' => 'DESC'
			])
		);

		$this->set("title", $category->name);
		$this->set("description", Text::truncate($category->description, 150));

		$this->set(compact("category", "threads"));
	}

	/**
	* Affiche les réponses dans une discussion
	* @param string $slug
	*/
	public function thread($slug = null) {
		if(is_null($slug))
			return $this->redirect($this->referer());

		$thread = $this->ForumThreads->findBySlug($slug)
		->contain([
			'Players',
			'ForumCategories',
			'ForumThreadsReads' => function($q) {
				return $q->where(['ForumThreadsReads.player_id' => $this->Auth->user('id')]);
			}
		])
		->first();

		if(is_null($thread))
			return $this->redirect($this->referer());

		$replies = $this->paginate($this->ForumReplies->find()
			->contain([
				"Players"
			])
			->where(["ForumReplies.thread_id" => $thread->id])
			->order(["ForumReplies.id" => "ASC"]
		));

		$newReply = $this->ForumReplies->newEntity();

		if(!is_null($this->Auth->user('id'))) {
			if(is_null($thread->forum_threads_read)) {
				$this->ForumThreadsReads->save($this->ForumThreadsReads->newEntity([
					'thread_id' => $thread->id,
					'player_id'	=> $this->Auth->user('id')
				]));
			}
		}

		$this->set("title", $thread->name);
		$this->set("description", Text::truncate($replies->toArray()[0]->reply, 150));
		$this->set(compact("thread", "newReply", "replies"));
	}

	/**
	* Créer une nouvelle discussion
	* @param
	*/
	public function createThread() {
		$canCreateThread = true;

		$lastThread = $this->ForumThreads->findByPlayerId($this->Auth->user("id"))
		->order(["id" => "DESC"])
		->first();

		if(!is_null($lastThread)) {
			$lastTime = new Time($lastThread->created);
			if((time() - $lastTime->i18nFormat(Time::UNIX_TIMESTAMP_FORMAT)) <= 120) {
				$canCreateThread = false;
				$this->Flash->error(__("Tu dois attendre 2 minutes avant de créer une nouvelle discussion."));
			}
		}

		$thread = $this->ForumThreads->newEntity();

		$categories = $this->ForumCategories->find("list")
		->where([
			"min_rank <=" => $this->Auth->user("rank")
		]);


		if($this->request->is("post")) {
			$thread = $this->ForumThreads->patchEntity($thread, $this->request->getData(), [
				"associated" => [
					"ForumReplies"
				]
			]);

			if(strlen($thread->forum_replies[0]->reply) < 10) {
				$canCreateThread = false;
				$this->Flash->error(__("Vous devez écrire un message d'au moins 10 caractères."));
			}

			$thread->forum_replies[0]->reply = htmlentities($thread->forum_replies[0]->reply);

			if($canCreateThread && $this->ForumThreads->save($thread, ["associated" => ["ForumReplies"]])) {
				$thread = $this->ForumThreads->get($thread->id);
				$thread->slug = $thread->id . '-' . Text::slug(strtolower($thread->name));
				$this->ForumThreads->save($thread);

				$this->Spark->send("notification", [], [
					"image" 	=> "message",
					"message" 	=> sprintf(__("Une nouvelle discussion a été lancée par %s sur le forum."), $this->Auth->user("username"))
				]);

				return $this->redirect(["action" => "thread", $thread->slug]);
			}
		}

		$this->set(compact("thread", "categories"));
		$this->set("title", __("Créer une nouvelle discussion"));
		$this->set("description", __("Participe à la vie du forum de HabboMotel en créant une nouvelle discussion."));
	}

	/**
	* Supprime une discussion et ses réponses associées
	* @param string $slug
	*/
	public function deleteThread($slug = null) {
		if(is_null($slug))
			return $this->redirect($this->referer());

		$thread = $this->ForumThreads->findBySlug($slug)
		->contain(['ForumCategories'])
		->first();

		if(!is_null($thread) && ($thread->player_id == $this->Auth->user('id') || $this->Auth->user('rank') >= 5)) {
			$this->ForumThreads->delete($thread);
			return $this->redirect(['action' => 'category', $thread->forum_category->slug]);
		}

		return $this->redirect($this->referer());
	}

	/**
	* Créer une nouvelle réponse
	* @param
	*/
	public function createReply() {
		$canCreateReply = true;

		$lastReply = $this->ForumReplies->findByPlayerId($this->Auth->user("id"))
		->order(["id" => "DESC"])
		->first();

		if(!is_null($lastReply)) {
			$lastTime = new Time($lastReply->created);
			if((time() - $lastTime->i18nFormat(Time::UNIX_TIMESTAMP_FORMAT)) <= 30) {
				$canCreateReply = false;
				$this->Flash->error(__("Tu dois attendre 30 secondes pour répondre à une nouvelle discussion."));
			}
		}

		$reply = $this->ForumReplies->newEntity();

		if($this->request->is("post")) {
			$reply = $this->ForumReplies->patchEntity($reply, $this->request->getData());

			if(strlen($reply->reply) < 3) {
				$canCreateReply = false;
				$this->Flash->error(__("Ta réponse doit faire au minimum 3 caractères"));
			}

			$reply->reply = htmlspecialchars($reply->reply);

			if($canCreateReply && $this->ForumReplies->save($reply)) {
				// Supprime pour cette discussion l'état lu
				$this->ForumThreadsReads->deleteAll([
					"thread_id" => $reply->thread_id,
					"player_id !=" => $this->Auth->user("id")
				]);

				// Met à jour l'activité de la discussion
				$thread = $this->ForumThreads->findById($reply->thread_id)
				->contain(["ForumReplies"])
				->first();

				$thread->modified = Time::now();
				$this->ForumThreads->save($thread);

				// Events
				$location = Router::url([
					'controller' => 'Forum',
					'action' => 'thread',
					$thread->slug,
					'_full' => true
				]);

				$this->ForumReplies->eventManager()->on(new NotificationsEventListener());
                $this->ForumReplies->eventManager()->dispatch(new Event('ForumReplies.replyToThread', $this, [
                	$thread,
                	$this->Auth->user('username'),
                	$this->Auth->user('id'),
                	$location
                ]));

				// Mentionner un utilisateur
                if(substr_count($reply->reply, '@') > 0) {
                    $this->loadModel('Players');

                    $mentionnedPlayers = explode('@', $reply->reply);

                    for($i = 0; $i < count($mentionnedPlayers); $i++) {
                        $mentionnedUsername = trim(explode(' ', $mentionnedPlayers[$i])[0]);
                        $userMentionned = $this->Players->findByUsername($mentionnedUsername)->first();

                        if(!is_null($userMentionned) && $userMentionned->id != $this->Auth->user('id')) {
                            $reply->reply = str_replace($mentionnedUsername, '<a href="#">' . $mentionnedUsername . '</a>', $reply->reply);
                            $this->ForumReplies->save($reply);

                            // Notification
                            $this->ForumReplies->eventManager()->on(new NotificationsEventListener());
                            $this->ForumReplies->eventManager()->dispatch(new Event('ForumReplies.mentionnedUser', $this, [$thread, $this->Auth->user('username'), $userMentionned, $location]));
                        }
                    }
                }

				return $this->redirect($this->referer());
			}
		}

		$this->set(compact("reply"));
		$this->set("title", __("Créer une nouvelle réponse"));

		return $this->redirect($this->referer());
	}

	/**
	* Supprime une réponse d'une discussion
	* @param integer $replyId
	*/
	public function deleteReply($replyId = null) {
		if(is_null($replyId) || !is_numeric($replyId))
			return $this->redirect($this->referer());

		$reply = $this->ForumReplies->findById($replyId)
		->contain([
			'ForumThreads' => ['ForumReplies']
		])
		->first();

		if(!is_null($reply) && ($reply->player_id == $this->Auth->user('id') || $this->Auth->user('rank') >= 5)) {
			$this->ForumReplies->delete($reply);

			if($reply->forum_thread->forum_replies[0]->id == $reply->id)
				return $this->redirect(['action' => 'deleteThread', $reply->forum_thread->slug]);
		}

		return $this->redirect($this->referer());
	}

	/**
	* Change l'état de la discussion
	* @param integer $threadId
	*/
	public function togglePin($threadId = null) {
		if(is_null($threadId) || !is_numeric($threadId))
			return $this->redirect($this->referer());

		if($this->Auth->user('rank') >= 5) {
			$thread = $this->ForumThreads->get($threadId);
			$thread->has_pin = ($thread->has_pin == 0) ? 1 : 0;
			$this->ForumThreads->save($thread);

			$this->Flash->success(__("L'action sur la discussion a été réalisé."));
		}

		return $this->redirect($this->referer());
	}

	/**
	* Change l'état de la discussion
	* @param integer $threadId
	*/
	public function toggleState($threadId = null) {
		if(is_null($threadId) || !is_numeric($threadId))
			return $this->redirect($this->referer());

		if($this->Auth->user('rank') >= 5) {
			$thread = $this->ForumThreads->get($threadId);
			$thread->has_close = ($thread->has_close == 0) ? 1 : 0;
			$this->ForumThreads->save($thread);

			$this->Flash->success(__("L'action sur la discussion a été réalisé."));
		}

		return $this->redirect($this->referer());
	}
}
