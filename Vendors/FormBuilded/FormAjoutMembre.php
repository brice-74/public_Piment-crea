<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\ButtonSubmit;

use Vendors\Validator\EmailValidator;


class FormAjoutMembre extends Form {

	function buildForm(){
		
		$this->add(new InputEmail([
			"label" 		=> "Adresse mail : ",
			"name" 			=> "email_user",
			"css" 			=> "champ",
			"placeholder" 	=> "E-mail du nouveau membre",
			"validators" 	=> [
				new EmailValidator("Adresse mail valide obligatoire")
			]
		]));

		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Ajouter un membre",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt16\">Envoyer le mail d'ajout</p>"
		]));

		
		return $this;

	}
}
?>