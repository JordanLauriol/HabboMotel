<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Event\Event;

class ShopController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->Auth->allow();

        $this->Auth->deny([
            "transactions"
        ]);

        $this->loadModel("Players");
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Security->setConfig('unlockedActions', [
            'diamonds'
        ]);

        $this->eventManager()->off($this->Csrf);
    }

    /**
    * Présentation de la boutique
    * @param
    * @return
    */
    public function index() {
    	$this->set("title", __("Comprendre notre économie"));
    	$this->set("description", __("HabboMotel possède une économie structurée et réfléchie pour apporter une réelle valeur aux mobis et badges en circulation dans l'hôtel afin de dynamiser le troc et les casinos."));
    }

    /**
    * Achat de diamants
    * @param
    * @return
    */
    public function diamonds() {
        if($this->request->is("post")) {
            $code = $this->request->getData("code") != null ? $this->request->getData("code") : "";

            if(empty($code)) {
                $this->Flash->error(__("Le code que tu as inséré est invalide."));
            } else {
                 $player = $this->Players->findById($this->Auth->user("id"))
                 ->first();

                 if(!is_null($player)) {
                    $dedipass = file_get_contents('https://api.dedipass.com/v1/pay/?public_key=3fd3ce75d7b1577a94b316afd539474d&private_key=0ca59dfcef385e2029171fbceea1140525335814&code=' . $code); 
                    $dedipass = json_decode($dedipass);

                    if($dedipass->status == "success") {
                        $diamonds = $dedipass->virtual_currency;
                        $player->vip_points += $diamonds;

                        if($this->Players->save($player)) {
                            $this->Spark->send("reloadPlayerData", [":id" => $player->id]);

                            $this->Flash->success(__("Ton compte a été crédité de {diamonds} diamants.", [
                                "diamonds" => $diamonds
                            ]));

                            $this->_addTransaction($player->id, __("Tu as acheté {diamonds} diamants.", [
                                "diamonds"  => $diamonds
                            ]));

                            return $this->redirect(["action" => "diamonds"]);
                        }
                    } else {
                        $this->Flash->error(__("Le code que tu as inséré est invalide."));
                    }
                 }
            }
        }

        $this->set("title", __("Acheter des diamants"));
    }

    /**
    * Transaction réalisée dans la boutique
    * @param
    * @return
    */
    public function transactions() {
        $this->loadModel("PlayerTransactions");

        $transactions = $this->PlayerTransactions->find("all")
        ->where(["player_id" => $this->Auth->user("id")])
        ->order(["id" => "DESC"]);

        $this->set(compact("transactions"));
        $this->set("title", __("Historique des transactions"));
    }
}

