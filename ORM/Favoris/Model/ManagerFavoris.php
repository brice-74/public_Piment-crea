<?php
namespace ORM\Favoris\Model;
use OCFram\Manager;
use ORM\Favoris\Entity\Favoris;
use ORM\Visuel\Entity\Visuel;
use ORM\Tuto\Entity\Tuto;
/*
id_favoris
user_id_user	
tuto_id_tuto	
visuel_id_visuel	
date_favoris
*/

class ManagerFavoris extends Manager {

	function countFavorisVisuelUser($id_user){
		$req = " SELECT 
			COUNT(id_favoris) AS countFavVisu
			FROM favoris
			WHERE user_id_user = $id_user
			AND tuto_id_tuto IS NULL
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Favoris($query->fetch_array()):NULL;
	}

	function countFavorisTutoUser($id_user){
		$req = " SELECT 
			COUNT(favoris.id_favoris) AS countFavTuto
			FROM favoris
				INNER JOIN tuto
					ON favoris.tuto_id_tuto = tuto.id_tuto
			WHERE favoris.user_id_user = $id_user
			AND favoris.visuel_id_visuel IS NULL
			AND tuto.post_tuto = 1
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Favoris($query->fetch_array()):NULL;
	}

	function deleteFavorisUser($id){
		$req = "DELETE FROM favoris 
		WHERE user_id_user = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteFavorisVisuel($id){
		$req = "DELETE FROM favoris 
		WHERE visuel_id_visuel = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteFavorisTuto($id){
		$req = "DELETE FROM favoris 
		WHERE tuto_id_tuto = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function removeVisuelFavoris($fav){
		$id_user = $fav->getUserIdUser();
		$id_visu = $fav->getVisuelIdVisuel();
		$req = "
			DELETE FROM favoris
			WHERE user_id_user = $id_user
			AND visuel_id_visuel = $id_visu
		";	
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function removeTutoFavoris($fav){
		$id_user = $fav->getUserIdUser();
		$id_tuto = $fav->getTutoIdTuto();
		$req = "
			DELETE FROM favoris
			WHERE user_id_user = $id_user
			AND tuto_id_tuto = $id_tuto
		";	
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function insertVisuelFavoris($obj){
		$date 	 = $obj->getDateFavoris();
		$id_user = $obj->getUserIdUser();
		$id_visu = $obj->getVisuelIdVisuel();
		$req = "
			INSERT INTO favoris
			VALUES(
			NULL,
			$id_user,
			NULL,
			$id_visu,
			'$date'
			)
		";	
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function insertTutoFavoris($obj){
		$date 	 = $obj->getDateFavoris();
		$id_user = $obj->getUserIdUser();
		$id_tuto = $obj->getTutoIdTuto();
		$req = "
			INSERT INTO favoris
			VALUES(
			NULL,
			$id_user,
			$id_tuto,
			NULL,
			'$date'
			)
		";	
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function favorisVisuelExist($id_user,$id_visu){
		$req = "
			SELECT * FROM favoris
			WHERE user_id_user = $id_user
			AND visuel_id_visuel = $id_visu
		";	
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Favoris($query->fetch_array()):NULL;
	}


	function favorisTutoExist($id_user,$id_tuto){
		$req = "
			SELECT * FROM favoris
			WHERE user_id_user = $id_user
			AND tuto_id_tuto = $id_tuto
		";	
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Favoris($query->fetch_array()):NULL;
	}

	function visuelsAndChainesByFavoris($id_user){
		$req = "SELECT 	visuel.id_visuel,	
					visuel.visuel_visuel,	
					visuel.description_visuel,
					visuel.date_post_visuel,	
					visuel.actif_visuel,	
					visuel.chaine_id_chaine, 
					chaine.id_chaine,	
					chaine.nom_chaine,	
					chaine.description_chaine,	
					chaine.avatar_chaine,	
					chaine.visuel_chaine,	
					chaine.lien_in_chaine,	
					chaine.lien_fb_chaine,	
					chaine.lien_insta_chaine,	
					chaine.lien_ytb_chaine,	
					chaine.lien_tw_chaine,	
					chaine.actif_chaine,	
					chaine.date_crea_chaine,
					favoris.id_favoris,
					favoris.user_id_user,	
					favoris.tuto_id_tuto,	
					favoris.visuel_id_visuel,	
					favoris.date_favoris
				FROM visuel 
			INNER JOIN chaine
				ON visuel.chaine_id_chaine = chaine.id_chaine
			INNER JOIN favoris
				ON favoris.visuel_id_visuel = visuel.id_visuel
			WHERE visuel.actif_visuel = 1
			AND chaine.actif_chaine = 1
			AND favoris.user_id_user = $id_user
			ORDER BY favoris.date_favoris DESC
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new visuel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function tutosAndChainesByFavoris($id_user){
		$req = "SELECT 	
					tuto.id_tuto,	
					tuto.titre_tuto,	
					tuto.visuel_tuto,	
					tuto.html_tuto,	
					tuto.date_crea_tuto,	
					tuto.date_modif_tuto,	
					tuto.date_post_tuto,	
					tuto.actif_tuto,	
					tuto.post_tuto,	
					tuto.chaine_id_chaine,
					chaine.id_chaine,	
					chaine.nom_chaine,	
					chaine.description_chaine,	
					chaine.avatar_chaine,	
					chaine.visuel_chaine,	
					chaine.lien_in_chaine,	
					chaine.lien_fb_chaine,	
					chaine.lien_insta_chaine,	
					chaine.lien_ytb_chaine,	
					chaine.lien_tw_chaine,	
					chaine.actif_chaine,	
					chaine.date_crea_chaine,
					favoris.id_favoris,
					favoris.user_id_user,	
					favoris.tuto_id_tuto,	
					favoris.visuel_id_visuel,	
					favoris.date_favoris
				FROM tuto 
			INNER JOIN chaine
				ON tuto.chaine_id_chaine = chaine.id_chaine
			INNER JOIN favoris
				ON favoris.tuto_id_tuto = tuto.id_tuto
			WHERE tuto.actif_tuto = 1
			AND tuto.post_tuto = 1
			AND chaine.actif_chaine = 1
			AND favoris.user_id_user = $id_user
			ORDER BY favoris.date_favoris DESC
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Tuto($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}


}
?>