<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class TrophiesTable extends Table {

    public function initialize(array $config) {
        $this->belongsTo('PlayerTrophies');
    }
}
