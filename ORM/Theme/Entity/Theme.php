<?php
namespace ORM\Theme\Entity;
use OCFram\Hydrator;

class Theme {

	use Hydrator;
	private $id_theme;
	private $titre_theme;
	private $actif_theme;	
	private $date_theme;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdTheme(){
		return $this->id_theme;
	}
	function getTitreTheme(){
		return $this->titre_theme;
	}
	function getActifTheme(){
		return $this->actif_theme;
	}
	function getDateTheme(){
		return $this->date_theme;
	}

	// SETTER
	function setTitreTheme($val){
		$this->titre_theme = $val;
	}
	function setActifTheme($val){
		$this->actif_theme = $val;
	}
	function setDateTheme($val){
		$this->date_theme = $val;
	}

}
?>