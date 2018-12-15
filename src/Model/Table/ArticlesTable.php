<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class ArticlesTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Categories')
        ->setForeignKey('category_id');

        $this->belongsTo('Players')
        ->setForeignKey('author_id');

        $this->hasMany('Comments')
        ->setDependent(true);
    }

    public function buildRules(RulesChecker $rules) {
    	return $rules;
    }

    public function validationDefault(Validator $validator) {
        $validator->requirePresence(['title', 'body', 'button', 'topstory'])
                  // Validation > title
                  ->notEmpty('title', __("Le titre de l'article ne peut pas être vide."))
                  ->lengthBetween('title', [30, 255], __("Ton titre doit faire minimum 30 caractères"))
     
                  // Validation > button
                  ->notEmpty('button', __("La phrase du bouton ne peut pas être vide."))
                  ->lengthBetween('button', [10, 50], __("La phrase doit faire minimum 10 caractères"))

                  // Validation > topstory
                  ->notEmpty('topstory', __("L'image de couverture ne peut pas être vide."))
                 
                  ->notEmpty('body', __("Le contenu de l'article ne peut pas être vide."));             

        return $validator;
    }
}