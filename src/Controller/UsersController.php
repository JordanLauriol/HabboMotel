<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadModel('Players');
        
        $this->Auth->allow('login');
    }

    /**
     * Authentifie un utilisateur
     * @param
     * @return Redirection
     */
    public function login() {
        if($this->request->is('post')) {
            $player = $this->Auth->identify();
            if($player) {
                $this->Auth->setUser($player);

                if($this->Auth->user('disabled') == '1') {
                    $this->Flash->error(__("Votre compte a été désactivé par la haute administration."));
                    return $this->redirect($this->Auth->logout());
                }

                // Security for account
                $ipaddresses = $this->Players->PlayerIpaddresses->newEntity([
                    'player_id' => $this->Auth->user('id'),
                    'address'   => $this->_getIpAddress(),
                    'agent'     => $this->request->getHeaderLine('User-Agent')
                ]);

                $lastIpAddress = $this->Players->PlayerIpaddresses
                ->findByPlayerId($this->Auth->user('id'))
                ->last();


                if(is_null($lastIpAddress))
                    $this->Players->PlayerIpAddresses->save($ipaddresses);
                else if($lastIpAddress->address != $this->_getIpAddress()) {
                    $security = $this->Players->PlayerSecurities
                    ->findByPlayerId($this->Auth->user('id'))
                    ->first();
                    if(!is_null($security))
                        $this->request->session()->write('Security.check', true);
                    else
                        $this->Players->PlayerIpAddresses->save($ipaddresses);
                }

                // Remember me
                $this->_setRememberMe($this->Auth->user('id'));

                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__("Nom d'utilisateur ou mot de passe incorrect"));
                return $this->redirect($this->request->referer());
            }
        } else {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
    }

    /**
     * Déconnecte un utilisateur
     * @param
     * @return
     */
    public function logout() {
        
        $this->Spark->send("disconnectPlayer", [
            ":id" => $this->Auth->user('id')
        ]);

        $this->Cookie->delete('RememberMe');
        $this->request->session()->delete('Security.check');
        $this->redirect($this->Auth->logout());
    }

    /**
     * Suggestion d'une double authentification pour la sécurisation du compte.
     * @param
     * @return
     */
    public function security() {
        $this->set('title', __('Sécurisé ton compte'));

        $player = $this->Players->findById($this->Auth->user('id'))
        ->contain('PlayerSecurities')
        ->first();

        if(!is_null($player->player_security)) {
            return $this->redirect(['controller' => 'Avatars', 'action' => 'index']);
        }

        $security = $this->Players->PlayerSecurities->newEntity();
        if($this->request->is('post')) {
            $security = $this->Players->PlayerSecurities->patchEntity($security, $this->request->getData());
            if($this->Players->PlayerSecurities->save($security)) {
                $this->Flash->success(__('Ton compte est maintenant sécurisé contre les connexions depuis un autre ordinateur que le tien.'));
                return $this->redirect(['controller' => 'Avatars', 'action' => 'index']);
            }
        }

        $questions = $this->Players->PlayerSecurities->PlayerQuestions->find('list');
        $this->set(compact(['security', 'questions']));
    }

    /**
     * Verification de la réponse de sécurité en cas d'intrusion sur un compte avec une nouvelle adresse
     * ip
     * @param
     * @return
     */
    public function check() {
        $this->set('title', __('Vérification de l\'identité'));
        
        $security = $this->Players->PlayerSecurities
        ->findByPlayerId($this->Auth->user('id'))
        ->contain('PlayerQuestions')
        ->first();

        if(is_null($security)) {
            return $this->redirect(['controller' => 'Users', 'action' => 'security']);
        }

        if($this->request->is('post')) {
            if(strtolower(trim($security->answer)) == strtolower(trim($this->request->getData('answer')))) {
                $this->request->session()->delete('Security.check');
                $ipaddresses = $this->Players->PlayerIpaddresses->newEntity([
                    'player_id' => $this->Auth->user('id'),
                    'address'   => (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $this->request->clientIp(),
                    'agent'     => $this->request->getHeaderLine('User-Agent')
                ]);
                $this->Players->PlayerIpAddresses->save($ipaddresses);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__("La réponse que tu as saisie est incorrect."));
        }
        $this->set(compact('security'));
    }

    public function mail() {
        $email = new Email('default');
        $email->from(['Jor.dan@hotmail.de' => 'My Site'])
            ->template('default', 'default')
            ->to('webopass.jordan@gmail.com')
            ->emailFormat('html')
            ->subject('About')
            ->send('My message');

        debug($email);
    }
}
