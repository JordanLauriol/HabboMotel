<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CatalogItemsTable extends Table {

    public function initialize(array $config) {       
        $this->belongsTo('Furniture')
        ->setForeignKey('item_ids');
    }
}