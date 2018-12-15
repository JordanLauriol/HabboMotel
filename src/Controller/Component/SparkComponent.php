<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;
use Cake\Core\Configure;

class SparkComponent extends Component
{
	public $components = ['Flash'];

	/*
	* Hôte, port et token pour communiquer avec l'émulateur
	*/
	private $host, $port, $token;

	/*
	* Routes d'accès à l'émulateur
	*/
	private $routes;

	public function initialize(array $config) {	
		$this->host = $config["host"];
		$this->port = $config["port"];
		$this->token = $config["token"];

		// Initialise les routes d'accès
		$this->_initializeRoutes();
	}

	/**
	* Initialise les routes d'accès à l'émulateur
	* @param
	* @return
	*/
	private function _initializeRoutes() {
		$this->routes = [
			"reloadPlayerData" => [
				"type" => "GET",
				"path" => "player/:id/reload"
			],
			"disconnectPlayer" => [
				"type" => "GET",
				"path" => "player/:id/disconnect"
			],
			"alertPlayer" => [
				"type" => "POST",
				"path" => "player/:id/alert"
			],
			"articlePublished" => [
				"type" => "GET",
				"path" => "player/article/all"
			],
			"articleCommented" => [
				"type" => "GET",
				"path" => "player/:id/article/comment"
			],
			"eventAlert" => [
				"type" => "POST",
				"path" => "player/eventalert"
			],
			"reload" => [
				"type"	=> "GET",
				"path" 	=> "system/reload/:type"
			],
			"notification" => [
				"type" => "POST",
				"path" => "player/notification"
			]
		];
	}

	/**
	* Remplace les paramètres dans une route
	* @param $params
	* @return
	*/
	private function _hydrateRoute($route, $params) {
		$route = $this->routes[$route];

		if(empty($params))
			return $route;

		foreach($params as $param => $value) {
			$route["path"] = str_replace($param, $value, $route["path"]);
		}

		return $route;
	}

	/**
	* Envoi d'un message à l'émulateur
	* @param $route, $params
	* @return
	*/
	public function send($route, $params = [], $query = []) {
		if(!array_key_exists($route, $this->routes)) {
			return $this->Flash->error(__("Une erreur est survenue (SparkComponent - Route invalide)"));
		}

		$route = $this->_hydrateRoute($route, $params);

		$http = new Client([
			"headers" => [
				"authToken" => $this->token
			]
		]);

		$url = sprintf("http://%s:%s/%s", $this->host, $this->port, $route["path"]);

		if($route["type"] == "GET")
			$response = $http->get($url, $query);
		else
			$response = $http->post($url, $query);

		$response = json_decode($response->body());

		if(isset($response->debug)) {
			if(Configure::read('debug'))
				$this->Flash->error($response->debug);
			return false;
		}

		if(isset($response->success)) {
			if(Configure::read('debug'))
				$this->Flash->success(__("DEBUG: L'action a été réalisé dans l'hôtel"));
			return true;
		}

		if(isset($response->error)) {
			if(Configure::read('debug'))
				$this->Flash->error($response->error);
			return false;
		}
	}
}
