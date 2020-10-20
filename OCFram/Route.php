<?php
namespace OCFram;
use OCFram\Hydrator;

class Route {

	use Hydrator;
	private $url;
	private $namespace;
	private $module;
	private $action;
	private $logged;
	private $droits;

	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	// getter
	function getUrl(){
		return $this->url;
	}
	function getNamespace(){
		return $this->namespace;
	}
	function getModule(){
		return $this->module;
	}
	function getAction(){
		return $this->action;
	}
	function getLogged(){
		return $this->logged;
	}
	function getDroits(){
		return $this->droits;
	}
	// pas de setter car les données d'une route sont fournis par le fichier route.php, ces données ne doivent pas etres ouvertes a réaffectation (redefinir) 
}
?>