<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;

use ORM\Tuto\Entity\Tuto;

use OCFram\HTTPRequest;


class FormOneImageTuto extends Form {

	function buildForm(){

		$this->add(new InputFile([
			"label" 		=> "Choisir&nbsp;une&nbsp;image",
			"name" 			=> "oneImg_tuto",
			"css" 			=> "champ"
		]));
		
		return $this;

	}
}
?>