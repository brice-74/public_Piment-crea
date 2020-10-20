<?php
namespace ORM\Note\Entity;
use OCFram\Hydrator;

class Note {

	use Hydrator;
	private $id_note;
	private $post_note;
	private $date_note;	
	private $user_id_user;
	private $tuto_id_tuto;	






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdNote(){
		return $this->id_note;
	}
	function getPostNote(){
		return $this->post_note;
	}
	function getDateNote(){
		return $this->date_note;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getTutoIdTuto(){
		return $this->tuto_id_tuto;
	}


	// SETTER
	function setPostNote($val){
		$this->post_note = $val;
	}
	function setDateNote($val){
		$this->date_note = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
	function setTutoIdTuto($val){
		$this->tuto_id_tuto = $val;
	}


}
?>