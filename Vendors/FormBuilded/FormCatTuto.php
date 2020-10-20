<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\Select;
use Vendors\FormBuilder\Option;


class FormCatTuto extends Form {

	function buildForm($tableau_theme,$tableau_logiciel,$tableau_framework,$id_tuto){

		foreach ($tableau_theme as $key => $obj) {
			$options_theme[] = new Option([
				"label" => $obj->getTitreTheme(),
				"value" => "theme-".$obj->getIdTheme(),
				"cat_tuto" => "theme-".$obj->getIdTheme(),
				"id_tuto" => $id_tuto
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
				"cat_tuto" => "logiciel-".$obj->getIdLogiciel(),
				"id_tuto" => $id_tuto
			]); 
		} 
		$this->add(new Select([
			"label" => "Catégories : ",
			"name" => "logiciel_tuto[]",
			"css" => "champ",
			"options" => $options_logiciel
		]));

		foreach ($tableau_framework as $key => $obj) {
			$options_framework[] = new Option([
				"label" => $obj->getTitreLanguage(),
				"value" => "language-".$obj->getIdLanguage(),
				"cat_tuto" => "language-".$obj->getIdLanguage(),
				"id_tuto" => $id_tuto
			]); 
		} 
		$this->add(new Select([
			"label" => "Catégories : ",
			"name" => "language_tuto[]",
			"css" => "champ",
			"options" => $options_framework
		]));

		
		return $this;

	}
}
?>