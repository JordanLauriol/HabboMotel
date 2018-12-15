<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;

class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Players');

        $this->Auth->allow();
    }

    public function beforeRender(Event $event) {
        if($this->request->action != "newIndex")
            $this->viewBuilder()->setLayout('Homepage/home');
    }

    public function index() {
        $this->set('title', __('Explore un hôtel insolite avec des personnes incroyables'));

        if(!is_null($this->Auth->user('id'))) return $this->redirect(['controller' => 'Avatars', 'action' => 'index']);

        $player = $this->Players->newEntity();
        if($this->request->is('post')) {
            if($this->request->getData('password') != $this->request->getData('repassword')) {
                $this->Flash->error(__("Les mots de passe ne sont pas identique."));
            } else {

                $checkRegistered = $this->Players->findByLastIp($this->_getIpAddress())
                ->order(['id' => 'DESC'])
                ->first();

                if(!is_null($checkRegistered)) {
                    if($checkRegistered->reg_timestamp > 0) {
                        $lastRegistered = $checkRegistered->reg_timestamp;

                        if((time() - $lastRegistered) < 900) {
                            return $this->Flash->error(__("Tu dois attendre 15 minutes pour te ré-inscrire à nouveau."));
                        }
                    }
                }

                $player = $this->Players->patchEntity($player, $this->request->getData());
                $player->last_ip = $this->_getIpAddress();
                $player->reg_date = sprintf(__("le %s à %s"), date("d/m/Y"), date("H\hi"));
                $player->reg_timestamp = time();

                //register
                if($this->Players->save($player)) {
                    $this->Auth->setUser($this->Players->get($player->id)->toArray());
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        }

        $lang = $this->Cookie->read('language');
        $this->set(compact('player', 'lang'));
    }

    public function language() {
        $this->set('title', '');

        $lang = $this->request->getQuery('lang');

        if(isset($lang)) {
            if($lang == "fr") {
                if(!strpos($this->request->env('HTTP_HOST'), "habbomotel.com")) {
                    die(header("location: http://www.habbomotel.com"));
                }
            }
            else {
                if(!strpos($this->request->env('HTTP_HOST'), "habbomotel.in")) {
                    die(header("location: http://www.habbomotel.in"));
                }
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function newIndex() {
        $this->viewBuilder()->setLayout('');

        $this->set("title", "");
    }
}
