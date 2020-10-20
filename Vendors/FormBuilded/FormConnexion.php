<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputPassword;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\FormBuilder\Link;
use Vendors\Validator\EmailValidator;
use Vendors\Validator\VideValidator;

class FormConnexion extends Form {


	function buildForm(){
		$this->add(new InputEmail([
			"label" 		=> "Votre login : ",
			"name" 			=> "email_user",
			"css" 			=> "champ",
			"placeholder" 	=> "Votre adresse e-mail",
			"validators" 	=> [
				new EmailValidator("Login obligatoire")
			]
		]));

		$this->add(new InputPassword([
			"label" 		=> "Votre mot de passe : ",
			"placeholder" 	=> "Mot de passe",
			"name" 			=> "pass_user",
			"css" 			=> "champ",
			"validators" 	=> [
				new VideValidator("Mot de passe obligatoire")
			]
		]));

		$this->add(new ButtonSubmit([
			"name" 			=> "go",
			"css" 			=> "btnB",
			"value" 		=> "Inscription",
			"contenu_btn"	=> "<p class=\"txt16\">Connexion</p>"
		]));

		$this->add(new Link([
			"label"			=> "Mot de passe oublié",
			"href" 			=> "mot-passe-oublie",
			"css"			=> "a-link",
			"title" 		=> "Réinitialiser votre mot de passe"
		]));

		return $this;

	}

}

?>