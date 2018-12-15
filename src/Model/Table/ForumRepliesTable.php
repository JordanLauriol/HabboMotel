<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class ForumRepliesTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('ForumThreads')
        ->setForeignKey('thread_id');

        $this->belongsTo('Players')
        ->setForeignKey('player_id');

        $this->addBehavior('CounterCache', [
		    'ForumThreads' => [
		        'reply_count'
		    ],
            'Players' => [
                'forum_reply_count'
            ]
		]);
    }
}