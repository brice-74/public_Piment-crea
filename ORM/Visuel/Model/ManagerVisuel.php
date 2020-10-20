<?php
namespace ORM\Visuel\Model;
use OCFram\Manager;
use ORM\Visuel\Entity\Visuel;
use ORM\Chaine\Entity\Chaine;
/*
id_visuel	
visuel_visuel	
description_visuel	
date_post_visuel	
actif_visuel	
chaine_id_chaine
*/

class ManagerVisuel extends Manager {

	function updateActifVisuById(Visuel $obj){
		$actif_visuel = $this->db->real_escape_string($obj->getActifVisuel());

		$req = "UPDATE visuel SET 
			actif_visuel = $actif_visuel
			WHERE id_visuel = ".$obj->getIdVisuel();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function selectNbVisuByChaine($id){
		$id	= $this->db->real_escape_string($id);

		$req = "SELECT COUNT(id_visuel) AS nbVisu 
			FROM visuel
			WHERE chaine_id_chaine = $id
			AND actif_visuel = 1
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Visuel($query->fetch_array()):NULL;
	}

	function createVisuel(Visuel $obj, $id_chaine){
		$description	= $this->db->real_escape_string($obj->getDescriptionVisuel());
		$visuel			= $obj->getVisuelVisuel();
		$date			= $obj->getDatePostVisuel();

		$req = "INSERT INTO visuel 
			VALUES(
				NULL,	
				'$visuel',
				'$description',
				'$date',	
				1,
				$id_chaine
			)
		";
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function selectVisuelById($id){
		$id_visuel	= $this->db->real_escape_string($id);
		$req = "SELECT * FROM visuel
			WHERE id_visuel = $id_visuel
			AND actif_visuel = 1
			ORDER BY date_post_visuel DESC
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Visuel($query->fetch_array()):NULL;
	}

	function selectVisuel($id){
		$id_visuel	= $this->db->real_escape_string($id);
		$req = "SELECT * FROM visuel
			WHERE id_visuel = $id_visuel
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Visuel($query->fetch_array()):NULL;
	}

	function allVisuelByChaine($id_chaine){
		$req = "SELECT * FROM visuel
			WHERE chaine_id_chaine = $id_chaine
			AND actif_visuel = 1
			ORDER BY date_post_visuel DESC
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Visuel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function removeVisuelById($id_visuel){
		$req = "DELETE FROM visuel WHERE id_visuel = $id_visuel";
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function deleteVisuelsByChaine(Chaine $obj){
		$id_chaine = $obj->getIdChaine();
		$req = "DELETE FROM visuel WHERE chaine_id_chaine = $id_chaine";
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function allIdVisu(){
		$req = "SELECT id_visuel
				FROM visuel 
			WHERE actif_visuel = 1
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

	function selectVisuelsAndChainesByLogs($offset,$logs){
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
						chaine.date_crea_chaine
				FROM visuel 
			INNER JOIN chaine
				ON visuel.chaine_id_chaine = chaine.id_chaine
			INNER JOIN visuel_has_logiciel
				ON visuel_has_logiciel.visuel_id_visuel = visuel.id_visuel
			WHERE visuel.actif_visuel = 1
			AND chaine.actif_chaine = 1
			AND visuel_has_logiciel.logiciel_id_logiciel IN($logs)
			GROUP BY visuel.id_visuel
			ORDER BY visuel.date_post_visuel DESC LIMIT 24 OFFSET $offset
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

	function selectVisuelsAndChainesByThemes($offset,$themes){
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
						chaine.date_crea_chaine
				FROM visuel 
			INNER JOIN chaine
				ON visuel.chaine_id_chaine = chaine.id_chaine
			INNER JOIN visuel_has_theme
				ON visuel_has_theme.visuel_id_visuel = visuel.id_visuel
			WHERE visuel.actif_visuel = 1
			AND chaine.actif_chaine = 1
			AND visuel_has_theme.theme_id_theme IN($themes)
			GROUP BY visuel.id_visuel
			ORDER BY visuel.date_post_visuel DESC LIMIT 24 OFFSET $offset
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

	function selectVisuelsAndChainesByCat($offset,$themes,$logs){
		$req = "(SELECT 	visuel.id_visuel,	
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
						chaine.date_crea_chaine
				FROM visuel 
			INNER JOIN chaine
				ON visuel.chaine_id_chaine = chaine.id_chaine
			INNER JOIN visuel_has_theme
				ON visuel_has_theme.visuel_id_visuel = visuel.id_visuel
			WHERE visuel.actif_visuel = 1
			AND chaine.actif_chaine = 1
			AND visuel_has_theme.theme_id_theme IN($themes)
			GROUP BY visuel.id_visuel
			ORDER BY visuel.date_post_visuel DESC LIMIT 24 OFFSET $offset)
			UNION
			(SELECT 	visuel.id_visuel,	
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
						chaine.date_crea_chaine
				FROM visuel 
			INNER JOIN chaine
				ON visuel.chaine_id_chaine = chaine.id_chaine
			INNER JOIN visuel_has_logiciel
				ON visuel_has_logiciel.visuel_id_visuel = visuel.id_visuel
			WHERE visuel.actif_visuel = 1
			AND chaine.actif_chaine = 1
			AND visuel_has_logiciel.logiciel_id_logiciel IN($logs)
			GROUP BY visuel.id_visuel
			ORDER BY visuel.date_post_visuel DESC LIMIT 24 OFFSET $offset)
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

	function selectVisuelsAndChaines($offset){
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
						chaine.date_crea_chaine
				FROM visuel 
			INNER JOIN chaine
				ON visuel.chaine_id_chaine = chaine.id_chaine
			WHERE visuel.actif_visuel = 1
			AND chaine.actif_chaine = 1
			GROUP BY visuel.id_visuel
			ORDER BY visuel.date_post_visuel DESC LIMIT 24 OFFSET $offset
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

	function selectVisuelsAndChainesAbos($id_user){
		$id_user	= $this->db->real_escape_string($id_user);
		$req = "SELECT
						/*abonnement.id_abonnement,
						abonnement.user_id_user,
						abonnement.chaine_id_chaine,
						abonnement.date_abonnement,
						abonnement.new_post_abonnement, */	
						visuel.id_visuel,	
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
						chaine.date_crea_chaine
				FROM visuel 
			INNER JOIN chaine
				ON visuel.chaine_id_chaine = chaine.id_chaine
			INNER JOIN abonnement
				ON abonnement.chaine_id_chaine = chaine.id_chaine
			WHERE visuel.actif_visuel = 1
			AND chaine.actif_chaine = 1
			AND abonnement.user_id_user = $id_user
			GROUP BY visuel.id_visuel
			ORDER BY visuel.date_post_visuel DESC
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

}
?>