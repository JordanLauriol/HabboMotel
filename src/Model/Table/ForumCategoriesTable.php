<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class ForumCategoriesTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        
        $this->hasMany('ForumThreads')
        ->setForeignKey('category_id')
        ->setDependent(true);
    }
}