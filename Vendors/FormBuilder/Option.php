<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

use OCFram\Connexion;
use OCFram\HTTPRequest;
use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Language\Model\ManagerLanguage;

class Option extends Field {

	protected $cellule;
	protected $cat_tuto;
	protected $id_tuto;
	
	function getWidget(){
				
		$widget	= "<option ";

		/*$widget	.= ($this->selected === TRUE)?" selected":NULL;*/

		$widget	.= ($this->isSelectByGet())?" selected":NULL;
		$widget	.= ($this->catTuto())?" selected":NULL;
		$widget	.= ($this->isSelected())?" selected":NULL;

		$widget	.= isset($this->value)?" value=\"".$this->value."\"":NULL;
		$widget	.= ">";
		$widget	.= isset($this->label)?$this->label:NULL;
		$widget	.= "</option>";
		
		return $widget;
	}

	function isSelectByGet(){
		$http = new HTTPRequest();
		if(!is_null($http->getDataGet('theme'))){
			$themes = explode('-',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('theme')));
		}
		if(!is_null($http->getDataGet('log'))){
			$logs = explode('-',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('log')));
		}
		if(!is_null($http->getDataGet('lang'))){
			$langs = explode('-',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('lang')));
		}
		$res = false;
		if(isset($themes)){
			foreach ($themes as $theme) {
				if($this->value == 'theme-'.$theme){
					$res = true;
				}
			}
		}
		if(isset($logs)){
			foreach ($logs as $log) {
				if($this->value == 'logiciel-'.$log){
					$res = true;
				}
			}
		}
		if(isset($langs)){
			foreach ($langs as $lang) {
				if($this->value == 'language-'.$lang){
					$res = true;
				}
			}
		}
		return $res;
	}

	function isSelected(){
		$res = FALSE;
		if(isset($_POST[$this->cellule])){
			foreach ($_POST[$this->cellule] as $key => $value) {
				if($value == $this->value){
					$res = TRUE;
				}
			}
		}
		return $res;
	}

	function catTuto(){
		if(isset($this->cat_tuto)){
			$cx			= new Connexion();
			$manager_theme 		= new ManagerTheme($cx);
			$manager_logiciel 	= new ManagerLogiciel($cx);
			$manager_language 	= new ManagerLanguage($cx);

			$res = FALSE;
			if(preg_match('/^theme-[0-9]+/', $this->cat_tuto)){
				$id_theme = preg_replace("/[a-zA-Z\W]+/",'', $this->cat_tuto);
				if($manager_theme->issetTutoHasTheme($this->id_tuto,$id_theme)){
					$res = TRUE;
				}
			}
			if(preg_match('/^language-[0-9]+/', $this->cat_tuto)){
				$id_language = preg_replace("/[a-zA-Z\W]+/",'', $this->cat_tuto);
				if($manager_language->issetTutoHasLanguage($this->id_tuto,$id_language)){
					$res = TRUE;
				}
			}
			if(preg_match('/^logiciel-[0-9]+/', $this->cat_tuto)){
				$id_logiciel = preg_replace("/[a-zA-Z\W]+/",'', $this->cat_tuto);
				if($manager_logiciel->issetTutoHasLogiciel($this->id_tuto,$id_logiciel)){
					$res = TRUE;
				}
			}
			$cx->close();
			return $res;
		}	
	}
}
?>