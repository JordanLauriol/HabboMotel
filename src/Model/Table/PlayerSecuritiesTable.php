<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PlayerSecuritiesTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');

        $this->belongsTo('PlayerQuestions')
        ->setForeignKey('question_id');
    }

    public function validationDefault(Validator $validator) {
        $validator->requirePresence(['question_id', 'answer'])
                  // Validation > username
                  ->notEmpty('answer', __('La réponse ne peut pas être vide.'))
                  ->lengthBetween('answer', [2, 255], __('La réponse doit faire minimum 2 caractères.'));           

        return $validator;
    }
}
