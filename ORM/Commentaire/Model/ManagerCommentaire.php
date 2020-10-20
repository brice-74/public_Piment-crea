<?php
namespace ORM\Commentaire\Model;
use OCFram\Manager;
use ORM\Commentaire\Entity\Commentaire;
/*
id_commentaire
contenu_commentaire
actif_commentaire
date_commentaire
new_post_commentaire
tuto_id_tuto
visuel_id_visuel
user_id_user
*/

class ManagerCommentaire extends Manager {

	function updateActifComById(Commentaire $obj){
		$actif_com = $this->db->real_escape_string($obj->getActifCommentaire());

		$req = "UPDATE commentaire SET 
			actif_commentaire = $actif_com
			WHERE id_commentaire = ".$obj->getIdCommentaire();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateNewPostComsByTuto($id_tuto){
		$id_tuto = $this->db->real_escape_string($id_tuto);

		$req = "UPDATE commentaire
			SET
			new_post_commentaire	= 0
			WHERE tuto_id_tuto = $id_tuto
		";
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function updateNewPostComsByVisu($id_visu){
		$id_visu = $this->db->real_escape_string($id_visu);

		$req = "UPDATE commentaire
			SET
			new_post_commentaire	= 0
			WHERE visuel_id_visuel = $id_visu
		";
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function countCommentairesVisuelUser($id_user){
		$req = " SELECT 
			COUNT(id_commentaire) AS countComVisu
			FROM commentaire
			WHERE user_id_user = $id_user
			AND tuto_id_tuto IS NULL
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Commentaire($query->fetch_array()):NULL;
	}

	function countCommentairesTutoUser($id_user){
		$req = " SELECT 
			COUNT(id_commentaire) AS countComTuto
			FROM commentaire
			WHERE user_id_user = $id_user
			AND visuel_id_visuel IS NULL
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Commentaire($query->fetch_array()):NULL;
	}

	function deleteCommentairesUser($id){
		$req = "DELETE FROM commentaire 
		WHERE user_id_user = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteCommentairesVisuel($id){
		$req = "DELETE FROM commentaire 
		WHERE visuel_id_visuel = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteCommentairesTuto($id){
		$req = "DELETE FROM commentaire 
		WHERE tuto_id_tuto = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function insertCommentaireTuto(Commentaire $obj){
		$new_post_com			= $this->db->real_escape_string($obj->getNewPostCommentaire());
		$contenu_commentaire	= $this->db->real_escape_string($obj->getContenuCommentaire());
		$date_commentaire		= $this->db->real_escape_string($obj->getDateCommentaire());
		$id_tuto					= $this->db->real_escape_string($obj->getTutoIdTuto());
		$id_user					= $this->db->real_escape_string($obj->getUserIdUser());

		$req = "INSERT INTO commentaire
		VALUES(
			NULL,
			'$contenu_commentaire',
			1,
			'$date_commentaire',
			$new_post_com,
			$id_tuto,
			NULL,
			$id_user
		)
		"; 
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function insertCommentaireVisu(Commentaire $obj){
		$new_post_com			= $this->db->real_escape_string($obj->getNewPostCommentaire());
		$contenu_commentaire	= $this->db->real_escape_string($obj->getContenuCommentaire());
		$date_commentaire		= $this->db->real_escape_string($obj->getDateCommentaire());
		$id_visuel				= $this->db->real_escape_string($obj->getVisuelIdVisuel());
		$id_user					= $this->db->real_escape_string($obj->getUserIdUser());

		$req = "INSERT INTO commentaire
		VALUES(
			NULL,
			'$contenu_commentaire',
			1,
			'$date_commentaire',
			$new_post_com,
			NULL,
			$id_visuel,
			$id_user
		)
		"; 
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function selectComById($id_com){
		$id_commentaire	= $this->db->real_escape_string($id_com);
		$req = "
			SELECT * FROM commentaire
			WHERE actif_commentaire = 1
			AND id_commentaire = $id_com
		";
		$query = $this->db->query($req);
		if($query->num_rows == 1){
			return new Commentaire($query->fetch_array());
		}else{
			return NULL;
		}
	}

	function selectCom($id_com){
		$id_com	= $this->db->real_escape_string($id_com);
		$req = "
			SELECT * FROM commentaire
			WHERE id_commentaire = $id_com
		";
		$query = $this->db->query($req);
		if($query->num_rows == 1){
			return new Commentaire($query->fetch_array());
		}else{
			return NULL;
		}
	}

	function selectComByIdAndUser($id_com,$id_user){
		$id_commentaire	= $this->db->real_escape_string($id_com);
		$user_id_user		= $this->db->real_escape_string($id_user);
		$req = "
			SELECT * FROM commentaire
			WHERE actif_commentaire = 1
			AND user_id_user = $id_user
			AND id_commentaire = $id_com
		";
		$query = $this->db->query($req);
		if($query->num_rows == 1){
			return new Commentaire($query->fetch_array());
		}else{
			return NULL;
		}
	}

	function removeCom($id_com){
		$req = "DELETE FROM commentaire 
		WHERE id_commentaire = $id_com";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}
	

	function selectComAndUsersByVisu($id_visu){
		$id_visuel	= $this->db->real_escape_string($id_visu);
		$req = "
			SELECT 
			commentaire.id_commentaire,
			commentaire.contenu_commentaire,
			commentaire.actif_commentaire,
			commentaire.date_commentaire,
			commentaire.new_post_commentaire,
			commentaire.tuto_id_tuto,
			commentaire.visuel_id_visuel,
			commentaire.user_id_user,
			user.id_user,
			user.nom_user,
			user.prenom_user,
			user.avatar_user
			FROM commentaire
				INNER JOIN user
					ON user.id_user = commentaire.user_id_user
				INNER JOIN visuel
					ON visuel.id_visuel = commentaire.visuel_id_visuel
			WHERE commentaire.actif_commentaire = 1
			AND user.actif_user = 1
			AND visuel.id_visuel = $id_visu
			ORDER BY commentaire.date_commentaire DESC
		";

		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Commentaire($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectComAndUserByIdCom($id_com){
		$id_commentaire	= $this->db->real_escape_string($id_com);
		$req = "
			SELECT 
			commentaire.id_commentaire,
			commentaire.contenu_commentaire,
			commentaire.actif_commentaire,
			commentaire.date_commentaire,
			commentaire.new_post_commentaire,
			commentaire.tuto_id_tuto,
			commentaire.visuel_id_visuel,
			commentaire.user_id_user,
			user.id_user,
			user.nom_user,
			user.prenom_user,
			user.avatar_user
			FROM commentaire
				INNER JOIN user
					ON user.id_user = commentaire.user_id_user
			WHERE commentaire.actif_commentaire = 1
			AND user.actif_user = 1
			AND commentaire.id_commentaire = $id_com
		";

		$query = $this->db->query($req);
		return $query->fetch_array();
	}

	function selectComAndUsersByTuto($id_tuto){
		$id_visuel	= $this->db->real_escape_string($id_tuto);
		$req = "
			SELECT 
			commentaire.id_commentaire,
			commentaire.contenu_commentaire,
			commentaire.actif_commentaire,
			commentaire.date_commentaire,
			commentaire.new_post_commentaire,
			commentaire.tuto_id_tuto,
			commentaire.visuel_id_visuel,
			commentaire.user_id_user,
			user.id_user,
			user.nom_user,
			user.prenom_user,
			user.avatar_user
			FROM commentaire
				INNER JOIN user
					ON user.id_user = commentaire.user_id_user
				INNER JOIN tuto
					ON tuto.id_tuto = commentaire.tuto_id_tuto
			WHERE commentaire.actif_commentaire = 1
			AND user.actif_user = 1
			AND tuto.id_tuto = $id_tuto
			ORDER BY commentaire.date_commentaire DESC
		";

		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Commentaire($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function countComByVisu($id_visu){
		$id_visuel	= $this->db->real_escape_string($id_visu);
		$req = "
			SELECT COUNT(*) AS nb_com 
			FROM commentaire 
			WHERE visuel_id_visuel = $id_visu
		";
		$query = $this->db->query($req);
		return $query->fetch_array();
	}

	function countComByTuto($id_tuto){
		$id_visuel	= $this->db->real_escape_string($id_tuto);
		$req = "
			SELECT COUNT(*) AS nb_com 
			FROM commentaire 
			WHERE tuto_id_tuto = $id_tuto
		";
		$query = $this->db->query($req);
		return $query->fetch_array();
	}

}
?>