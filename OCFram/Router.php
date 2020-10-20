<?php 
namespace OCFram;
use OCFram\Route;
use OCFram\HTTPRequest;

class Router {

	private $routes;
	private $uri;

	function __construct(Array $routes){
		$this->routes 	= $routes;
		$http 			= new HTTPRequest();
		$this->uri 		= $http->getUri();
	}
	// Méthode personnalisé permettant de récuperer la bonne route dans toutes celles récuperer dans route.php
	function getRoute (){
		foreach ($this->routes as $route) {
			if (preg_match("/^".str_replace("/","\/",$route["url"])."$/",str_replace("%20"," ",str_replace("&amp;","&",$this->uri)))) {
				return new Route($route);
			}
		}
	}
}

?>