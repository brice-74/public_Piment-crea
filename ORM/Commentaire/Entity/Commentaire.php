<?php
namespace ORM\Commentaire\Entity;
use OCFram\Hydrator;

class Commentaire {

	use Hydrator;
	private $id_commentaire;
	private $contenu_commentaire;	
	private $actif_commentaire;	
	private $date_commentaire;	
	private $new_post_commentaire;	
	private $tuto_id_tuto;	
	private $visuel_id_visuel;
	private $user_id_user;





	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdCommentaire(){
		return $this->id_commentaire;
	}
	function getContenuCommentaire(){
		return $this->contenu_commentaire;
	}
	function getActifCommentaire(){
		return $this->actif_commentaire;
	}
	function getDateCommentaire(){
		return $this->date_commentaire;
	}
	function getNewPostCommentaire(){
		return $this->new_post_commentaire;
	}
	function getTutoIdTuto(){
		return $this->tuto_id_tuto;
	}
	function getVisuelIdVisuel(){
		return $this->visuel_id_visuel;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}


	// SETTER
	function setContenuCommentaire($val){
		$this->contenu_commentaire = $val;
	}
	function setActifCommentaire($val){
		$this->actif_commentaire = $val;
	}
	function setDateCommentaire($val){
		$this->date_commentaire = $val;
	}
	function setNewPostCommentaire($val){
		$this->new_post_commentaire = $val;
	}
	function setTutoIdTuto($val){
		$this->tuto_id_tuto = $val;
	}
	function setVisuelIdVisuel($val){
		$this->visuel_id_visuel = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
}
?>