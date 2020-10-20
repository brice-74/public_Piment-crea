<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\FormBuilder\Select;
use Vendors\FormBuilder\Option;

use OCFram\HTTPRequest;



class FormTrieTuto extends Form {

	function buildForm($tableau_theme,$tableau_logiciel,$tableau_language){
		$http = new HTTPRequest();

		foreach ($tableau_theme as $key => $obj) {
			$options_theme[] = new Option([
				"label" => $obj->getTitreTheme(),
				"value" => "theme-".$obj->getIdTheme(),
				"cellule" => "theme_tuto"
			]); 
		}
		$this->add(new Select([
			"label" => "Catégories : ",
			"name" => "theme_tuto[]",
			"css" => "champ",
			"options" => $options_theme
		]));

		foreach ($tableau_logiciel as $key => $obj) {
			$options_logiciel[] = new Option([
				"label" => $obj->getTitreLogiciel(),
				"value" => "logiciel-".$obj->getIdLogiciel(),
				"cellule" => "logiciel_tuto"
			]); 
		} 
		$this->add(new Select([
			"label" => "Catégories : ",
			"name" => "logiciel_tuto[]",
			"css" => "champ",
			"options" => $options_logiciel
		]));

		foreach ($tableau_language as $key => $obj) {
			$options_language[] = new Option([
				"label" => $obj->getTitreLanguage(),
				"value" => "language-".$obj->getIdLanguage(),
				"cellule" => "language_tuto"
			]); 
		} 
		$this->add(new Select([
			"label" => "Catégories : ",
			"name" => "language_tuto[]",
			"css" => "champ",
			"options" => $options_language
		]));
	

		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Filtrer les tutoriaux",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt12\">Filtrer</p>"
		]));

		
		return $this;

	}
}
?>