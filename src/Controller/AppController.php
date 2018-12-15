<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Security;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        $this->loadComponent('Cookie');
        $this->loadComponent('Auth', [
            'authError'     => __('Tu dois te connecter pour accéder à cette partie du site.'),
            'loginRedirect' => ['controller' => 'users', 'action' => 'security'
            ]
        ]);

        $this->loadComponent('Spark', [
            'host'   => '151.80.42.229',
            'port'   => (strpos($this->request->env('HTTP_HOST'), "habbomotel.com")) ? 31001 : 30001,
            "token"  => "f2dV965CL1fm0qgaXXrAT34yhvshcI8u"
        ]);

        $this->Cookie->config([
            'expires' => '+31 days',
            'httpOnly' => true
        ]);

        $this->Auth->config('authenticate', [
            'Form' => [
                'fields' => [
                    'username'  => 'username',
                    'password'  => 'password'
                ],
                'userModel' => 'Players'
            ]
        ]);



        // Assign database from language
        if($this->Cookie->check('language')) {
            if($this->Cookie->read('language') == "fr") {
                ConnectionManager::alias('default', 'default');
            } else if($this->Cookie->read('language') == "pt") {
                date_default_timezone_set('America/Sao_Paulo');
                ini_set('intl.default_locale', 'pt_PT');
                ConnectionManager::alias('portuguese', 'default');
            } else {
                date_default_timezone_set('Europe/Paris');
                ini_set('intl.default_locale', 'fr_FR');
                ConnectionManager::alias('development', 'default');
            }
        } else {
            ConnectionManager::alias('default', 'default');
        }

        $this->loadModel('Players');
        // Cookies authentification
        if(is_null($this->Auth->user('id')) && $this->Cookie->check('RememberMe')) {
            $player = $this->Players->findByHash($this->Cookie->read('RememberMe')['hash'])->first();

            if(!is_null($player)) {
                $this->Auth->setUser($player->toArray());
                $this->_setRememberMe($player->id);
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        if(!is_null($this->Auth->user('id'))) {
            $player = $this->Players->findById($this->Auth->user('id'))->first();

            $this->request->session()->write('Auth.User.credits', $player->credits);
            $this->request->session()->write('Auth.User.activity_points', $player->activity_points);
            $this->request->session()->write('Auth.User.vip_points', $player->vip_points);
            $this->request->session()->write('Auth.User.figure', $player->figure);
            $this->request->session()->write('Auth.User.rank', $player->rank);
            $this->request->session()->write('Auth.User.disabled', $player->disabled);
            $this->request->session()->write('Auth.User.last_online', $player->last_online);
            $this->request->session()->write('Auth.User.anim_points', $player->anim_points);

            if($player->disabled == "1") {
                $this->Flash->error(__("Ton compte a été désactivé par la haute administration."));
                return $this->redirect($this->Auth->logout());
            }
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        if($this->request->action != "client" && $this->request->action != "test" && $this->request->action != "socyalize" && $this->request->controller != "Catalog" && $this->request->action != "error")
            $this->viewBuilder()->setLayout('bulma');

        // Sécurisation de votre compte
        if($this->request->session()->check('Security.check') && $this->request->getParam('action') != 'check')
            return $this->redirect(['controller' => 'Users', 'action' => 'check']);


    }

    public function beforeFilter(Event $event)
    {
        $this->set('meta_description', __('HabboMotel - Fais-toi de nouveaux amis, crée ton Habbo, adopte des animaux de compagnie, organise des grandes soirées! Amuse-toi gratuitement dès maintenant!'));

        $this->set('keywords_fr', __('Habbomotel, habbomotel, Habbo Motel, HabboMotel, habbo, Habbo, Habbo hotel, habbomotel.com, habbomotel.in, habbo.fr, habbo retro, habbo retro gratuit, virtuel, monde, réseau social, habbo gratuit, habbo credit, habbo france, credit, credits, gratuit, communautée, avatar, chat, connectée, adolescence, jeu de rôle, rejoindre, social, groupes, forums, sécuritée, jouer, jeux, amis, rares, ados, jeunes, collector, collectionner, créer, connecter, meuble, mobilier, animaux, déco, design, appart, décorer, partager, badges, musique, chat vip, fun, sortir, mmo, mmorpg, jeu massivement multijoueur, '));
        $this->set('keywords_pt', __('Habbomotel, habbomotel, Habbo Motel, HabboMotel, habbo, Habbo, Habbo hotel, habbomotel.com, habbomotel.in, habbo.com.br, habbo pirata, habbo pirata grátis, pirata, rede social, habbo grátis,  habbo créditos, habbo brasil, habbo portugal, crédito, créditos, gratuito, comunidade, avatar, chat, conectado, adolescente, atividades, registrar, social, grupos, forúns, segurança, jogar, jogo, amigos, raros, adolescente, jovens, colecionar, colecionador, criar, conectar, quarto, mobis, animais, decoração, design, quartos, decorar, partilhar, emblemas, música, chat hc, festa, sair, rpg, eventos, novidades, amizades'));

        $this->_assignLanguage();
        $this->set('locale', $this->Cookie->read('language')  . '_' . strtoupper($this->Cookie->read('language')));

        $hotels = [
            "Jabbo",
            "JabboHotel",
            "Jabbo Hotel",
            "Adohotel",
            "Ado Hotel",
            "Bobbalive",
            "Bobba Live",
            "Habbo",
            "Habbo Hotel",
            "BobbaHotel",
            "Bobba Hotel",
            "HabboCity",
            "Habbo City",
            "Habboz",
            "Wibbo",
            "Wibbo Hotel",
            "Adow",
            "HabboAlpha",
            "Habbo-Alpha",
            "Habbo Alpha"
        ];

        $this->set("hotels", $hotels);
    }

    /**
    * Assigne la langue du site par rapport aux visiteurs et l'host.
    * @param
    * @return
    */
    protected function _assignLanguage() {
        // Assign language from host.
        if(!$this->Cookie->check('language')) {
            if($this->request->env('HTTP_HOST') == "dev.habbomotel.com") {
                $this->Cookie->write('language', 'dev');
            } else if(strpos($this->request->env('HTTP_HOST'), "habbomotel.com")) {
                $this->Cookie->write('language', 'fr');
            } else if(strpos($this->request->env('HTTP_HOST'), "habbomotel.in")) {
                $this->Cookie->write('language', 'pt');
            } else {
                $this->Cookie->write('language', 'fr');
            }
        }

        // Display language and set timezone.
        if($this->Cookie->read('language') == "fr") {
            I18n::setLocale('fr_FR');

            // User have french language but it's on habbomotel.in
            if(!strpos($this->request->env('HTTP_HOST'), "habbomotel.com")) {
                $this->Cookie->delete('language');
                die(header("location: http://habbomotel.com"));
            }

        } else if($this->Cookie->read('language') == "pt") {
            I18n::setLocale('pt_PT');
            //$this->Cookie->write('language', 'fr');

            // User have french language but it's on habbomotel.com
            if(!strpos($this->request->env('HTTP_HOST'), "habbomotel.in")) {
                $this->Cookie->delete('language');
                die(header("location: http://habbomotel.in"));
            }
        } else if($this->Cookie->read('language') == "dev") {
            I18n::setLocale('tr_TR');
        } else {
            I18n::setLocale('fr_FR');
        }
    }

    /**
    * Cookie authentification
    * @param userId
    * @return boolean
    */
    protected function _setRememberMe($userId) {
        $this->loadModel('Players');

        $hash = Security::hash(rand());

        $this->Cookie->write('RememberMe', [
            'hash' => $hash
        ]);

        $player = $this->Players->get($userId);
        $player->hash = $hash;

        if($this->Players->save($player)) {
            return true;
        }

        return false;
    }

    /**
    * Adresse IP du visiteur
    * @param
    * @return
    */
    protected function _getIpAddress() {
        return $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $this->request->clientIp();
    }

    /**
    * Insère une transaction pour l'utilisateur
    * @param
    * @return
    */
    protected function _addTransaction($playerId, $message) {
        $this->loadModel('PlayerTransactions');

        $transaction = $this->PlayerTransactions->newEntity([
            "player_id" => $playerId,
            "message"   => $message
        ]);

        $this->PlayerTransactions->save($transaction);
    }
}
