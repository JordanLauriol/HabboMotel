<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Event\Event;
use Cake\Validation\Validator;

class CommentsTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');

        $this->belongsTo('Players')
        ->setForeignKey('player_id');

        $this->belongsTo('Articles');
    }

    public function validationDefault(Validator $validator) {
        $validator->requirePresence('body')
                  ->notEmpty('body', __('Ton commentaire ne peut pas être vide.'))
                  ->lengthBetween('body', [3, 500], __('Ton commentaire doit être compris entre 3 et 500 caractères.'));

        return $validator;
    }
}
