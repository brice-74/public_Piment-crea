<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\FormBuilder\TextArea;

use Vendors\Validator\VideValidator;
use Vendors\Validator\EmailValidator;


class FormModifChaine extends Form {

	function buildForm(){
		
		$this->add(new TextArea([
			"label" => "Description de la chaine : ",
			"name" => "description_chaine",
			"css" => "champ textarea",
			"getterEntity" => "getDescriptionChaine",
			"placeholder" => "Description de la chaine"
		]));

		$this->add(new InputText([
			"label"	 => "Lien Linkedin : ",
			"name"	 => "lien_in_chaine",
			"css"	 => "champ",
			"getterEntity" => "getLienInChaine",
			"placeholder" => "Lien Linkedin"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Facebook : ",
			"name"	 => "lien_fb_chaine",
			"getterEntity" => "getLienFbChaine",
			"css"	 => "champ",
			"placeholder" => "Lien Facebook"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Instagram : ",
			"name"	 => "lien_insta_chaine",
			"getterEntity" => "getLienInstaChaine",
			"css"	 => "champ",
			"placeholder" => "Lien Instagram"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Youtube : ",
			"name"	 => "lien_ytb_chaine",
			"getterEntity" => "getLienYtbChaine",
			"css"	 => "champ",
			"placeholder" => "Lien Youtube"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Twitter : ",
			"getterEntity" => "getLienTwChaine",
			"name"	 => "lien_tw_chaine",
			"css"	 => "champ",
			"placeholder" => "Lien Twitter"
		]));



		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Créer ma chaine",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt16\">Valider les modifications</p>"
		]));

		
		return $this;

	}
}
?>