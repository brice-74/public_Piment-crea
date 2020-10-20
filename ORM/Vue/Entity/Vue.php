<?php
namespace ORM\Vue\Entity;
use OCFram\Hydrator;

class Vue {

	use Hydrator;
	private $id_vue;
	private $date_vue;
	private $user_id_user;	
	private $visuel_id_visuel;
	private $tuto_id_tuto;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdVue(){
		return $this->id_vue;
	}
	function getDateVue(){
		return $this->date_vue;
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
	function setDateVue($val){
		$this->date_vue = $val;
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