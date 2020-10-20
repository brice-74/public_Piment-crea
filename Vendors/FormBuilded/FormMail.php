<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\Validator\EmailValidator;

class FormMail extends Form {


	function buildForm(){

		$this->add(new InputEmail([
			"label" 		=> "Votre adresse mail : ",
			"name" 			=> "email_user",
			"css" 			=> "champ",
			"placeholder" 	=> "Votre adresse e-mail",
			"getterEntity" => "getEmailUser",
			"validators" 	=> [
				new EmailValidator("Adresse mail valide obligatoire")
			]
		]));

		$this->add(new ButtonSubmit([
			"name" 			=> "go",
			"css" 			=> "btnB",
			"value" 		=> "Envoyer sur se mail",
			"contenu_btn"	=> "<p class=\"txt16\">Envoyer</p>"
		]));

		return $this;

	}

}

?>