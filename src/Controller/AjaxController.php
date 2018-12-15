<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\Validation\Validator;

class AjaxController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->Auth->allow();
    }

    public function beforeRender(Event $event) {
        parent::beforeRender($event);

        $this->viewBuilder()->setLayout('');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Security->setConfig('unlockedActions', [
            'profileInformationComposer',
            'profileSocialComposer',
            'listCommandsComposer',
            'notificationsComposer',
            'notificationsSettings',
            'roomPollComposer',
            'managePollComposer',
            'createPoll',
            'inProgressPoll',
            'historyPoll',
            'itemInformationComposer',
            'rateItemById',
            'ratePlayerById',
            'roomRuleComposer',
            'createRules',
            'displayRules',
            'promoteRoomComposer',
            'createPromote',
            'habboClub',
            'habboClubCenter',
            'eventAlert',
            'earnHabboClub',
            'advantagesHabboClub',
            'subscribeHabboClub'
        ]);

        $this->eventManager()->off($this->Csrf);
    }

    /**
    * Affiche les informations d'un profile
    */
    public function profileInformationComposer() {
        if($this->request->is('post')) {
            $this->loadModel('Players');

            // Données liées à l'utilisateur
            $message = $this->request->getData('message');
            
            $network = $this->Players->PlayerNetworks->findByPlayerId($message['user']['id'])->first();
            if(is_null($network)) {
                die('null');
            }

            $this->set(compact('message'));
        }
    }

    /**
    * Affiche le profile social de l'utilisateur
    */
    public function profileSocialComposer() {
        if($this->request->is('post') && $this->request->is('ajax')) {
            // Données liées à l'utilisateur
            $message = $this->request->getData('message');

            $this->loadModel('MessengerFriendships');
            $this->loadModel('Trophies');
            $this->loadModel('Players');
            $this->loadModel('PlayerRates');

            $network = $this->Players->PlayerNetworks->findByPlayerId($message['user']['id'])->first();
            if(is_null($network)) {
                die('null');
            }
            
            $trophies = $this->Trophies->find('all')->count();
            $playerTrophies = $this->Trophies->PlayerTrophies->find('all')->where(['player_id' => $message['user']['id']])->count();

            $areFriend = $this->MessengerFriendships->find()
            ->where([
                'user_one_id' => $message['user']['id'],
                'user_two_id' => $message['me']['id']
            ])
            ->orWhere([
                'user_one_id' => $message['me']['id'],
                'user_two_id' => $message['user']['id']
            ])
            ->first();

            $friends = $this->MessengerFriendships->find()
            ->where([
                'user_one_id' => $message['user']['id']
            ])
            ->orWhere([
                'user_two_id' => $message['user']['id']
            ])
            ->count();

            $player = $this->Players->findById($message['user']['id'])->first();

            $myRate = $this->PlayerRates->find()
            ->where([
                'receiver_id'   => $message["user"]["id"],
                'sender_id'     => $message["me"]["id"]
            ])
            ->first();

            $rate = $this->PlayerRates->find('all');
            $rate->select([
                'avg' => $rate->func()->avg('rate')
            ])
            ->where([
                'receiver_id'   => $message["user"]["id"]
            ]);

            $ratesCount = $this->PlayerRates->find()
            ->where(['receiver_id' => $message["user"]["id"]])
            ->all();

            $avg = 0;
            foreach ($rate as $row) {
                $avg = floor($row['avg']);
            }

            $this->set(compact('message', 'areFriend', 'friends', 'player', 'trophies', 'playerTrophies', 'myRate', 'ratesCount', 'avg', 'network'));
        }
    }

    /**
     * Evalue un utilisateur pour sa côte de popularité
     * @param {UserComposer} - données envoyées par le serveur
     */
    public function ratePlayerById() {
        if($this->request->is('post') && $this->request->is('ajax')) {
            $this->loadModel('PlayerRates');

            $message = $this->request->getData('message');
            $note = $this->request->getData('rate');

            $rate = $this->PlayerRates->find()->where([
                'receiver_id'   => $message["user"]["id"],
                'sender_id'     => $message["me"]["id"]
            ])->first();

            if(is_null($rate)) {
                $rate = $this->PlayerRates->newEntity([
                    'receiver_id'   => $message['user']['id'],
                    'sender_id'     => $message['me']['id'],
                    'rate'      => $note
                ]);

                $this->PlayerRates->save($rate);
            }
        }
    }

    /**
    * Liste des commandes disponible dans l'hôtel
    */
    public function listCommandsComposer() {
        if($this->request->is('post')) {       
            // Données liées aux commandes
            $message = $this->request->getData('message');
            
            $user = $hc = $staff = [];
            foreach($message['commands'] as $k => $commands) {
                foreach($commands as $command => $parameters) {

                    // Sort command by rank
                    $cmd = substr($command, 1);

                    switch((int)$parameters["permission"]) {
                        case 1: {
                            $user[$cmd] = $parameters;
                            ksort($user);
                            break;
                        }
                        case 2: {
                            $hc[$cmd] = $parameters;
                            ksort($hc);
                            break;
                        }
                        default: {
                            $staff[$cmd] = $parameters;
                            ksort($staff);
                            break;
                        }
                    }
                }
            }

            $this->set(compact('message', 'user', 'hc', 'staff'));
        }
    }

    /**
    * Affichage des notifications
    */
    public function notificationsComposer() {
        if($this->request->is('post')) {
            $this->loadModel('Notifications');

            // Message du NotificationComposer
            $message = $this->request->getData('message');

            $notification = $this->Notifications->findByType($message["notification"]["type"])->first();

            if(is_null($notification)) return;
            
            $patterns = "/({(.*?)})/";

            if(isset($message["parameters"])) {
                $replace = $message["parameters"];

                preg_match_all($patterns, $notification->message, $matches);
                foreach($matches[2] as $matche) {
                    if(array_key_exists($matche, $replace)) {
                        $notification->message = str_replace("{" . $matche . "}", htmlspecialchars($replace[$matche]), $notification->message);
                    }
                }
                
                preg_match_all($patterns, $notification->follow, $matches);
                foreach($matches[2] as $matche) {
                    if(array_key_exists($matche, $replace)) {
                        $notification->follow = str_replace("{" . $matche . "}", $replace[$matche], $notification->follow);
                    }
                }
            }

            $this->set(compact('message', 'notification'));
        }
    }

    /**
    * Paramètres des notifications
    */
    public function notificationsSettings() {
        $this->loadModel('Players');
        
        if($this->request->is('ajax')) {
            $message = $this->request->getQuery('message');

            $userId = (isset($message["parameters"]["receiver_id"])) ? $message["parameters"]["receiver_id"] : $this->Auth->user('id');

            $playerSettings = $this->Players->PlayerSettings->findByPlayerId($userId)->first();

            $json = [
                "sounds" => false
            ];

            if(is_null($playerSettings)) {
                die(json_encode($json));
            } else {
                if($playerSettings->allow_sounds == "1") {
                    $json["sounds"] = true;
                }

                die(json_encode($json));
            }
        }
    }

    /**
    * Affichage du sondage en cour
    */
    public function roomPollComposer() {
    }

    /**
    * Affichage des paramètres des sondages
    */
    public function managePollComposer()
    {
        if($this->request->is('post')) {
            $message = $this->request->getData('message');
            $this->set(compact('message'));
        }
    }

    /**
    * Création d'un sondage dans un appartement
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function createPoll() {
        if($this->request->is('post') && $this->request->is('ajax')) {
            // Données envoyées au JS.
            $response = [];
            // Message du RoomComposer.
            $message = $this->request->getData('message');
            // Données du formulaire
            $data = $this->request->getData('data');

            // Règles de validation du formulaire
            $validator = new Validator();
            $validator
            ->requirePresence('question')
            ->notEmpty('question', __('Ta question ne peut pas être vide.'))
            ->lengthBetween('question', [10, 255], __('Ta question doit faire plus de 10 caractères.'));

            if($message['user']['owner']) {
                $errors = $validator->errors($data);
                if(!empty($errors)) {
                    foreach($errors["question"] as $rule => $message) {
                        $response = [
                            "text" => $message,
                            "type" => "is-danger"
                        ];
                    }
                } else {
                    $this->loadModel("RoomPolls");
                    $this->loadModel('Rooms');

                    $room = $this->Rooms->findById($message["room"]["id"])->first();

                    if(!is_null($room) && $room->owner_id != $message["user"]["id"]) {
                         $response = [
                            "text" => __("Tu dois être le propriétaire de l'appartement pour lancer un sondage."),
                            "type" => "is-danger"
                        ];
                    } else {                    
                        $this->RoomPolls->updateAll([
                            "enabled" => "0"
                        ], [
                            "player_id" => $message["user"]["id"],
                            "room_id" => $message["room"]["id"],
                            "enabled" => "1"
                        ]);

                        $poll = $this->RoomPolls->newEntity();
                        $poll->room_id = $message["room"]["id"];
                        $poll->player_id = $message["user"]["id"];
                        $poll->question = htmlentities($data["question"]);

                        if($this->RoomPolls->save($poll)) {
                            $response = [
                                "text" => __("Ton sondage a été lancé dans ton appartement."),
                                "type" => "is-success"
                            ];
                        }
                    }
                }
            } else {
                $response = [
                    "text" => __("Tu dois être le propriétaire de l'appartement pour lancer un sondage."),
                    "type" => "is-danger"
                ];
            }

            die(json_encode($response));
        }
    }

    /**
    * Gestion du sondage en cours dans un appartement
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function inProgressPoll() {
        $this->loadModel('RoomPolls');
        // Données envoyées au JS
        $response = [];

        if($this->request->is('post') && $this->request->is('ajax')) {
            $message = $this->request->getData('message');

            if($message['user']['owner']) {
                $this->RoomPolls->updateAll([
                    "enabled" => "0"
                ], [
                    "player_id" => $message["user"]["id"],
                    "room_id" => $message["room"]["id"],
                    "enabled" => "1"
                ]);

                $response = [
                    "text" => __("Tu as arrêté ton sondage, les Habbos ne peuvent plus voter."),
                    "type" => "is-success"
                ];

                die(json_encode($response));
            }
        }

        // Message du RoomComposer.
        $message = $this->request->query('message');
        // Sondage en cours dans l'appartement
        $poll = $this->RoomPolls->find()
        ->where([
            'room_id' => $message['room']['id'],
            'player_id' => $message['user']['id'],
            'enabled' => '1'
        ])
        ->first();

        $this->set(compact('poll'));
    }

    /**
    * Historique des sondages de l'appartement
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function historyPoll() {
        $this->loadModel('RoomPolls');

        if($this->request->is('post') && $this->request->is('ajax')) {
            $this->RoomPolls->deleteAll([
                'id' => $this->request->getData('poll')
            ]);
        }

        $message = $this->request->query('message');
        $polls = $this->RoomPolls->find('all')
        ->where([
            'room_id' => $message['room']['id'],
            'player_id' => $message['user']['id'],
            'enabled' => '0'
        ])
        ->order([
            'id' => 'DESC'
        ]);

        $this->set(compact('polls', 'message'));
    }

    /**
     * Affiche les détails du mobilier
     * @param {ItemComposer} - Données envoyées par le serveur
     */
    public function itemInformationComposer() {
        if($this->request->is('post') && $this->request->is('ajax')) {
            $this->loadModel("CatalogItems");
            $this->loadModel("Items");
            $this->loadModel('ItemsRates');

            $message = $this->request->getData('message');
            
            
            $furniture = $this->CatalogItems->find()
            ->where(['item_ids' => $message["item"]["id"]])
            ->contain('Furniture')
            ->first();

            $items = $this->Items->findByBaseItem($message["item"]["id"])
            ->all();

            $itemsCount = $items->countBy(function($items) {
                return $items->room_id == 0 ? 'inventory' : 'room';
            })->toArray();

            $myRate = $this->ItemsRates->find()
            ->where([
                'item_id'   => $message["item"]["id"],
                'player_id' => $message["user"]["id"]
            ])
            ->first();

            $rate = $this->ItemsRates->find('all');
            $rate->select([
                'avg' => $rate->func()->avg('rate')
            ])
            ->where([
                'item_id'   => $message["item"]["id"]
            ]);

            $avg = 0;
            foreach ($rate as $row) {
                $avg = floor($row['avg']);
            }

            $this->set(compact('message', 'furniture', 'items', 'itemsCount', 'myRate', 'avg'));
        }
    }

    /**
     * Evalue un mobis entre 1 et 5
     * @param Int {ItemId}
     * @param Int {Rate} 1 > 5
     */
    public function rateItemById() {
        if($this->request->is('post') && $this->request->is('ajax')) {
            $this->loadModel('ItemsRates');
            
            $message = $this->request->getData('message');
            $note = $this->request->getData('rate');

            $rate = $this->ItemsRates->find()->where([
                'item_id'   => $message["item"]["id"],
                'player_id' => $message["user"]["id"]
            ])->first();

            if(is_null($rate)) {
                $rate = $this->ItemsRates->newEntity([
                    'item_id'   => $message['item']['id'],
                    'player_id' => $message['user']['id'],
                    'rate'      => $note += 1
                ]);

                $this->ItemsRates->save($rate);
            }
        }
    }

    /**
    * Définit les règles d'un appartement
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function roomRuleComposer() {
        if($this->request->is('ajax')) {
            $this->loadModel('Rooms');

            // Données envoyées au JS
            $response = [];

            // Message du RoomComposer.
            $message = $this->request->getData('message');

            $room = $this->Rooms->findById($message["room"]["id"])->first();
            if(is_null($room)) return;

            $this->set(compact('room'));
        }
    }

    /**
    * Permet de créer un règlement dans un appartement
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function createRules() {
        if($this->request->is('ajax') && $this->request->is('post')) {
            $this->loadModel('Rooms');

            // Données envoyées au JS
            $response = [];

            // Message du RoomComposer.
            $message = $this->request->getData('message');

            // Données du formulaire
            $data = $this->request->getData('data');

            if(is_null($this->Auth->user('id'))) {
                $response = [
                    "text" => __("Tu dois être connecté sur le site pour utiliser cette fonctionnalité."),
                    "type" => "is-danger"
                ];
            } else {
                if($this->Auth->user('rank') < 5) {
                    $response = [
                        "text" => __("Tu n'as pas le rang requis pour utiliser cette fonctionnalité."),
                        "type" => "is-danger"
                    ];
                } else {
                    $room = $this->Rooms->findById($message["room"]["id"])->first();
                    if(is_null($room)) return;

                    if(strlen($data['rules']) == 0)
                        $data['rules'] = null;

                    $room->rules = $data['rules'];
                    if($this->Rooms->save($room)) {
                        if(strlen($data['rules']) > 0) {
                            $response = [
                                "text" => __("Le règlement de ton appart a été défini."),
                                "type" => "is-success"
                            ];
                        } else {
                            $response = [
                                "text" => __("Le règlement de ton appart a été désactivé."),
                                "type" => "is-warning"
                            ];
                        }
                    } else {
                        $response = [
                            "text" => __("Une erreur est survenue lors de la sauvegarde du règlement."),
                            "type" => "is-danger"
                        ];
                    }
                }
            }

            die(json_encode($response));
        }
    }

    /**
    * Permet d'afficher les règles d'un appartement
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function displayRules() {
        if($this->request->is('ajax') && $this->request->is('post')) {
            $this->loadModel('Rooms');

            // Message du RoomComposer.
            $message = $this->request->getData('message');

            $room = $this->Rooms->findById($message["room"]["id"])->first();
            if(is_null($room)) return;
            
            $search = ["<script", "<meta"];
            $replace = ["", ""];

            $room->rules = str_replace($search, $replace, $room->rules);

            $this->set(compact('room'));
        }
    }

    /**
    * Permet d'afficher les promotions
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function promoteRoomComposer() {
        if($this->request->is('ajax') && $this->request->is('post')) {
            // Message du RoomComposer.
            $message = $this->request->getData('message');

            $this->loadModel('Promotions');
            $promotions = $this->Promotions->find('list');

            $this->set(compact('promotions'));
        }
    }

    /**
    * Créer une promotion
    * @param {RoomComposer} - Données envoyées par le serveur
    */
    public function createPromote() {
        if($this->request->is('ajax') && $this->request->is('post')) {
            // Données envoyées au JS
            $response = [];

            // Message du RoomComposer.
            $message = $this->request->getData('message');

            // Données du formulaire
            $data = $this->request->getData('data');

            if(is_null($this->Auth->user('id'))) {
                $response = [
                    "text" => __("Tu dois être connecté sur le site pour utiliser cette fonctionnalité."),
                    "type" => "is-danger"
                ];

                die(json_encode($response));
            }

            if($this->Auth->user('rank') < 2) {
                $response = [
                    "text" => __("Tu dois être membre du Habbo Club pour utiliser cette fonctionnalité."),
                    "type" => "is-danger"
                ];

                die(json_encode($response));
            }

            if($this->Auth->user('vip_points') < 10) {
                $response = [
                    "text" => __("Tu n'as pas assez de diamants pour utiliser cette fonctionnalité."),
                    "type" => "is-danger"
                ];

                die(json_encode($response));
            }

            $this->_addTransaction($this->Auth->user("id"), __("Achat d'une promotion d'apparts à 10 diamants."));

            $response = [
                "text" => __("Tous les Habbos connectés ont reçu une notification."),
                "type" => "is-success"
            ];
            
            die(json_encode($response));
        }
    }

    /**
    * Affiche le statut d'un abonnement
    * @param (HabboClubComposer)
    * @return
    */
    public function habboClub() {
        if($this->request->is('ajax')) {
            $message = $this->request->getQuery('message');

            $this->loadModel('PlayerSubscriptions');
            $this->loadModel('Players');

            $subscription = $this->PlayerSubscriptions->findByUserId($message["user"]["id"])->first();

            $response = [];

            if(is_null($subscription)) {
                $response["state"] = __("Rejoins-nous");
            } else {
                $timeLeft = $subscription->expire - time();

                // Expiré
                if($timeLeft <= 0) {
                    $response["state"] = __("Rejoins-nous");

                    $player = $this->Players->get($message["user"]["id"]);
                    if(!is_null($player) && $player->vip == '1' && $player->rank <= 2) {
                        $player->vip = '0';
                        $player->rank = 1;
                        $player->credits += 5000;

                        if($this->Players->save($player)) {
                            $this->Spark->send("reloadPlayerData", [
                                ":id" => $player->id
                            ]);
                        }
                    }
                } else {
                    $days = floor($timeLeft / 86400);

                    // Hours
                    if($days < 1) {
                        $hours = floor($timeLeft / (60 * 60));

                        // Minutes
                        if($hours < 1) {
                            $minutes = ceil($timeLeft / 60);
                            $response["state"] = sprintf(__("%s minutes"), $minutes);
                        } else {
                            $response["state"] = sprintf(__("%s heures"), ceil($timeLeft / (60 * 60)));
                        }
                    }
                    // Months 
                    else if($days > 31) {
                        $months = floor($days / 31);
                        $response["state"] = sprintf(__("%s mois"), $months);
                    // Days
                    } else {
                        $response["state"] = sprintf(__("%s jours"), $days);
                    }
                }
            }

            die(json_encode($response));
        }
    }

    /**
    * Habbo Club Center
    * @param (HabboClubComposer)
    * @return
    */
    public function habboClubCenter() {
         if($this->request->is('ajax')) {
            $message = $this->request->getQuery('message');

            $this->loadModel('PlayerSubscriptions');
            $this->loadModel('Players');
            $subscription = $this->PlayerSubscriptions->findByUserId($message["user"]["id"])->first();
            $player = $this->Players->findById($message["user"]["id"])->first();

            $this->set(compact('player'));
        }
    }

    /**
    * Alerte pour les évenements
    * @param {UserComposer}
    * @return
    */
    public function eventAlert() {
        if($this->request->is('ajax') && $this->request->is('post')) {
            $message = $this->request->getData('message');
            $this->set(compact('message'));
        }
    }

    /**
    * Gagner deux heures de HabboCLUB
    * @param {HabboClubComposer}
    * @return
    */
    public function earnHabboClub() {
        if($this->request->is('ajax')) {
            $message = $this->request->getQuery('message');
            
            $this->loadModel('Players');
            $player = $this->Players->get($message["user"]["id"]);

            $this->set(compact('message', 'player'));
        }
    }

    /**
    * Liste des avantages du HabboCLUB
    * @param {HabboClubComposer}
    * @return
    */
    public function advantagesHabboClub() {
        if($this->request->is('ajax')) {
            $message = $this->request->getQuery('message');
            $this->set(compact('message'));
        }
    }

    /**
    * Achat d'un abonnement au HabboCLUB
    * @param {HabboClubComposer}
    * @param string Period
    * @return
    */
    public function subscribeHabboClub() {
        if($this->request->is("ajax") && $this->request->is("post")) {
            $message = $this->request->getData("message");
            $period = $this->request->getData("period") == 31 ? 31 : 14;
            $cost = $period == 31 ? 50 : 30;

            $this->loadModel('PlayerSubscriptions');
            $this->loadModel('Players');
            $this->loadModel('PlayerBadges');

            $player = $this->Players->findById($message["user"]["id"])
            ->first();

            if(is_null($player)) {
                die(json_encode([
                    "message"   => __("Une erreur est survenue avec votre compte."),
                    "type"      => "is-danger"
                ]));
            }

            if($cost > $player->vip_points) {
                die(json_encode([
                    "message"   => __("Tu n'as pas {diamonds} diamants dans ton porte-monnaie pour adhérer au HabboCLUB", [
                        "diamonds" => $cost
                    ]),
                    "type"      => "is-danger"
                ]));
            }


            $subscription = $this->PlayerSubscriptions->findByUserId($message["user"]["id"])->first();

            // Jamais eu d'abonnement au HC
            if(is_null($subscription)) {
                $subscription = $this->PlayerSubscriptions->newEntity([
                    "type"    => "habbo_club",
                    "user_id" => $message["user"]["id"],
                    "start"   => time(),
                    "expire"  => time() + (86400 * $period)
                ]);
                $this->PlayerSubscriptions->save($subscription);
            } else {
                $subscription->expire += (86400 * $period);
                $this->PlayerSubscriptions->save($subscription);
            }

            $badge = $this->PlayerBadges->findByPlayerId($player->id)
            ->where(['badge_code' => 'HC2'])
            ->first();

            if(is_null($badge)) {
                $this->PlayerBadges->save($this->PlayerBadges->newEntity([
                    'player_id'     => $player->id,
                    'badge_code'    => 'HC2'
                ]));
            }
            // Réduction des diamants
            $player->vip_points -= $cost;           
            $player->rank = 2;
            $player->vip = '1';

            if($this->Players->save($player)) {
                // Met à jour son compte
                $this->Spark->send("reloadPlayerData", [
                    ":id" => $player->id
                ]);

                // Ajoute une transaction
                $this->_addTransaction($player->id, __("Souscription à un abonnement HC de {days} jours pour {cost} diamants", [
                    "days" => $period,
                    "cost" => $cost
                ]));

                die(json_encode([
                    "message" => __("Félicitations, tu viens de souscrire à un abonnement au Habbo CLUB de {days} jours.", [
                        "days" => $period
                    ]),
                    "type"    => "is-success"
                ]));
            }
        }
    }
}
