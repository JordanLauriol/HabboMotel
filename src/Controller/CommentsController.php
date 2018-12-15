<?php
namespace App\Controller;

use Cake\Routing\Router;

class CommentsController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Supprime un commentaire
     * @param Commentaire
     * @return
     */
    public function delete($comment) {
        if($this->request->is('ajax')) {
            $comment = $this->Comments->findById($comment)
            ->contain('Players')
            ->first();

            if(is_null($comment))
                return $this->redirect($this->request->referer());

            if($comment->player->id == $this->Auth->user('id') || $this->Auth->user('rank') > 3) {
                $this->Comments->delete($comment);
                $this->Flash->success(__("Ton commentaire a été supprimé."));
                return $this->redirect($this->request->referer());
            }
        }

        return $this->redirect($this->request->referer());
    }
}
