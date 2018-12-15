<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class ForumThreadsTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('ForumCategories')
        ->setForeignKey('category_id');

        $this->belongsTo('Players')
        ->setForeignKey('player_id');

        $this->hasMany('ForumReplies')
        ->setForeignKey('thread_id')
        ->setDependent(true);

        $this->hasOne('ForumThreadsReads')
        ->setForeignKey('thread_id')
        ->setDependent(true);

        $this->addBehavior('CounterCache', [
            'ForumCategories' => [
                'thread_count'
            ]
        ]);
    }

    public function validationDefault(Validator $validator) {
        $validator->requirePresence(["name", "category_id"], "create");

        // Nom de la discussion
        $validator->notBlank("name", __("Tu dois définir un nom pour ta discussion."))
        ->lengthBetween("name", [10, 255], __("Le nom de la discussion doit faire plus de 10 caractères."));

        return $validator;
    }
}