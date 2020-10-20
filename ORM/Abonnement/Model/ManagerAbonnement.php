<?php
namespace ORM\Abonnement\Model;
use OCFram\Manager;
use ORM\Abonnement\Entity\Abonnement;

/*
id_abonnement
user_id_user
chaine_id_chaine
date_abonnement
new_post_abonnement
*/

class ManagerAbonnement extends Manager {

	/*function selectAbonnementsByUser($id_user){
		$req = "SELECT * FROM abonnement
			WHERE user_id_user = $id_user
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Abonnement($row);
			}
			return $tableau;
		}else{
			return NULL;
		}
	}*/

	function countAbonnementsChaine($id_chaine){
		$req = " SELECT 
			COUNT(id_abonnement) AS countAbonnements
			FROM abonnement
			WHERE chaine_id_chaine = $id_chaine
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Abonnement($query->fetch_array()):NULL;
	}

	function countAbonnementsUser($id_user){
		$req = " SELECT 
			COUNT(id_abonnement) AS countAbonnements
			FROM abonnement
			WHERE user_id_user = $id_user
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Abonnement($query->fetch_array()):NULL;
	}

	function deleteAbonnementsChaine($id){
		$req = "DELETE FROM abonnement 
		WHERE chaine_id_chaine = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteAbonnementsUser($id){
		$req = "DELETE FROM abonnement 
		WHERE user_id_user = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function selectAbonnementByChaineAndUser($id_chaine,$id_user){
		$id_chaine	= $this->db->real_escape_string($id_chaine);
		$id_user		= $this->db->real_escape_string($id_user);

		$req = "SELECT * FROM abonnement
			WHERE user_id_user = $id_user
			AND chaine_id_chaine = $id_chaine
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Abonnement($query->fetch_array()):NULL;
	}

	function selectNbAbonnementByChaine($id_chaine){
		$id_chaine	= $this->db->real_escape_string($id_chaine);

		$req = "SELECT COUNT(id_abonnement) AS nbAbo
			FROM abonnement
			WHERE chaine_id_chaine = $id_chaine
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Abonnement($query->fetch_array()):NULL;
	}

	function insertAbo(Abonnement $obj){
		$id_user		= $this->db->real_escape_string($obj->getUserIdUser());
		$id_chaine	= $this->db->real_escape_string($obj->getChaineIdChaine());
		$date			= $this->db->real_escape_string($obj->getDateAbonnement());

		$req = "INSERT INTO abonnement 
			VALUES(
				NULL,
				$id_user,
				$id_chaine,
				'$date',
				1
			)
		";
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function removeAbo($id){
		$id	= $this->db->real_escape_string($id);

		$req = "DELETE FROM abonnement 
		WHERE id_abonnement = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

}	
?>