<?php
namespace ORM\Language\Entity;
use OCFram\Hydrator;

class Language {

	use Hydrator;
	private $id_language;
	private $titre_language;
	private $actif_language;	
	private $date_language;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdLanguage(){
		return $this->id_language;
	}
	function getTitreLanguage(){
		return $this->titre_language;
	}
	function getActifLanguage(){
		return $this->actif_language;
	}
	function getDateLanguage(){
		return $this->date_language;
	}

	// SETTER
	function setTitreLanguage($val){
		$this->titre_language = $val;
	}
	function setActifLanguage($val){
		$this->actif_language = $val;
	}
	function setDateLanguage($val){
		$this->date_language = $val;
	}

}
?>