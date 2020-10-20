<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputPassword;
use Vendors\FormBuilder\ButtonSubmit;

use Vendors\Validator\VideValidator;
use Vendors\Validator\EmailValidator;


class FormProfil extends Form {

	function buildForm(){
		
		$this->add(new InputText([
			"label"	 => "Nom : ",
			"name"	 => "nom_user",
			"id"	 => "nom_user",
			"css"	 => "champ",
			"placeholder" => "Nom",
			"getterEntity" => "getNomUser",
			"validators" => [
				new VideValidator("Nom obligatoire")
			]
		]));

		$this->add(new InputText([
			"label"	 => "Prénom : ",
			"name"	 => "prenom_user",
			"id"	 => "prenom_user",
			"css"	 => "champ",
			"placeholder" => "Prénom",
			"getterEntity" => "getPrenomUser",
			"validators" => [
				new VideValidator("Prénom obligatoire")
			]
		]));

		$this->add(new InputEmail([
			"label"	 => "Email : ",
			"name"	 => "email_user",
			"id"	 => "email_user",
			"css"	 => "champ",
			"placeholder" => "Email",
			"getterEntity" => "getEmailUser",
			"validators" => [
				new EmailValidator("Une adresse mail valide")
			]
		]));

		$this->add(new InputPassword([
			"label"	 => "Mot de passe actuel (pour autoriser la modification) : ",
			"name"	 => "pass_user",
			"id"	 => "pass_user",
			"css"	 => "champ",
			"placeholder" => "Mot de passe",
			"validators" => [
				new VideValidator("Pour autoriser la modification de votre profil, renseignez votre mot de passe")
			]
		]));

		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Modifier",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt16\">Confirmer</p>"
		]));


		
		return $this;

	}
}
?>