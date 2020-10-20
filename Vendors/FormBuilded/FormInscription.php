<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;

use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputPassword;
use Vendors\FormBuilder\InputCheckBox;
use Vendors\FormBuilder\ButtonSubmit;

use Vendors\Validator\VideValidator;
use Vendors\Validator\EmailValidator;
use Vendors\Validator\ChiffreValidator;
use Vendors\Validator\MajusculeValidator;
use Vendors\Validator\MinusculeValidator;
use Vendors\Validator\SpecialCharValidator;
use Vendors\Validator\MinLengthValidator;
use Vendors\Validator\IssetValidator;


class FormInscription extends Form {

	function buildForm(){
		$this->add(new InputText([
			"label" 		=> "Votre nom : ",
			"placeholder" 	=> "Nom",
			"name" 			=> "nom_user",
			"css" 			=> "champ",
			"validators" 	=> [
				new VideValidator("Nom obligatoire")
			]
		]));

		$this->add(new InputText([
			"label" 		=> "Votre prénom : ",
			"placeholder" 	=> "Prénom",
			"name" 			=> "prenom_user",
			"css" 			=> "champ",
			"validators" 	=> [
				new VideValidator("Prénom obligatoire")
			]
		]));

		$this->add(new InputEmail([
			"label" 		=> "Votre email : ",
			"placeholder" 	=> "Email",
			"name" 			=> "email_user",
			"css" 			=> "champ",
			"validators" 	=> [
				new EmailValidator("Email obligatoire")
			]
		]));

		$this->add(new InputPassword([
			"label" 		=> "Votre mot de passe : ",
			"placeholder" 	=> "Mot de passe",
			"name" 			=> "pass_user",
			"css" 			=> "champ",
			"validators" 	=> [
				new SpecialCharValidator("Au moins un caractère spécial"),
				new ChiffreValidator("Au moins un chiffre"),
				new MajusculeValidator("Au moins une majuscule"),
				new MinusculeValidator("Au moins une minuscule"),
				new MinLengthValidator("8 caractères minimum",8)
			]
		]));


		$this->add(new InputCheckBox([
			"name" 			=> "rgpd_user",
			"value" 		=> 1,
			"label" 		=> " En soumettant ce formulaire, 
			j'accepte la 
			<a href=\"rgpd\" title=\"Consulter\" class=\"a-link\"
			target=\"_blank\">politique de confidentialité</a> de Piment-Créa.",
			"validators"	=> [
				new IssetValidator("Sans votre consentement, nous ne 
				pouvons pas traiter vos données","rgpd_user")
			]
		]));


		$this->add(new ButtonSubmit([
			"name" 			=> "go",
			"css" 			=> "btnB",
			"value" 		=> "Inscription",
			"contenu_btn"	=> "<p class=\"txt16\">Inscription</p>"
		]));

		return $this;

	}

}

?>