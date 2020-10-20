<?php
namespace ORM\Chaine\Entity;
use OCFram\Hydrator;

class Chaine {

	use Hydrator;
	private $id_chaine;
	private $nom_chaine;
	private $description_chaine;
	private $avatar_chaine;
	private $visuel_chaine;
	private $lien_in_chaine;
	private $lien_fb_chaine;
	private $lien_insta_chaine;
	private $lien_ytb_chaine;
	private $lien_tw_chaine;
	private $actif_chaine;
	private $date_crea_chaine;




	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdChaine(){
		return $this->id_chaine;
	}
	function getNomChaine(){
		return $this->nom_chaine;
	}
	function getDescriptionChaine(){
		return $this->description_chaine;
	}
	function getAvatarChaine(){
		return $this->avatar_chaine;
	}
	function getVisuelChaine(){
		return $this->visuel_chaine;
	}
	function getLienInChaine(){
		return $this->lien_in_chaine;
	}
	function getLienFbChaine(){
		return $this->lien_fb_chaine;
	}
	function getLienInstaChaine(){
		return $this->lien_insta_chaine;
	}
	function getLienYtbChaine(){
		return $this->lien_ytb_chaine;
	}
	function getLienTwChaine(){
		return $this->lien_tw_chaine;
	}
	function getActifChaine(){
		return $this->actif_chaine;
	}
	function getDateCreaChaine(){
		return $this->date_crea_chaine;
	}




	// SETTER
	function setNomChaine($val){
		$this->nom_chaine = $val;
	}
	function setDescriptionChaine($val){
		$this->description_chaine = $val;
	}
	function setAvatarChaine($val){
		$this->avatar_chaine = $val;
	}
	function setVisuelChaine($val){
		$this->visuel_chaine = $val;
	}
	function setLienInChaine($val){
		$this->lien_in_chaine = $val;
	}
	function setLienFbChaine($val){
		$this->lien_fb_chaine = $val;
	}
	function setLienInstaChaine($val){
		$this->lien_insta_chaine = $val;
	}
	function setLienYtbChaine($val){
		$this->lien_ytb_chaine = $val;
	}
	function setLienTwChaine($val){
		$this->lien_tw_chaine = $val;
	}
	function setActifChaine($val){
		$this->actif_chaine = $val;
	}
	function setDateCreaChaine($val){
		$this->date_crea_chaine = $val;
	}


}
?>