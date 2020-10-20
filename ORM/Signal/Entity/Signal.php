<?php
namespace ORM\Signal\Entity;
use OCFram\Hydrator;

class Signal {

	use Hydrator;
	private $id_signal;
	private $commentaire_signal;
	private $actif_signal;	
	private $date_signal;
	private $user_id_user;	
	private $chaine_id_chaine;	
	private $commentaire_id_commentaire;
	private $visuel_id_visuel;		
	private $tuto_id_tuto;	






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdSignal(){
		return $this->id_signal;
	}
	function getCommentaireSignal(){
		return $this->commentaire_signal;
	}
	function getActifSignal(){
		return $this->actif_signal;
	}
	function getDateSignal(){
		return $this->date_signal;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getChaineIdChaine(){
		return $this->chaine_id_chaine;
	}
	function getCommentaireIdCommentaire(){
		return $this->commentaire_id_commentaire;
	}
	function getVisuelIdVisuel(){
		return $this->visuel_id_visuel;
	}
	function getTutoIdTuto(){
		return $this->tuto_id_tuto;
	}
	


	// SETTER
	function setCommentaireSignal($val){
		$this->commentaire_signal = $val;
	}
	function setActifSignal($val){
		$this->actif_signal = $val;
	}
	function setDateSignal($val){
		$this->date_signal = $val;
	}
	function setUserIdUser($val){
		$this->user_id_use = $val;
	}
	function setChaineIdChaine($val){
		$this->chaine_id_chain = $val;
	}
	function setCommentaireIdCommentaire($val){
		$this->commentaire_id_commentair = $val;
	}
	function setVisuelIdVisuel($val){
		$this->visuel_id_visuel = $val;
	}
	function setTutoIdTuto($val){
		$this->tuto_id_tuto = $val;
	}




}
?>