<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Event\Event;
use App\Event\NotificationsEventListener;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\File;

class AvatarsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Players');
        $this->loadModel('Articles');
    }

    /**
    * Affiche la page personnelle de l'utilisateur
    * @param void
    * @return void
    */
    public function index() {
        $player = $this->Players->findById($this->Auth->user('id'))
        ->contain('PlayerNotifications', function($q) {
            return $q->where(['PlayerNotifications.is_read' => 0])
                     ->order(['PlayerNotifications.created' => 'DESC']);
        })
        ->first();

        $articles = $this->Articles->find('all')
        ->order(['created' => 'DESC'])
        ->limit(5);

        $this->loadModel("ForumThreads");
        $threads = $this->ForumThreads->find()
        ->contain(['Players'])
        ->order(["modified" => "DESC"])
        ->limit(4);

        $this->set('title', $player->username);
        $this->set(compact('player', 'articles', 'threads'));
    }

    /**
    * Paramètres générales de l'utilisateur
    * @param void
    * @return void
    */
    public function privacy() {
        $this->set('title', __('Paramètres générales'));

        $user = $this->Players->PlayerSettings->findByPlayerId($this->Auth->user('id'))
        ->first();

        if($this->request->is('put')) {
            $user = $this->Players->PlayerSettings->patchEntity($user, $this->request->getData());

            if($this->Players->PlayerSettings->save($user)) {
                $this->Flash->success(__("Les changements seront opérationnels à ta reconnexion dans l'hôtel."));
            }
        }
        $this->set(compact('user'));
    }

    /**
    * Changement de mot de passe
    * @param void
    * @return void
    */
    public function password() {
        $this->set('title', __('Changement de mot de passe'));

        $user = $this->Players->get($this->Auth->user('id'));

        if($this->request->is('put')) {
            if($this->request->getData('password') == $this->request->getData('repassword')) {
                $user = $this->Players->patchEntity($user, $this->request->getData());
                if($this->Players->save($user)) {
                    $this->Flash->success(__("Ton mot de passe a été modifié."));
                }
            } else {
                $this->Flash->error(__("Les mots de passe ne sont pas identique."));
            }
        }

        $this->set(compact('user'));
    }

    /**
    * Active/Désactive la sécurité du compte
    * @param void
    * @return void
    */
    public function security() {
        $this->set('title', __('Protection du compte'));

        $security = $this->Players->PlayerSecurities->findByPlayerId($this->Auth->user('id'))
        ->first();
        $questions = $this->Players->PlayerSecurities->PlayerQuestions->find('list');

        // Modifie la question de sécurité
        if($this->request->is('put')) {
            $security = $this->Players->PlayerSecurities->patchEntity($security, $this->request->getData());
            if($this->Players->PlayerSecurities->save($security)) {
                $this->Flash->success(__('Ton compte est maintenant sécurisé contre les connexions depuis un autre ordinateur que le tien.'));
            }
        }

        // Désactive la protection du compte
        if($this->request->is('post')) {
            $this->Players->PlayerSecurities->delete($security);
            $this->Flash->success(__('La protection de ton compte a été désactivé.'));
        }

        $this->set(compact('security', 'questions'));
    }

    /**
    * Historique des connexions sur le compte
    */
    public function history() {
        $this->set('title', __('Historique de connexions'));

        $user = $this->Players->PlayerIpaddresses->findByPlayerId($this->Auth->user('id'))
        ->order(['created' => 'DESC'])
        ->find('all');

        $this->set(compact('user'));
    }

    /**
    * Nettoyage de l'historique de connexion
    */
    public function clearHistory() {
        $this->Players->PlayerIpaddresses->deleteAll([
            "player_id" => $this->Auth->user("id")
        ]);

        $this->Flash->success(__("L'historique de connexion a été vidé."));
        return $this->redirect(["action" => "history"]);
    }

    /**
    * Gestion du profil social
    * @param void
    * @return void
    */
    public function network($state = null) {
        $this->set('title', __('Gestion du profil social'));

        if($this->request->is('post')) {
            $state = $this->request->getData('state');

            if($state == "enabled") {
                if($this->Players->PlayerNetworks->save($this->Players->PlayerNetworks->newEntity([
                    'player_id' => $this->Auth->user('id')
                ]))) {
                    $this->Flash->success(__('Ton profil social est désormais visible par les autres Habbos.'));
                }
            } else if($state == "disabled") {
                $network = $this->Players->PlayerNetworks->findByPlayerId($this->Auth->user('id'))->first();
                $this->Players->PlayerNetworks->delete($network);
                $this->Flash->success(__('Ton profil social est désormais invisible pour les autres Habbos.'));
            }
        }

        $network = $this->Players->PlayerNetworks->findByPlayerId($this->Auth->user('id'))->first();
        $basedir = WWW_ROOT . 'img' . DS . 'uploads';

        if($this->request->is('put')) {
            $data = $this->request->getData();

            if($data["picture"]["error"] == 1) {
                $this->Flash->error(__("Une erreur est survenue lors du changement de photo de profil."));
            } else {
                if($data["picture"]["error"] == 4) {
                    $data["picture"] = empty($network->picture) ? "img/uploads/avatar_defaut.png" : $network->picture;
                }

                $network = $this->Players->PlayerNetworks->patchEntity($network, $data);
                $uniqid = uniqid();

                if($this->Players->PlayerNetworks->save($network)) {
                    if(isset($data["picture"]) && is_array($data["picture"])) {
                        if(is_uploaded_file($data["picture"]["tmp_name"])) {
                            if($data["picture"]["error"] == UPLOAD_ERR_OK) {
                                move_uploaded_file($data["picture"]["tmp_name"], $basedir . DS . $uniqid . '.png');
                                $this->loadModel('PlayerTmps');
                                $playerTmps = $this->PlayerTmps->findByPlayerId($this->Auth->user('id'))->first();

                                if(is_null($playerTmps)) {
                                    $playerTmps = $this->PlayerTmps->newEntity([
                                        'player_id' => $this->Auth->user('id'),
                                        'picture'   => $this->webroot . 'img/uploads/' . $uniqid . '.png'
                                    ]);
                                } else {
                                    $playerTmps->picture = $this->webroot . 'img/uploads/' . $uniqid . '.png';
                                }

                                if($this->PlayerTmps->save($playerTmps)) {
                                    $this->Flash->success(__("Ton profil social a été mis à jour, en revanche ta photo de profil a été soumise à une validation, elle apparaîtra d'ici peu sur ton profil."));
                                }
                            }
                        }
                    } else {
                        $this->Flash->success(__('Ton profil social a été mis à jour.'));
                    }
                }
            }
        }

        $this->set(compact('network'));
    }

    /**
    * Supprime le statut de débutant pour éviter les tutoriels
    * @param void
    * @return void
    */
    public function newbie() {
        if ($this->request->is('ajax')) {
            $user = $this->Players->get($this->Auth->user('id'));
            $user->newbie = ($user->newbie == 0) ? 1 : 0;
            $this->Players->save($user);

            $this->request->session()->write('Auth.User.newbie', $user->newbie);

            if($user->newbie == 0) {
                $this->eventManager()->on(new NotificationsEventListener());
                $this->eventManager()->dispatch(new Event('Avatars.newbie', $this, $user));
            }
        }
    }
}
