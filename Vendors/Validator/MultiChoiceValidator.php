<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;
use OCFram\HTTPRequest;

class MultiChoiceValidator extends Validator {

	private $http;
	private $pattern;
	private $cellule;

	function __construct($message,$modele,$cel){
		parent::__construct($message);
		$this->http = new HTTPRequest();
		$this->pattern = $modele;
		$this->cellule = $cel;
	}


	function isNotValid() {
		return (count($this->http->getMultiChoiceData($this->pattern,$this->cellule)) === 0);
	}

}
?>