<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\Select;
use Vendors\FormBuilder\Option;
use Vendors\FormBuilder\ButtonSubmit;

use Vendors\Validator\VideValidator;


class FormAjoutCatProp extends Form {

	function buildForm(){

		$this->add(new Select([
			"multiple" => false,
			"label" => "Catégories : ",
			"name" => "categorie",
			"css" => "champ",
			"options" => [
				new Option([
					"label" => 'Theme',
					"value" => "theme",
				]),
				new Option([
					"label" => 'Language',
					"value" => "language",
				]),
				new Option([
					"label" => 'Logiciel',
					"value" => "logiciel",
				])
			]
		]));
		
		$this->add(new InputText([
			"label"	 => "Titre ctégorie",
			"name"	 => "titre_categorie",
			"css"	 => "champ",
			"placeholder" => "Titre de la catégorie",
			"getterEntity" => "getTitreProposition",
			"validators" => [
				new VideValidator("Titre de catégorie obligatoire")
			]
		]));

		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Ajouter la catégorie",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt16\">Ajouter la catégorie</p>"
		]));

		
		return $this;

	}
}
?>