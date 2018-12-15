<?php
namespace App\Controller;

use Cake\Routing\Router;

class ShareController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function facebook() {
    	if($this->request->is('ajax')) {
	        $share = $this->Share->find('all')
	        ->order('rand()')
	        ->first();

	        $search = ["{user_username}"];
	        $replace = [$this->Auth->user('username')];

	        $share->quote = str_replace($search, $replace, $share->quote);

	        die(json_encode($share));
	    }
    }

    public function reward() {
    	if($this->request->is('ajax')) {
            $this->loadModel('PlayerShares');
            $this->loadModel('Players');
            $this->loadModel('PlayerSubscriptions');

            // Vérifie que l'utilisateur n'a pas déjà partagé aujourd'hui
            $playerShare = $this->PlayerShares->findByPlayerId($this->Auth->user('id'))->first();
            if(!is_null($playerShare) && $playerShare->expire > time()) {
                die(json_encode([
                    "message" => __("Tu as déjà gagner ton cadeau du jour, reviens dans 24H pour ton prochain cadeau !"),
                    "type"    => "is-info"
                    ]
                ));
            }

    		$reward = $this->request->getQuery("reward");

            // Récompense: DUCKET
    		if($reward == "ducket") {
    			$player = $this->Players->get($this->Auth->user('id'));
    			$player->activity_points += $this->Cookie->read('language') == "fr" ? 10 : 10;

    			if($this->Players->save($player)) {
    				$this->Spark->send("reloadPlayerData", [":id" => $player->id]);

                    if(!is_null($playerShare))
                        $playerShare->expire = time() + 86400;
                    else
                        $playerShare = $this->PlayerShares->newEntity([
                            'player_id' => $this->Auth->user('id'),
                            'expire'    => time() + 86400
                        ]);

                    if($this->PlayerShares->save($playerShare)) {

                        // Add transaction
                        $this->_addTransaction($player->id, __("Gain de {duckets} duckets grâce au parrainage.", [
                            "duckets" => 10
                        ]));

                        die(json_encode([
                            'message' => __("Merci pour ta contribution sur HabboMotel, tu remportes 10 duckets que tu pourras dépenser dans la boutique du catalogue! Reviens demain pour gagner à nouveau ton cadeau !"),
                            'type'    => 'is-success'
                            ]
                        ));
                    }
    			}
    		}

            // Récompense: HC
            if($reward == "habboclub") {
                $subscription = $this->PlayerSubscriptions->findByUserId($this->Auth->user('id'))->first();

                // Détermine la durée du abonnement HC
                if(is_null($subscription))
                    $subscription = $this->PlayerSubscriptions->newEntity([
                        'type'      => 'habbo_club',
                        'start'     => time(),
                        'expire'    => time() + (3600 * 2),
                        'user_id'   => $this->Auth->user('id'),
                        'reward_hc' => 1
                    ]);
                else if($subscription->reward_hc == '0')
                    $subscription->expire = $subscription->expire > time() ? $subscription->expire + (3600 * 2) : time() + (3600 * 2);
                else
                    die(json_encode([
                        'message' => __("Merci pour ta contribution sur HabboMotel, malheureusement tu as déjà gagné 2h de HC auparavant. L'offre n'est pas cumulable."),
                        'type'    => 'is-danger'
                        ]
                    ));

                if($this->PlayerSubscriptions->save($subscription)) {
                    // On modifie les paramètres de l'utilisateur
                    $player = $this->Players->get($this->Auth->user('id'));
                    $player->credits += 5000;
                    $player->rank = 2;
                    $player->vip = '1';

                    if($this->Players->save($player)) {
                        // On enregistre le partage
                        if(!is_null($playerShare))
                            $playerShare->expire = time() + 86400;
                        else
                            $playerShare = $this->PlayerShares->newEntity([
                                'player_id' => $this->Auth->user('id'),
                                'expire'    => time() + 86400
                            ]);

                        if($this->PlayerShares->save($playerShare)) {
                            // On informe l'utilisateur de sa souscription
                            $this->Spark->send("reloadPlayerData", [
                                ":id" => $this->Auth->user('id')
                            ]);

                            // Add transaction
                            $this->_addTransaction($player->id, __("Abonnement au Habbo CLUB de 2H grâce au parrainage."));

                            die(json_encode([
                                'message' => __("Merci pour ta contribution sur HabboMotel, tu remportes un abonnement de 2H au HabboClub !"),
                                'type'    => 'is-success'
                                ]
                            ));
                        }
                    }
                }
            }
    	}
    }
}
