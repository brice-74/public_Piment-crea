<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\FormBuilder\TextArea;

use Vendors\Validator\VideValidator;
use Vendors\Validator\EmailValidator;


class FormCreaChaine extends Form {

	function buildForm(){
		
		$this->add(new InputText([
			"label"	 => "Nom de la chaine : ",
			"name"	 => "nom_chaine",
			"css"	 => "champ",
			"placeholder" => "Nom de chaine",
			"validators" => [
				new VideValidator("Nom de la chaine obligatoire")
			]
		]));

		$this->add(new TextArea([
			"label" => "Description de la chaine : ",
			"name" => "description_chaine",
			"css" => "champ textarea",
			"placeholder" => "Description de la chaine"
		]));

		$this->add(new InputText([
			"label"	 => "Lien Linkedin : ",
			"name"	 => "lien_in_chaine",
			"css"	 => "champ",
			"placeholder" => "Lien Linkedin"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Facebook : ",
			"name"	 => "lien_fb_chaine",
			"css"	 => "champ",
			"placeholder" => "Lien Facebook"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Instagram : ",
			"name"	 => "lien_insta_chaine",
			"css"	 => "champ",
			"placeholder" => "Lien Instagram"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Youtube : ",
			"name"	 => "lien_ytb_chaine",
			"css"	 => "champ",
			"placeholder" => "Lien Youtube"
		]));
		$this->add(new InputText([
			"label"	 => "Lien Twitter : ",
			"name"	 => "lien_tw_chaine",
			"css"	 => "champ",
			"placeholder" => "Lien Twitter"
		]));



		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Créer ma chaine",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt16\">Créer ma chaine</p>"
		]));

		
		return $this;

	}
}
?>