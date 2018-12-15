<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\I18n\Time;
use App\Event\TrophiesEventListener;
use App\Event\NotificationsEventListener;
use Cake\Utility\Text;

class ArticlesController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->Auth->allow();

        $categories = $this->Articles->Categories->find('all');

        $articles = $this->Articles->find('all')
        ->order(['created' => 'DESC']);

        $today = $articles->filter(function($article, $key) {
            return (new Time($article->created))->isToday();
        });

        $yesterday = $articles->filter(function($article, $key) {
            return (new Time($article->created))->isYesterday();
        });

        $week = $articles
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isToday());
        })
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isYesterday());
        })
        ->filter(function($article, $key) {
            return (new Time($article->created))->isThisWeek();
        });

        $month = $articles
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isToday());
        })
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isYesterday());
        })
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isThisWeek());
        })
        ->filter(function($article, $key) {
            return (new Time($article->created))->isThisMonth();
        });

        $year = $articles
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isToday());
        })
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isYesterday());
        })
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isThisWeek());
        })
        ->reject(function($article, $key) {
            return ((new Time($article->created))->isThisMonth());
        })
        ->filter(function($article, $key) {
            return (new Time($article->created))->isThisYear();
        });

        $this->set(compact('today', 'yesterday', 'week', 'month', 'year', 'categories'));
    }

    /**
     * Liste les 5 derniers articles
     * @param
     * @return 5 derniers articles
     */
    public function index() {
        $this->set('title', __('Les articles'));
        
        $article = $this->Articles->find()
        ->order(['created' => 'DESC'])
        ->first();

        return $this->redirect(['action' => 'view', $article->slug]);
    }

    /**
     * Trie les articles en fonction de la catégorie
     * @param Catégorie
     * @return Liste des articles triés
     */
    public function category($category) {
        $articlesByCategory = $this->Articles->Categories->findBySlug($category)
        ->contain('Articles')
        ->first();

        if(is_null($articlesByCategory)) return $this->redirect(['action' => 'index']);

        $this->set('title', $articlesByCategory->name);
        $this->set(compact('articlesByCategory'));
    }

    /**
     * Affiche un article
     * @param Article
     * @return Article
     */
    public function view($article) {
        $article = $this->Articles->findBySlug($article)
        ->contain([
            'Players',
            'Categories',
            'Comments' => [
                'sort' => ['Comments.id' => 'DESC'],
                'Players'
            ]
        ])
        ->first();

        if(is_null($article))
            return $this->redirect(['action' => 'index']);

        $comment = $this->Articles->Comments->newEntity();
        if($this->request->is('post')) {
            // Evenements
            //$this->Articles->Comments->eventManager()->on(new TrophiesEventListener());
            
            $comment = $this->Articles->Comments->patchEntity($comment, $this->request->getData());
            $comment->body = htmlspecialchars($comment->body);

            if($this->Articles->Comments->save($comment)) {

                if($this->Auth->user('id') != $article->author_id) {
                    $this->Spark->send("articleCommented", [
                        ":id" => $article->author_id
                    ]);
                }

                // Mentionned user
                if(substr_count($comment->body, '@') > 0) {
                    $this->loadModel('Players');

                    $mentionnedPlayers = explode('@', $comment->body);

                    for($i = 0; $i < count($mentionnedPlayers); $i++) {
                        $mentionnedUsername = trim(explode(' ', $mentionnedPlayers[$i])[0]);
                        $userMentionned = $this->Players->findByUsername($mentionnedUsername)->first();

                        if(!is_null($userMentionned) && $userMentionned->id != $this->Auth->user('id')) {
                            $comment->body = str_replace($mentionnedUsername, '<a href="#">' . $mentionnedUsername . '</a>', $comment->body);
                            $this->Articles->Comments->save($comment);
                            
                            $location = Router::url(['controller' => 'Articles', 'action' => 'view', $article->slug, '#' => 'comment#' . $comment->id .'', '_full' => true]);

                            // Notification
                            $this->Articles->Comments->eventManager()->on(new NotificationsEventListener());
                            $this->Articles->Comments->eventManager()->dispatch(new Event('Comments.mentionnedUser', $this, [$article, $this->Auth->user('username'), $userMentionned, $location]));
                        }
                    }
                }

                // Reply to article
                if($article->player->id != $this->Auth->user('id')) {
                    $location = Router::url(['controller' => 'Articles', 'action' => 'view', $article->slug, '#' => 'comment#' . $comment->id .'', '_full' => true]);
                    $this->Articles->Comments->eventManager()->on(new NotificationsEventListener());
                    $this->Articles->Comments->eventManager()->dispatch(new Event('Comments.replyToArticle', $this, [$article, $this->Auth->user('username'), $location]));
                }

                $this->Flash->success(__("Ton commentaire a été ajouté."));
                return $this->redirect($this->request->referer());
            }
        }

        $this->set('title', $article->title);
        $this->set('description', Text::truncate(strip_tags($article->body), 155));
        $this->set(compact('article', 'comment'));
    }
}
