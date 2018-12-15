<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class PlayersTable extends Table {

    public function initialize(array $config) {
        //$this->addBehavior('Timestamp');

        $this->hasOne('PlayerSecurities')
        ->setForeignKey('player_id');

        $this->hasOne('PlayerNetworks')
        ->setForeignKey('player_id');
        
        $this->hasOne('PlayerSettings')
        ->setBindingKey('player_id')
        ->setForeignKey('player_id');
        
        $this->hasMany('PlayerIpaddresses')
        ->setForeignKey('player_id');

        $this->hasMany('PlayerNotifications')
        ->setForeignKey('player_id');
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['username'], __('Votre pseudonyme est déjà utilisé.')));
        $rules->add($rules->isUnique(['email'], __('Votre adresse e-mail est déjà utilisée.')));
        return $rules;
    }

    public function validationDefault(Validator $validator) {
        $validator->requirePresence(['username', 'password', 'email', 'legal'], 'create')
                  // Validation > username
                  ->notEmpty('username', __('Ton pseudonyme ne peut pas être vide.'))
                  ->lengthBetween('username', [3, 30], __('Ton pseudonyme doit faire entre 3 et 30 caractères.'))
                  ->add('username', 'regex', [
                      'rule'    => ['custom', '#^[a-z0-9-_=.@]*$#i'],
                      'message' => __('Ton pseudonyme peut être composé seulement de lettres, de chiffres et des caractères suivants: .-=_@.')
                  ])
                  // Validation > password
                  ->notEmpty('password', __('Ton mot de passe ne peut pas être vide.'))
                  ->lengthBetween('password', [6, 100], __('Ton mot de passe doit faire minimum 6 caractères.'))
                  // Validation > mail
                  ->email('email', true, __('Ton adresse e-mail doit être valide.'));

          $validator->requirePresence('password', 'update')
          ->lengthBetween('password', [6, 100], __('Ton mot de passe doit comprendre au moins 6 caractères et inclure des lettres et des chiffres.'));             

        return $validator;
    }
}
