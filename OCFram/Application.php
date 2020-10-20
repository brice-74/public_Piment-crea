<?php
namespace OCFram;
use OCFram\Router;

class Application{
	// Elle se sert du Router, pour voir s'il est capable de me retourner un objet Route
	private $route;
	// Grace a cette Route, l'Application va pouvoir instancier et retourner un controller
	private $controller;

	function __construct(Router $router){
		$this->route = $router->getRoute();
	}

	function getController(){
		if(!is_null($this->route)){
			$this->controller = $this->route->getNamespace()."\\".$this->route->getModule()."\Controller\\".$this->route->getAction();

			if($this->route->getLogged() === TRUE){
				
				if(!isset($_SESSION["auth"])){
					$this->controller = NULL;
				}else{
					if($_SESSION["auth"]["statut"] < $this->route->getDroits()){
						$this->controller = NULL;
					}
				}
			}
		}
		return isset($this->controller)? new $this->controller() : die(include("errors/404.php"));
	}

}
?>