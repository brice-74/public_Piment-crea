<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\ButtonSubmit;
use Vendors\FormBuilder\Select;
use Vendors\FormBuilder\Option;

use OCFram\HTTPRequest;



class FormTrieVisu extends Form {

	function buildForm($tableau_theme,$tableau_logiciel){
		$http = new HTTPRequest();

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
	

		$this->add(new ButtonSubmit([
			"name"	 => "go",
			"value"	 => "Filtrer les visuels",
			"css"	 => "btnB",
			"contenu_btn"	=> "<p class=\"txt12\">Filtrer</p>"
		]));

		
		return $this;

	}
}
?>