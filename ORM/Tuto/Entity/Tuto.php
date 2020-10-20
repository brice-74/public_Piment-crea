<?php
namespace ORM\Tuto\Entity;
use OCFram\Hydrator;

class Tuto {

	use Hydrator;
	private $id_tuto;
	private $titre_tuto;
	private $visuel_tuto;	
	private $html_tuto;
	private $date_crea_tuto;	
	private $date_modif_tuto;	
	private $date_post_tuto;	
	private $actif_tuto;	
	private $post_tuto;	
	private $chaine_id_chaine;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdTuto(){
		return $this->id_tuto;
	}
	function getTitreTuto(){
		return $this->titre_tuto;
	}
	function getVisuelTuto(){
		return $this->visuel_tuto;
	}
	function getHtmlTuto(){
		return $this->html_tuto;
	}
	function getDateCreaTuto(){
		return $this->date_crea_tuto;
	}
	function getDateModifTuto(){
		return $this->date_modif_tuto;
	}
	function getDatePostTuto(){
		return $this->date_post_tuto;
	}
	function getActifTuto(){
		return $this->actif_tuto;
	}
	function getPostTuto(){
		return $this->post_tuto;
	}
	function getChaineIdChaine(){
		return $this->chaine_id_chaine;
	}




	// SETTER
	function setTitreTuto($val){
		$this->titre_tuto = $val;
	}
	function setVisuelTuto($val){
		$this->visuel_tuto = $val;
	}
	function setHtmlTuto($val){
		$this->html_tuto = $val;
	}
	function setDateCreaTuto($val){
		$this->date_crea_tuto = $val;
	}
	function setDateModifTuto($val){
		$this->date_modif_tuto = $val;
	}
	function setDatePostTuto($val){
		$this->date_post_tuto = $val;
	}
	function setActifTuto($val){
		$this->actif_tuto = $val;
	}
	function setPostTuto($val){
		$this->post_tuto = $val;
	}
	function setChaineIdChaine($val){
		$this->chaine_id_chaine = $val;
	}


}
?>