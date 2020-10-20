<?php
namespace ORM\Favoris\Entity;
use OCFram\Hydrator;

class Favoris {

	use Hydrator;
	private $id_favoris;
	private $user_id_user;
	private $tuto_id_tuto;	
	private $visuel_id_visuel;	
	private $date_favoris;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdFavoris(){
		return $this->id_favoris;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getTutoIdTuto(){
		return $this->tuto_id_tuto;
	}
	function getVisuelIdVisuel(){
		return $this->visuel_id_visuel;
	}
	function getDateFavoris(){
		return $this->date_favoris;
	}

	// SETTER
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
	function setTutoIdTuto($val){
		$this->tuto_id_tuto = $val;
	}
	function setVisuelIdVisuel($val){
		$this->visuel_id_visuel = $val;
	}
	function setDateFavoris($val){
		$this->date_favoris = $val;
	}
}
?>