<?php
namespace ORM\Like\Entity;
use OCFram\Hydrator;

class Like {

	use Hydrator;
	private $id_like;
	private $post_like;
	private $date_like;	
	private $user_id_user;
	private $visuel_id_visuel;	






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdLike(){
		return $this->id_like;
	}
	function getPostLike(){
		return $this->post_like;
	}
	function getDateLike(){
		return $this->date_like;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getVisuelIdVisuel(){
		return $this->visuel_id_visuel;
	}


	// SETTER
	function setPostLike($val){
		$this->post_like = $val;
	}
	function setDateLike($val){
		$this->date_like = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
	function setVisuelIdVisuel($val){
		$this->visuel_id_visuel = $val;
	}


}
?>