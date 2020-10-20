<?php
namespace ORM\Proposition\Model;
use OCFram\Manager;
use ORM\Proposition\Entity\Proposition;
/*
id_proposition
categorie_proposition
titre_proposition
actif_proposition
date_proposition
user_id_user
visuel_id_visuel
tuto_id_tuto
*/

class ManagerProposition extends Manager {

	function selectPropsByTuto($id){
		$id = $this->db->real_escape_string($id);
		$req = "SELECT * FROM proposition WHERE tuto_id_tuto = $id AND actif_proposition = 1
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Proposition($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectPropsVisu(){
		$req = "SELECT 
			proposition.id_proposition,
			proposition.categorie_proposition,
			proposition.titre_proposition,
			proposition.actif_proposition,
			proposition.date_proposition,
			proposition.user_id_user,
			proposition.visuel_id_visuel,
			proposition.tuto_id_tuto,
			visuel.id_visuel,	
			visuel.visuel_visuel,	
			visuel.description_visuel,	
			visuel.date_post_visuel,	
			visuel.actif_visuel,	
			visuel.chaine_id_chaine
		 FROM proposition
			INNER JOIN visuel
				ON visuel.id_visuel = proposition.visuel_id_visuel
		 WHERE visuel.actif_visuel = 1
		 ORDER BY proposition.date_proposition DESC
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Proposition($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectPropsTuto(){
		$req = "SELECT 
			proposition.id_proposition,
			proposition.categorie_proposition,
			proposition.titre_proposition,
			proposition.actif_proposition,
			proposition.date_proposition,
			proposition.user_id_user,
			proposition.visuel_id_visuel,
			proposition.tuto_id_tuto,
			tuto.id_tuto,	
			tuto.titre_tuto,	
			tuto.visuel_tuto,	
			tuto.html_tuto,	
			tuto.date_crea_tuto,	
			tuto.date_modif_tuto,	
			tuto.date_post_tuto,	
			tuto.actif_tuto,	
			tuto.post_tuto,	
			tuto.chaine_id_chaine
		 FROM proposition
			INNER JOIN tuto
				ON tuto.id_tuto = proposition.tuto_id_tuto
		 WHERE tuto.actif_tuto = 1
		 ORDER BY proposition.date_proposition DESC
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Proposition($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectPropByIds($chaine){
		$chaine = $this->db->real_escape_string($chaine);
		$req = "SELECT * FROM proposition WHERE id_proposition IN ($chaine) AND actif_proposition = 1
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Proposition($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function removeProp($id){
		$id = $this->db->real_escape_string($id);
		$req = "DELETE FROM proposition WHERE id_proposition = $id";
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function selectPropById($id){
		$id = $this->db->real_escape_string($id);
		$req = "SELECT * FROM proposition WHERE id_proposition = $id AND actif_proposition = 1
		";
		$query = $this->db->query($req);
		if($query->num_rows == 1){
			return new Proposition($query->fetch_array());
		}else{
			NULL;
		}
	}

	function selectProp($id){
		$id = $this->db->real_escape_string($id);
		$req = "SELECT * FROM proposition WHERE id_proposition = $id
		";
		$query = $this->db->query($req);
		if($query->num_rows == 1){
			return new Proposition($query->fetch_array());
		}else{
			NULL;
		}
	}

	function insertProp(Proposition $obj){

		$categorie_proposition = $this->db->real_escape_string($obj->getCategorieProposition());   
		$titre_proposition = $this->db->real_escape_string($obj->getTitreProposition());    
		$actif_proposition = $this->db->real_escape_string($obj->getActifPropostion());    
		$date_proposition = $this->db->real_escape_string($obj->getDateProposition());   
		$user_id_user = $this->db->real_escape_string($obj->getUserIdUser());    
		$visuel_id_visuel = $this->db->real_escape_string($obj->getVisuelIdVisuel());   
		$tuto_id_tuto = $this->db->real_escape_string($obj->getTutoIdTuto());    

		$req = "INSERT INTO proposition 
			VALUES(
				NULL,	
				'$categorie_proposition',
				'$titre_proposition',
				$actif_proposition,
				'$date_proposition',
				$user_id_user,
				$visuel_id_visuel,
				$tuto_id_tuto
			)
		";
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function updatePropVisu(Proposition $obj){
		$id_prop = $this->db->real_escape_string($obj->getIdProposition());
		$visuel_prop = $this->db->real_escape_string($obj->getVisuelIdVisuel());

		$req = "UPDATE proposition SET 
			visuel_id_visuel = $visuel_prop
			WHERE id_proposition = $id_prop";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateTitreProp(Proposition $obj){
		$id_prop = $this->db->real_escape_string($obj->getIdProposition());
		$titre = $this->db->real_escape_string($obj->getTitreProposition());

		$req = "UPDATE proposition SET 
			titre_proposition = '$titre'
			WHERE id_proposition = $id_prop";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateActifPropById(Proposition $obj){
		$actif = $this->db->real_escape_string($obj->getActifPropostion());

		$req = "UPDATE proposition SET 
			actif_proposition = $actif
			WHERE id_proposition = ".$obj->getIdProposition();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

}
?>