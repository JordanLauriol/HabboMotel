<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PlayerTrophiesTable extends Table {

    public function initialize(array $config) {
        $this->belongsTo('Trophies');
    }
}
