<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputText;


class FormTitreTuto extends Form {

	function buildForm(){
		
		$this->add(new InputText([
			"label"	 => "Intitulé du tutoriel",
			"name"	 => "titre_tuto",
			"css"	 => "champ",
			"getterEntity" => "getTitreTuto",
			"placeholder" => "Intitulé du tutoriel"
		]));

		return $this;

	}
}
?>