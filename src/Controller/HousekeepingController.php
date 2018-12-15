<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Utility\Text;
use Cake\Utility\Inflector;

class HousekeepingController extends AppController {

	public function initialize() {
		parent::initialize();
	}

	public function beforeRender(Event $event) {
        parent::beforeRender($event);

        $this->viewBuilder()->setLayout('housekeeping');
    }

	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->loadModel('HousekeepingPermissions');

		if($this->request->action != "error" && $this->request->action != "permissionsRequired") {
			$permission = $this->HousekeepingPermissions->findByAction(Inflector::underscore($this->request->action))->first();

			if(is_null($permission)) {
				return $this->redirect(['action' => 'error']);
			} else {
				if($permission->min_rank > $this->request->session()->read('Auth.User.rank')) {
					return $this->redirect(['action' => 'permissionsRequired']);
				}
			}
		}
	}

	/**
	* Log les actions des utilisateurs
	* @param
	* @return
	*/
	private function logging($username, $action) {

	}

	/**
	* Affiche le tableau de bord de l'administration
	* @param
	* @return
	*/
	public function index() {
		$this->set([
			'title' => __('Tableau de bord'),
			'desc'  => __("Statistiques générales de l'hôtel"),
			'color' => 'is-dark',
			'page'	=> 'dashboard'
		]);

		$this->loadModel('Players');
		$this->loadModel('Bans');
		$this->loadModel('ServerStatus');
		$this->loadModel('PlayerTmps');

		$players = $this->Players->find()->all();
		$bans = $this->Bans->find()->all();
		$status = $this->ServerStatus->find()->first();
		$pictures = $this->PlayerTmps->find()->all();

		$this->set(compact('players', 'bans', 'status', 'pictures'));
	}

	/**
	* L'utilisateur est renvoyé sur cette page si il ne possède pas les permissions requises.
	* @param
	* @return
	*/
	public function permissionsRequired() {
		$this->set([
			'title' => __('Permission refusée'),
			'desc'  => __("Vous n'avez pas la permission nécessaire pour accéder à cette partie de l'administration."),
			'color' => 'is-danger',
			'page'  => 'permissionsRequired'
		]);
	}

	/**
	* L'utilisateur est renvoyé sur cette page si l'action n'est pas répertoriée dans la base de données.
	* @param
	* @return
	*/
	public function error() {
		$this->set([
			'title' => __('Une erreur est survenue'),
			'desc'  => __("Il semblerait que l'action que vous tentez de réaliser n'existe pas."),
			'color' => 'is-danger',
			'page'  => 'error'
		]);
	}

	/**
	* L'utilisateur peut bannir un Habbo
	* @param
	* @return
	*/
	public function ban() {
		$this->set([
			'title' => __('Bannir un Habbo'),
			'desc'  => __("Maintien la Habbo attitude en sanctionnant les Habbos perturbateurs."),
			'color' => 'is-dark',
			'page'  => 'ban'
		]);

		$this->loadModel('Bans');
		$this->loadModel('Players');
		$this->loadModel('PlayerAccess');
		$this->loadModel('ServerPermissionsRanks');

		$ban = $this->Bans->newEntity();
		$this->set(compact('ban'));

		if($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->getData();

			// Check if user exists
			$player = $this->Players->findByUsername($data["username"])->first();
			if(is_null($player)) {
				return $this->Flash->error(__("Cet Habbo n'existe pas."));
			}

			// Check permissions of user
			if($player->rank > 2) {
				$this->loadModel('ServerPermissionsRanks');
				$permissions = $this->ServerPermissionsRanks->findById($player->rank)->first();

				if(!is_null($permissions) && $permissions->bannable == "0") {
					return $this->Flash->error(__("Cet Habbo ne peut pas être banni."));
				}
			}

			switch($data["type"]) {
				case "user": {
					$ban->data = $player->id;
					break;
				}

				default: {
					$access = $this->PlayerAccess->findByPlayerId($player->id)
					->order(['id' => 'DESC'])
					->first();

					if(is_null($access)) {
						return $this->Flash->error(__("Cet Habbo n'a pas accédé à l'hôtel pour le moment."));
					}

					if($data["type"] == "machine")
						$ban->data = $access->hardware_id;
					else
						$ban->data = $access->ip_address;

					break;
				}
			}

			$bans = $this->Bans->findByData($ban->data)->first();
			if(!is_null($bans)) {
				return $this->Flash->error(__("Cet Habbo est déjà banni pour le même type d'exclusion."));
			}

			if(empty($data["reason"]) || strlen($data["reason"]) < 10) {
				return $this->Flash->error(__('Définissez une raison plus explicite que celle-ci.'));
			}

			$now = Time::now();
			$timestamp = $now->modify($data["expire"])->toUnixString();

			$ban->type 	 = $data["type"];
			$ban->expire = $timestamp;
			$ban->reason = $data["reason"];
			$ban->added_by = $this->Auth->user('id');

			if($this->Bans->save($ban)) {
				$this->logging($this->Auth->user('username'), sprintf(__("%s a banni %s pour la raison %s"), $this->Auth->user("username"), $player->username, $ban->reason));

				$this->Spark->send("disconnectPlayer", [
		            ":id" => $player->id
		        ]);
		        
				$this->Spark->send("reload", [":type" => "bans"]);

				return $this->Flash->success(sprintf(__("%s a été banni pour la raison: %s, l'exclusion prendra effet à la prochaine connexion du Habbo."), $player->username, $ban->reason));
			}
		}
	}

	/**
	* L'utilisateur peut débannir un Habbo
	* @param
	* @return
	*/
	public function unban() {
		$this->set([
			'title' => __('Débannir un Habbo'),
			'desc'  => __("Débannissez un Habbo si le cas est légitime"),
			'color' => 'is-dark',
			'page'  => 'unban'
		]);

		$this->loadModel('Bans');
		$this->loadModel('Players');
		$this->loadModel('PlayerAccess');

		if($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->getData();

			// Check if user exists
			$player = $this->Players->findByUsername($data["username"])->first();
			if(is_null($player)) {
				return $this->Flash->error(__("Cet Habbo n'existe pas."));
			}

			$access = $this->PlayerAccess->findByPlayerId($player->id)
			->order(['id' => 'DESC'])
			->first();

			if(is_null($access)) {
				return $this->Flash->error(__("Cet Habbo n'a pas accédé à l'hôtel pour le moment."));
			}

			$ban = $this->Bans->find()
			->where([
				'data' => $player->id
			])
			->orWhere([
				'data' => $access->ip_address
			])
			->orWhere([
				'data' => $access->hardware_id
			])
			->first();

			if(is_null($ban)) {
				return $this->Flash->error(__("Cet Habbo n'est pas banni."));
			}

			if($this->Bans->deleteAll([
				'OR' => [
					['data' => $player->id],
					['data' => $access->hardware_id],
					['data' => $access->ip_address]
				]
			])) {
				$this->logging($this->Auth->user('username'), sprintf(__("%s a débanni %s"), $this->Auth->user('username'), $player->username));

				$this->Spark->send("reload", [":type" => "bans"]);

				return $this->Flash->success(sprintf(__("%s a été débanni pour tous les types d'exclusions."), $player->username));
			}
		}
	}

	/**
	* Liste les articles publiés sur le site
	* @param
	* @return
	*/
	public function listArticles() {
		$this->set([
			'title' => __('Liste des articles'),
			'desc'  => __("Gérer les articles publiés sur le site"),
			'color' => 'is-dark',
			'page'  => 'listArticles'
		]);

		$this->loadModel('Articles');

		$articles = $this->Articles->find()->order(["id" => "DESC"])->all();
		$this->set(compact('articles'));
	}

	/**
	* L'utilisateur peut créer un article
	* @param
	* @return
	*/
	public function createArticle() {
		$this->set([
			'title' => __('Créer un article'),
			'desc'  => __("Informer les Habbos sur l'actualité de l'hôtel"),
			'color' => 'is-dark',
			'page'  => 'createArticle'
		]);

		$this->loadModel('Articles');

		$article = $this->Articles->newEntity();
		$categories = $this->Articles->Categories->find('list');
		$this->set(compact('article', 'categories'));

		if($this->request->is('post')) {
			$article = $this->Articles->patchEntity($article, $this->request->getData());

			$article->author_id = $this->Auth->user('id');
			if($this->Articles->save($article)) {
				
				$this->logging($this->Auth->user('username'), sprintf(__("Rédaction d'un article %s"), $article->title));

				// Envoi une notification à tous les utilisateurs
				$this->Spark->send("articlePublished");

				$article = $this->Articles->get($article->id);
				$article->slug = $article->id . '-' . Text::slug(strtolower($article->title));
				$this->Articles->save($article);

				return $this->Flash->success(__("Ton article vient d'être publié sur le site."));
				
			}
		}
	}

	/**
	* L'utilisateur supprime un article
	* @param (int) $articleId
	* @return
	*/
	public function deleteArticle($articleId = null) {
		$this->set([
			'title' => __('Supprimer un article'),
			'desc'  => null,
			'color' => 'is-dark',
			'page'  => 'deleteArticle'
		]);

		if(is_null($articleId) || !is_numeric($articleId)) {
			$this->Flash->error(__("Une erreur est survenue lors de la suppression d'un article."));
			return $this->redirect(['action' => 'listArticles']);
		}

		$this->loadModel('Articles');

		$article = $this->Articles->get($articleId);

		if(is_null($article)) {
			$this->Flash->error(__("Une erreur est survenue lors de la suppression d'un article."));
			return $this->redirect(['action' => 'listArticles']);
		}

		$this->logging($this->Auth->user('username'), sprintf(__("Suppression de l'article %s"), $article->title));

		$this->Articles->delete($article);
		$this->Flash->success(__("L'article a été supprimé avec succès."));
		return $this->redirect(['action' => 'listArticles']);
	}

	/**
	* L'utilisateur edite un article
	* @param (int) $articleId
	* @return
	*/
	public function editArticle($articleId = null) {
		$this->set([
			'title' => __('Editer un article'),
			'desc'  => __("Editer un article comme bon vous semble"),
			'color' => 'is-dark',
			'page'  => 'editArticle'
		]);

		if(is_null($articleId) || !is_numeric($articleId)) {
			$this->Flash->error(__("Une erreur est survenue lors de l'edition d'un article."));
			return $this->redirect(['action' => 'listArticles']);
		}

		$this->loadModel('Articles');

		$article = $this->Articles->get($articleId);
		$categories = $this->Articles->Categories->find('list');

		if(is_null($article)) {
			$this->Flash->error(__("Une erreur est survenue lors de l'edition d'un article."));
			return $this->redirect(['action' => 'listArticles']);
		}

		$this->set(compact('article', 'categories'));

		if($this->request->is('put')) {
			$article = $this->Articles->patchEntity($article, $this->request->getData());

			if($this->Articles->save($article)) {
				$this->logging($this->Auth->user('username'), sprintf(__("Edition de l'article %s"), $article->title));

				$article = $this->Articles->get($article->id);
				$article->slug = $article->id . '-' . Text::slug(strtolower($article->title));
				$this->Articles->save($article);
				return $this->Flash->success(__("L'article a été modifié avec succès"));
			}
		}
	}

	/**
	* Rechercher les informations d'un utilisateur
	* @param
	* @return
	*/
	public function searchUser() {
		$this->set([
			'title' => __('Rechercher un utilisateur'),
			'desc'  => __("Trouver les détails dont vous avez besoin sur un utilisateur"),
			'color' => 'is-dark',
			'page'  => 'searchUser'
		]);

		$this->loadModel('Players');

		if($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->getData();
			$userId = isset($data["searchUsername"]) ? $data["searchUsername"] : $data["id"];
			if(is_numeric($userId)) {
				$player = $this->Players->get($userId);
			}
			else {
				$player = $this->Players->findByUsername($userId)->first();
			}

			if(is_null($player)) {
				return $this->Flash->error(__("Cet Habbo n'existe pas."));
			}

			if($this->request->is('put')) {
				$this->loadModel('HousekeepingPermissions');
				$permission = $this->HousekeepingPermissions->findByAction("edit_user_bypass")->first();
				$hasPermission = ($permission->min_rank > $this->Auth->user('rank')) ? false : true;

				$playerEntity = $this->Players->patchEntity($player, $data);

				$playerEntity->activity_points = $hasPermission ? $data["activity_points"] : $player->activity_points;
				$playerEntity->vip_points = $hasPermission ? $data["vip_points"] : $player->vip_points;
				$playerEntity->vip_points = $hasPermission ? $data["vip_points"] : $player->vip_points;
				$playerEntity->rank = $hasPermission ? $data["rank"] : $player->rank;
				$playerEntity->disabled = $hasPermission ? $data["disabled"] : $player->disabled;

				$playerEntity->username = $player->username;

				if($this->Players->save($playerEntity)) {
					$this->logging($this->Auth->user('username'), sprintf(__("Edition de l'utilisateur %s"), $playerEntity->username));

					$this->Spark->send("reloadPlayerData", [":id" => $playerEntity->id]);
					return $this->Flash->success(__("Les modifications ont été réalisées avec succès."));
				}
			}

			$this->set(compact('player'));
		}
	}

	/**
	* Lancer une animation
	* @param
	* @return
	*/
	public function event() {
		$this->set([
			'title' => __('Lancer une animation'),
			'desc'  => __("Tous les utilisateurs en ligne recevront une alerte"),
			'color' => 'is-dark',
			'page'  => 'event'
		]);

		if($this->request->is('post')) {
			$data = $this->request->getData();

			$search = ["<script", "<img", "<meta"];
            $replace = ["", "", ""];

            $data["message"] = str_replace($search, $replace, $data["message"]);

            if($this->Auth->user('rank') < 10) {
            	$data["message"] = str_replace("<iframe", "", $data["message"]);
            }

			// Filtres
			if($this->Spark->send("eventAlert", [], [
				"senderId" 	=> $this->Auth->user('id'),
				"message"  	=> nl2br($data["message"]),
				"header"   	=> htmlentities($data["header"]),
				"canFollow" => $data["canFollow"]
			])) {
				$this->Flash->success(__("L'alerte d'animation a été envoyé dans l'hôtel."));
			} else {
				$this->Flash->error(__("Une erreur est survenue lors de l'envoie de l'alerte."));
			}

			// Logging
			$this->logging($this->Auth->user('username'), sprintf(__("%s a lancer une alerte: %s"), $this->Auth->user("username"), $data["message"]));
		}
	}

	/**
	* Valider les photos des profils sociaux
	* @param
	* @return
	*/
	public function picture($pictureId = null, $action = null) {
		$this->set([
			'title' => __('Photos'),
			'desc'  => __("Validation des photos de profil"),
			'color' => 'is-dark',
			'page'  => 'picture'
		]);

		$this->loadModel('PlayerTmps');
		$pictures = $this->PlayerTmps->find()->all();
		$this->set(compact('pictures'));

		if(!is_null($pictureId) && !is_null($action)) {
			if($action == "confirmed") {
				$this->loadModel('PlayerNetworks');

				$picture = $this->PlayerTmps->findById($pictureId)->first();

				if(!is_null($picture)) {
					$playerNetwork = $this->PlayerNetworks->findByPlayerId($picture->player_id)->first();
					$playerNetwork->picture = $picture->picture;

					if($this->PlayerNetworks->save($playerNetwork)) {
						$this->PlayerTmps->delete($picture);
						return $this->Flash->success(__("La photo de profil a été validé."));
					}
				}
			} else {
				$picture = $this->PlayerTmps->findById($pictureId)->first();

				if(!is_null($picture)) {
					$this->PlayerTmps->delete($picture);
					return $this->Flash->success(__("La photo de profil a été refusé."));
				}
			}
		}
	}
}