<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\Event\Event;

class CommunityController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Players');

        //$this->Auth->allow();
        $this->Auth->allow(['staff', 'architect']);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Security->setConfig('unlockedActions', [
            'error'
        ]);

        $this->eventManager()->off($this->Csrf);
    }

    /**
    * Affiche la page personnelle de l'utilisateur
    * @param void
    * @return void
    */
    public function staff($userId = null) {
        $this->set('title', __('Les staffs'));

        if($this->request->is('ajax')) {
            if(!is_null($userId)) {
                $player = $this->Players->findById($userId)
                ->select(['username', 'motto', 'last_online'])
                ->first();

                $player->motto = htmlspecialchars($player->motto);
                $player->last_online = __("Dernière connexion il y a {0}", (new Time($player->last_online))->timeAgoInWords(['format' => 'MMM d, YYY', 'end' => '+1 year']));
                die(json_encode($player));
            }
        }

        $this->loadModel('ServerPermissionsRanks');

        $ranks = $this->ServerPermissionsRanks->find()
        ->where([
            'id >=' => 5,
            'visible' => '1'
        ])
        ->all();

        $players = $this->Players->find()
        ->where(['rank >=' => 5,
                 'rank <' => 12
                ])
        ->all();

        $team = [];

        foreach($ranks as $rank) {
            $playerForRank = $players->filter(function($players, $index) use($rank) {
                return ($players->rank == $rank->id);
            });

            $team[$rank->name] = $playerForRank;
        }

        $team = array_reverse($team);

        $this->set(compact('team'));
    }

    /**
    * Page des architectes
    * @param
    * @return
    */
    public function architect() {
        $this->set('title', __('Les architectes'));

        if($this->request->is('ajax')) {
            if(!is_null($userId)) {
                $player = $this->Players->findById($userId)
                ->select(['username', 'motto', 'last_online'])
                ->first();

                $player->motto = htmlspecialchars($player->motto);
                $player->last_online = __("Dernière connexion il y a {0}", (new Time($player->last_online))->timeAgoInWords(['format' => 'MMM d, YYY', 'end' => '+1 year']));
                die(json_encode($player));
            }
        }

        $this->loadModel('ServerPermissionsRanks');

        $ranks = $this->ServerPermissionsRanks->find()
        ->where([
            'id >=' => 3,
            'id <=' => 5,
            'visible' => '1'
        ])
        ->all();

        $players = $this->Players->find()
        ->where(['rank >=' => 3,
                 'rank <=' => 5
                ])
        ->all();

        $architect = [];

        foreach($ranks as $rank) {
            $playerForRank = $players->filter(function($players, $index) use($rank) {
                return ($players->rank == $rank->id);
            });

            $architect[$rank->name] = $playerForRank;
        }

        $architect = array_reverse($architect);

        $this->set(compact('architect'));
    }

    /**
    * Affiche le client
    * @param void
    * @return void
    */
    public function client() {
        // Reload Bans
        $this->Spark->send("reload", [":type" => "bans"]);

        $this->set('title', __('Le Motel'));

    	$ssoTicket = sha1(uniqid());
    	$this->Players->updateAll(
    		['auth_ticket' => $ssoTicket],
    		['id' => $this->Auth->user('id')]
    	);

        $lastModified = strtotime("06-06-2018");
        $hour = date('H');

        if($this->Cookie->read('language') == "fr") {
            $flashVars = [
                "emulator" => [
                    "host"  => "151.80.42.229",
                    "port" => "31000",
                    "wsHost" => "ws.habbomotel.com",
                    "wsPort" => "8081",
                ],
                "furni" => [
                    "productdata" => "https://flash.habbomotel.in/gamedata/productdata.txt",
                    "furnidata" => "https://flash.habbomotel.in/gamedata/furnidata_fr.xml"
                ],
                "gordon" => [
                    "base" => "https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/",
                    "swf"  => "Habbo_cracked.swf"
                ],
                "gamedata" => [
                    "variables" => "http://flash.habbomotel.in/gamedata/external_variables.txt",
                    // 6h ~ 21h
                    "variables_override" => ($hour < 21 && $hour >= 6)
                        ?
                            "https://flash.habbomotel.in/gamedata/override/external_override_variables.txt"
                        :
                            "https://flash.habbomotel.in/gamedata/override/external_override_variables_night.txt",

                    "texts" => "https://flash.habbomotel.in/gamedata/external_flash_texts.txt",
                    "texts_override" => "https://flash.habbomotel.in/gamedata/override/external_flash_override_texts.txt",
                    'figuredata' => "https://flash.habbomotel.in/gamedata/figuredata.xml"
                ],
                "client" => [
                    "starting" => __("Patiente encore un peu.."),
                    "revolving" => __("ça mouline.. et ça mouline..")
                ]
            ];
        } else if($this->Cookie->read('language') == "dev") {
            $flashVars = [
                "emulator" => [
                    "host"  => "164.132.204.94",
                    "port" => "32000",
                    "wsPort" => "8083",
                ],
                "furni" => [
                    "productdata" => "https://flash.habbomotel.in/gamedata/productdata.txt",
                    "furnidata" => "https://flash.habbomotel.in/gamedata/furnidata_fr.xml"
                ],
                "gordon" => [
                    "base" => "https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/",
                    "swf"  => "Habbo_cracked.swf"
                ],
                "gamedata" => [
                    "variables" => "https://flash.habbomotel.in/gamedata/external_variables.txt",
                    // 6h ~ 21h
                    "variables_override" => ($hour < 21 && $hour >= 6)
                        ?
                            "https://flash.habbomotel.in/gamedata/override/external_override_variables.txt"
                        :
                            "https://flash.habbomotel.in/gamedata/override/external_override_variables_night.txt",

                    "texts" => "https://flash.habbomotel.in/gamedata/external_flash_texts.txt",
                    "texts_override" => "https://flash.habbomotel.in/gamedata/override/external_flash_override_texts.txt",
                    'figuredata' => "https://flash.habbomotel.in/gamedata/figuredata.xml"
                ],
                "client" => [
                    "starting" => __("Patiente encore un peu.."),
                    "revolving" => __("ça mouline.. et ça mouline..")
                ]
            ];
        } else {
            $flashVars = [
                "emulator" => [
                    "host"  => "151.80.42.229",
                    "port" => "30000",
                    "wsHost" => "ws.habbomotel.in",
                    "wsPort" => "8082"
                ],
                "furni" => [
                    "productdata" => "https://flash.habbomotel.in/gamedata/productdata.txt",
                    "furnidata" => "https://flash.habbomotel.in/gamedata/furnidata_pt.xml"
                ],
                "gordon" => [
                    "base" => "https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/",
                    "swf"  => "Habbo_cracked.swf"
                ],
                "gamedata" => [
                    "variables" => "https://flash.habbomotel.in/gamedata/external_variables_pt.txt",
                    // 6h ~ 18h
                    "variables_override" => ($hour < 18 && $hour >= 6)
                        ?
                            "https://flash.habbomotel.in/gamedata/override/external_override_variables.txt"
                        :
                            "https://flash.habbomotel.in/gamedata/override/external_override_variables_night.txt",
                    "texts" => "https://flash.habbomotel.in/gamedata/external_flash_texts_pt.txt",
                    "texts_override" => "https://flash.habbomotel.in/gamedata/override/external_flash_override_texts.txt",
                    'figuredata' => "https://flash.habbomotel.in/gamedata/figuredata.xml"
                ],
                "client" => [
                    "starting" => __("Patiente encore un peu.."),
                    "revolving" => __("ça mouline.. et ça mouline..")
                ]
            ];
        }

        $this->set(compact('flashVars', 'ssoTicket', 'lastModified'));

        $this->viewBuilder()->setLayout('client');
    }

    public function test() {
        $this->viewBuilder()->setLayout('');
    }

    /**
    * Page affiché lorsqu'une erreur est produite sur le client
    * @param
    * @return
    */
    public function error() {
        $this->set([
            'title' => __('Oops! Tu as été deconnecté de l\'hôtel'),
            'subtitle' => __('Une erreur est survenue durant ta navigation dans l\'hôtel')
        ]);

        $this->set('error', $this->request->getData());

        $this->viewBuilder()->setLayout('error');
    }
}
