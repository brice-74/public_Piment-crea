<?php
namespace ORM\Abonnement\Entity;
use OCFram\Hydrator;

class Abonnement {

	use Hydrator;
	private $id_abonnement;
	private $user_id_user;
	private $chaine_id_chaine;
	private $date_abonnement;
	private $new_post_abonnement;



	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdAbonnement(){
		return $this->id_abonnement;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getChaineIdChaine(){
		return $this->chaine_id_chaine;
	}
	function getDateAbonnement(){
		return $this->date_abonnement;
	}
	function getNewPostAbonnement(){
		return $this->new_post_abonnement;
	}



	// SETTER
	function setDateAbonnement($val){
		$this->date_abonnement = $val;
	}
	function setNewPostAbonnement($val){
		$this->new_post_abonnement = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
	function setChaineIdChaine($val){
		$this->chaine_id_chaine = $val;
	}

}
?>