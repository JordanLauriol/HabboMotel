<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PlayerNetworksTable extends Table {

    public function initialize(array $config) {
        $this->hasOne('PlayerTmps')
        ->setBindingKey('player_id')
        ->setForeignKey('player_id')
        ->setDependent(true);
    }

    /**
    * Définition des différentes règles de modification des champs d'un formulaire
    * dans la base de données
    */
    public function validationDefault(Validator $validator) {

        $validator->add('picture', [
            'extensions' => [
                'rule'    => ['extension', ['png', 'jpeg', 'jpg']],
                'message' => __('Les extensions autorisées sur la plateforme sont: jpg, jpeg et png.')
            ],
            'fileSize' => [
                'rule' => ['fileSize', '<', '2MB'],
                'message' => __('La taille de l\'image est supérieur a 2MO.')
            ]
        ])
        ->allowEmpty('picture');

        return $validator;
    }
}