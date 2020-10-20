<?php
namespace ORM\Proposition\Entity;
use OCFram\Hydrator;

class Proposition {

	use Hydrator;
	private $id_proposition;
	private $categorie_proposition;
	private $titre_proposition;	
	private $actif_proposition;
	private $date_proposition;	
	private $user_id_user;
	private $visuel_id_visuel;
	private $tuto_id_tuto;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdProposition(){
		return $this->id_proposition;
	}
	function getCategorieProposition(){
		return $this->categorie_proposition;
	}
	function getTitreProposition(){
		return $this->titre_proposition;
	}
	function getActifPropostion(){
		return $this->actif_proposition;
	}
	function getDateProposition(){
		return $this->date_proposition;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getVisuelIdVisuel(){
		return $this->visuel_id_visuel;
	}
	function getTutoIdTuto(){
		return $this->tuto_id_tuto;
	}


	// SETTER
	function setCategorieProposition($val){
		$this->categorie_proposition = $val;
	}
	function setTitreProposition($val){
		$this->titre_proposition = $val;
	}
	function setActifPropostion($val){
		$this->actif_proposition = $val;
	}
	function setDateProposition($val){
		$this->date_proposition = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
	function setVisuelIdVisuel($val){
		$this->visuel_id_visuel = $val;
	}
	function setTutoIdTuto($val){
		$this->tuto_id_tuto = $val;
	}



}
?>