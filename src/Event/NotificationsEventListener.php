<?php
namespace App\Event;

use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\View\Helper\UrlHelper;

class NotificationsEventListener implements EventListenerInterface {

    public function implementedEvents() {
        return [
            'TrophiesEvent.unlockTrophy' => 'unlockTrophy',
            'Comments.replyToArticle'    => 'replyToArticle',
            'Comments.mentionnedUser'    => 'mentionnedUser',
            'Avatars.newbie'             => 'newbieStatut',
            'ForumReplies.replyToThread' => 'replyToThread',
            'ForumReplies.mentionnedUser'=> 'replyAndMentionToThread'
        ];
    }

    /**
     * Déclenche une notification lors d'un nouveau trophée.$_COOKIE
     * @param event et trophé
     * @return Notification
     */
    public function unlockTrophy($event, $trophy) {
        $event->stopPropagation();

        $trophies = TableRegistry::get('Trophies');
        $qTrophy = $trophies->findById($trophy['trophy_id'])
        ->first();

        if(!is_null($qTrophy)) {
            $message = __('Tu as débloqué un nouveau trophée <b>{0}</b>', $qTrophy->title);
            $this->addNotification($trophy['player_id'], $message);
        }
    }

    /**
     * Déclenche une notification à l'auteur de l'article lorsqu'un commentaire est ajouté.$_COOKIE
     * @param event et article
     * @return Notification
     */
    public function replyToArticle($event, $article, $username, $location) {
        $event->stopPropagation();
        $message = __('<b>{0}</b> a commenté votre article: <i>{1}</i>', [$username, Text::truncate(mb_strtolower($article['title'], 'UTF-8'), 50)]);
        $this->addNotification($article['player']['id'], $message, $location);
    }

    /**
     * Déclenche une notification lorsqu'un utilisateur mentionne un autre utilisateur
     * @param event et article
     * @return Notification
     */
    public function mentionnedUser($event, $article, $username, $player, $location) {
        $event->stopPropagation();
        $message = __('<b>{0}</b> vous a mentionné dans l\'article: <i>{1}</i>', [$username, Text::truncate(mb_strtolower($article['title'], 'UTF-8'), 50)]);
        $this->addNotification($player['id'], $message, $location);
    }

    /**
    * Déclenche une notification lorsqu'un utilisateur à fini le guide
    */
    public function newbieStatut($event, $player) {
        $event->stopPropagation();
        $message = __('<b>{0}</b>, bienvenue sur HabboMotel, rejoins-nous vite en te connectant dans l\'hôtel.', $player["username"]);
        $this->addNotification($player['id'], $message);
    }

    /**
    * Déclenche une notification lorsqu'un quelqu'un à commenter une discussion dans laquelle l'utilisateur participe
    * @param Event $event
    * @param Player $player
    */
    public function replyToThread($event, $thread, $username, $userId, $location) {
        $event->stopPropagation();
        $message = __("<b>{0}</b> à répondu à la discussion <i>{1}</i>", [
            $username,
            Text::truncate(mb_strtolower($thread["name"], "UTF-8"), 50)
        ]);

        $playerToSend = [];

        foreach($thread->forum_replies as $reply) {
            if($reply->player_id == $userId)
                continue;

            if(!in_array($reply->player_id, $playerToSend))
                array_push($playerToSend, $reply->player_id);
            else
                continue;

            $this->addNotification($reply->player_id, $message, $location);
        }
    }

    /**
     * Déclenche une notification lorsqu'un utilisateur mentionne un autre utilisateur
     * @param event et article
     * @return Notification
     */
    public function replyAndMentionToThread($event, $thread, $username, $player, $location) {
        $event->stopPropagation();
        $message = __('<b>{0}</b> vous a mentionné dans dans la discussion: <i>{1}</i>', [$username, Text::truncate(mb_strtolower($thread['name'], 'UTF-8'), 50)]);
        $this->addNotification($player['id'], $message, $location);
    }

    /**
     * Ajoute une nouvelle notification
     * @param userId et message
     * @return Notification
     */
    public function addNotification($playerId, $message, $location = null) {
        $notifications = TableRegistry::get('PlayerNotifications');
        $notifications->save($notifications->newEntity([
            'player_id'     => $playerId,
            'message'       => $message,
            'location'      => $location
        ]));
    }
}
