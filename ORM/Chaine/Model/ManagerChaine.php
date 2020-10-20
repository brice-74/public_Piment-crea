<?php
namespace ORM\Chaine\Model;
use OCFram\Manager;
use ORM\Chaine\Entity\Chaine;

/*id_chaine	
nom_chaine	
description_chaine	
avatar_chaine	
visuel_chaine	
lien_in_chaine	
lien_fb_chaine	
lien_insta_chaine	
lien_ytb_chaine	
lien_tw_chaine	
actif_chaine	
date_crea_chaine*/

class ManagerChaine extends Manager {

	function updateActifChaineById(Chaine $obj){
		$actif_chaine = $this->db->real_escape_string($obj->getActifChaine());

		$req = "UPDATE `chaine` SET 
			actif_chaine = $actif_chaine
			WHERE id_chaine = ".$obj->getIdChaine();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function selectChaineByName($saisie){
		$saisie =  $this->db->real_escape_string($saisie);

		$req = "SELECT * FROM chaine
			WHERE LOWER(nom_chaine) LIKE LOWER('%$saisie%')
			AND actif_chaine = 1
		";

		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Chaine($row);
			}
			return $tableau;
		}else{
			return NULL;
		}
	}

	function selectChainesAbo($id_user){
		$id_user	= $this->db->real_escape_string($id_user);

		$req = "SELECT 
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
			abonnement.id_abonnement,
			abonnement.user_id_user,
			abonnement.chaine_id_chaine,
			abonnement.date_abonnement,
			abonnement.new_post_abonnement
			FROM chaine
				INNER JOIN abonnement
					ON chaine.id_chaine = abonnement.chaine_id_chaine
			WHERE abonnement.user_id_user = $id_user
			AND actif_chaine = 1
			ORDER BY abonnement.date_abonnement DESC
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Chaine($row);
			}
			return $tableau;
		}else{
			return NULL;
		}
	}

	function chaineExist($nom){
		$nom_chaine	= $this->db->real_escape_string($nom);

		$req = "SELECT * FROM chaine
			WHERE nom_chaine = '$nom_chaine'
			AND actif_chaine = 1
		";
		$query = $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:NULL;
	}

	function selectChaineById($id_chaine){
		$id_chaine	= $this->db->real_escape_string($id_chaine);
		$req = "SELECT * FROM chaine
			WHERE id_chaine = $id_chaine
			AND actif_chaine = 1
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Chaine($query->fetch_array()):NULL;
	}

	function selectChaine($id_chaine){
		$id_chaine	= $this->db->real_escape_string($id_chaine);
		$req = "SELECT * FROM chaine
			WHERE id_chaine = $id_chaine
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Chaine($query->fetch_array()):NULL;
	}

	function insertChaine(Chaine $objet){
		$nom_chaine				= $this->db->real_escape_string($objet->getNomChaine());
		$description_chaine		= $this->db->real_escape_string($objet->getDescriptionChaine());
		$lien_in_chaine			= $this->db->real_escape_string($objet->getLienInChaine());
		$lien_fb_chaine			= $this->db->real_escape_string($objet->getLienFbChaine());
		$lien_insta_chaine		= $this->db->real_escape_string($objet->getLienInstaChaine());
		$lien_ytb_chaine		= $this->db->real_escape_string($objet->getLienYtbChaine());
		$lien_tw_chaine			= $this->db->real_escape_string($objet->getLienTwChaine());
		$date_crea_chaine		= $objet->getDateCreaChaine();
		$req = "INSERT INTO chaine 
			VALUES(
				NULL,	
				'$nom_chaine',	
				'$description_chaine',	
				NULL,	
				NULL,	
				'$lien_in_chaine',	
				'$lien_fb_chaine',	
				'$lien_insta_chaine',	
				'$lien_ytb_chaine',	
				'$lien_tw_chaine',	
				1,	
				'$date_crea_chaine'
			)
		";
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function updateVisuel(Chaine $chaine){
		$visuel_chaine = $chaine->getVisuelChaine();
		$req = "UPDATE chaine 
			SET visuel_chaine = '$visuel_chaine'
			WHERE id_chaine =".$chaine->getIdChaine();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateAvatar(Chaine $chaine){
		$avatar_chaine = $chaine->getAvatarChaine();
		$req = "UPDATE chaine 
			SET avatar_chaine = '$avatar_chaine'
			WHERE id_chaine =".$chaine->getIdChaine();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateInfos(Chaine $chaine){
		$description_chaine 	= $this->db->real_escape_string($chaine->getDescriptionChaine());
		$lien_in_chaine 		= $this->db->real_escape_string($chaine->getLienInChaine());
		$lien_fb_chaine		= $this->db->real_escape_string($chaine->getLienFbChaine());
		$lien_insta_chaine 	= $this->db->real_escape_string($chaine->getLienInstaChaine());
		$lien_ytb_chaine 		= $this->db->real_escape_string($chaine->getLienYtbChaine());
		$lien_tw_chaine 		= $this->db->real_escape_string($chaine->getLienTwChaine());

		$req = "UPDATE chaine 
			SET 	description_chaine 	= '$description_chaine',
					lien_in_chaine 		= '$lien_in_chaine',
					lien_fb_chaine 		= '$lien_fb_chaine',
					lien_insta_chaine 	= '$lien_insta_chaine',
					lien_ytb_chaine 		= '$lien_ytb_chaine',
					lien_tw_chaine 		= '$lien_tw_chaine'
			WHERE id_chaine =".$chaine->getIdChaine();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function deleteChaine(Chaine $chaine){
		$req = "DELETE FROM chaine 
		WHERE id_chaine=".$chaine->getIdChaine();
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

}
?>