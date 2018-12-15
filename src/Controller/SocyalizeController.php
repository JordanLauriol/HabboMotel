<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Http\Client;

class SocyalizeController extends AppController {

   	public function initialize() {
   		parent::initialize();

   		$this->Auth->allow();
   	}

   	public function index() {

   	}

   	public function socyalize() {
   		$this->viewBuilder()->layout('');
   	}
}