<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\Select;
use Vendors\FormBuilder\Option;

use OCFram\HTTPRequest;

use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadMaxSizeValidator;
use Vendors\Validator\UploadTypeValidator;
use Vendors\Validator\MultiChoiceValidator;


class FormPostVisuel extends Form {

	function buildForm($tableau_theme,$tableau_logiciel){
		$http = new HTTPRequest();
		
		$this->add(new InputFile([
			"label" 		=> "Choisir un visuel",
			"name" 			=> "visuel_visuel",
			"css" 			=> "champ",
			"validators" 	=> [
				new UploadTypeValidator(
					"Veuillez choisir un format jpg ou png",
					$http->getDataFiles("visuel_visuel","type"),
					["image/jpeg","image/png"]
				),
				new UploadMaxSizeValidator(
					"Sélectionnez un fichier inférieur à 2 Mo",
					$http->getDataFiles("visuel_visuel","size")
				),
				new UploadCodeValidator(
					"Upload impossible",
					$http->getDataFiles("visuel_visuel","error")
				)
			]
		]));

		foreach ($tableau_theme as $key => $obj) {
			$options_theme[] = new Option([
				"label" => $obj->getTitreTheme(),
				"value" => "theme-".$obj->getIdTheme(),
				"cellule" => "theme_visuel"
			]); 
		}
		$this->add(new Select([
			"label" => "Catégories : ",
			"name" => "theme_visuel[]",
			"css" => "champ",
			"options" => $options_theme
		]));

		foreach ($tableau_logiciel as $key => $obj) {
			$options_logiciel[] = new Option([
				"label" => $obj->getTitreLogiciel(),
				"value" => "logiciel-".$obj->getIdLogiciel(),
				"cellule" => "logiciel_visuel"
			]); 
		} 
		$this->add(new Select([
			"label" => "Catégories : ",
			"name" => "logiciel_visuel[]",
			"css" => "champ",
			"options" => $options_logiciel
		]));
	

		$this->add(new TextArea([
			"label" => "Description du visuel : ",
			"name" => "description_visuel",
			"css" => "champ textarea",
			"placeholder" => "Description du visuel"
		]));

		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Poster le visuel",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt16\">Poster le visuel</p>"
		]));

		
		return $this;

	}
}
?>