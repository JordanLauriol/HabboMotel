<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Utility\Text;
use Cake\I18n\Time;

class NotificationsController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadModel('PlayerNotifications');
    }

    /**
     * Marque une notification comme étant lu
     * @param int ID de la notification
     * @return
     */
    public function read($notification) {
        $this->set('title', __('Historique des notifications'));

        $notification = $this->PlayerNotifications->find()
        ->where([
            'id'      => $notification,
            'player_id' => $this->Auth->user('id'),
            'is_read' => 0
        ])
        ->first();

        if(is_null($notification)) return $this->redirect($this->request->referer());

        $notification->is_read = 1;
        $this->PlayerNotifications->save($notification);
        return $this->redirect($this->request->referer());
    }

    /**
     * Liste toutes les notifications
     * @param
     * @return
     */
    public function history() {
        $this->set('title', __('Historique des notifications'));

        $notifications = $this->PlayerNotifications->findByPlayerId($this->Auth->user('id'))
        ->order(['created' => 'DESC'])
        ->all();

        $this->set(compact('notifications'));
    }

    /**
     * Marque toutes les notifications comme lu
     * @param
     * @return
     */
    public function clear() {
        $this->set('title', __('Historique des notifications'));

        $this->PlayerNotifications->updateAll([
            'is_read'   => 0,
            'is_read'   => 1
        ], ['player_id' => $this->Auth->user('id')]);

        $this->redirect($this->request->referer());
    }
}
