<?php
namespace ORM\Logiciel\Entity;
use OCFram\Hydrator;

class Logiciel {

	use Hydrator;
	private $id_logiciel;
	private $titre_logiciel;
	private $actif_logiciel;	
	private $date_logiciel;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdLogiciel(){
		return $this->id_logiciel;
	}
	function getTitreLogiciel(){
		return $this->titre_logiciel;
	}
	function getActifLogiciel(){
		return $this->actif_logiciel;
	}
	function getDateLogiciel(){
		return $this->date_logiciel;
	}

	// SETTER
	function setTitreLogiciel($val){
		$this->titre_logiciel = $val;
	}
	function setActifLogiciel($val){
		$this->actif_logiciel = $val;
	}
	function setDateLogiciel($val){
		$this->date_logiciel = $val;
	}

}
?>