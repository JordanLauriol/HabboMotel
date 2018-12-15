<?php
namespace App\Controller;

use Cake\Routing\Router;

class PrizesController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadModel('Players');

        $this->Auth->allow();
    }


    /**
     * Classement par animations remportées
     */
    public function events() {
        $this->set('title', __('Par animations'));

        $playersSortByEvents = $this->Players
        ->find()
        ->where(['rank <' => '3'])
        ->order(['anim_points' => 'DESC'])
        ->limit(15);

        $this->loadModel('RewardBadges');
        $rewardBadges = $this->RewardBadges->find('all')
        ->order(['chance' => 'ASC']);

        $this->set(compact('playersSortByEvents', 'rewardBadges'));
    }

    /**
     * Classement par fortune
     */
    public function wealth() {
        $this->set('title', __('Par fortune'));

        $playersSortByDiamonds = $this->Players
        ->find()
        ->where(['rank <' => '3'])
        ->order(['vip_points' => 'DESC'])
        ->limit(10);

        $playersSortByDuckets = $this->Players
        ->find()
        ->where(['rank <' => '3'])
        ->order(['activity_points' => 'DESC'])
        ->limit(10);

        $playersSortByCredits = $this->Players
        ->find()
        ->where(['rank <' => '3'])
        ->order(['credits' => 'DESC'])
        ->limit(10);

        $this->set(compact('playersSortByDiamonds', 'playersSortByDuckets', 'playersSortByCredits'));
    }
}
