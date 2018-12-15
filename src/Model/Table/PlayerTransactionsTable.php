<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Event\Event;

class PlayerTransactionsTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
    }
}
