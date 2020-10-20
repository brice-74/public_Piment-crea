<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\FormBuilder\InputText;
use Vendors\Validator\VideValidator;

class FormProposition extends Form {


	function buildForm(){

		$this->add(new InputText([
			"label" 		=> "Catégorie : ",
			"placeholder" 	=> "Intitulé de la catégorie",
			"name" 			=> "titre_proposition",
			"css" 			=> "champ"
		]));

		$this->add(new ButtonSubmit([
			"name" 			=> "prop",
			"css" 			=> "btnB",
			"value" 		=> "Envoi de la catégorie",
			"contenu_btn"	=> "<p class=\"txt16\">Envoyer</p>"
		]));


		return $this;

	}

}

?>