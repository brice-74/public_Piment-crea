<?php
namespace ORM\Visuel\Entity;
use OCFram\Hydrator;

class Visuel {

	use Hydrator;
	private $id_visuel;
	private $visuel_visuel;
	private $description_visuel;		
	private $date_post_visuel;	
	private $actif_visuel;	
	private $chaine_id_chaine;






	function __construct(Array $datas){
		$this->hydrate($datas);
	}
	//Getter
	function getIdVisuel(){
		return $this->id_visuel;
	}
	function getVisuelVisuel(){
		return $this->visuel_visuel;
	}
	function getDatePostVisuel(){
		return $this->date_post_visuel;
	}
	function getDescriptionVisuel(){
		return $this->description_visuel;
	}
	function getActifVisuel(){
		return $this->actif_visuel;
	}
	function getChaineIdChaine(){
		return $this->chaine_id_chaine;
	}




	// SETTER
	function setVisuelVisuel($val){
		$this->visuel_visuel = $val;
	}
	function setDatePostVisuel($val){
		$this->date_post_visuel = $val;
	}
	function setDescriptionVisuel($val){
		$this->description_visuel = $val;
	}
	function setActifVisuel($val){
		$this->actif_visuel = $val;
	}
	function setChaineIdChaine($val){
		$this->chaine_id_chaine = $val;
	}


}
?>