<?php
namespace App\Event;

use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;

class TrophiesEventListener implements EventListenerInterface {

    public function implementedEvents() {
        return [
            'Model.Comments.add' => 'addComment'
        ];
    }

    /**
     * Gestion de l'évenement lié à l'ajout d'un commentaire
     * sous un article.
     * @param event et commentaire
     * @return Trophée et notification
     */
    public function addComment($event, $entity) {
        /**
         * La clé correspond à l'id du badge dans la table `trophies`
         * et la valeur de la clé correspond au nombre de commentaires pour obtenir le badge
         */
        $trophies = [
            1   => 1,
            2   => 50
        ];

        $comments = TableRegistry::get('Comments');
        $countComments = $comments->findByUserId($entity->player_id)->contain('Players')->count();

        foreach($trophies as $trophyId => $goal) {
            if($countComments >= $goal)
                $this->unlockTrophy($trophyId, $entity->player_id);
        }
    }

    /**
     * Débloque un trophée
     * @param TrophyId et userId
     * @return Trophée et notification
     */
    public function unlockTrophy($trophyId, $userId) {
        $trophiesUsers = TableRegistry::get('PlayerTrophies');
        $trophy = $trophiesUsers->find()
        ->where([
            'trophy_id' => $trophyId,
            'player_id'   => $userId
        ])
        ->first();

        if(is_null($trophy)) {
            // Notification
            EventManager::instance()->on(new NotificationsEventListener());
            EventManager::instance()->dispatch(new Event('TrophiesEvent.unlockTrophy', $this, ['trophy' => [
                'trophy_id' => $trophyId,
                'player_id'   => $userId
            ]]));

            $trophiesUsers->save($trophiesUsers->newEntity([
                'trophy_id' => $trophyId,
                'player_id'   => $userId
            ]));
        }
    }
}
