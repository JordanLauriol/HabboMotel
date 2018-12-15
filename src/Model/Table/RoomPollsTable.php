<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class RoomPollsTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
    }
}
