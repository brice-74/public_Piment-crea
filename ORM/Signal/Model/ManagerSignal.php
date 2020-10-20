<?php
namespace ORM\Signal\Model;
use OCFram\Manager;
use ORM\Signal\Entity\Signal;
use ORM\Chaine\Entity\Chaine;
/*
id_signal
commentaire_signal
actif_signal
date_signal
user_id_user
chaine_id_chaine
commentaire_id_commentaire
visuel_id_visuel
tuto_id_tuto
*/

class ManagerSignal extends Manager {

	function insertSignal($obj){
		$commentaire_signal = $this->db->real_escape_string($obj->getCommentaireSignal());
		$actif_signal = $this->db->real_escape_string($obj->getActifSignal());
		$date_signal = $this->db->real_escape_string($obj->getDateSignal());
		$user_id_user = $this->db->real_escape_string($obj->getUserIdUser());
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());
		$commentaire_id_commentaire = $this->db->real_escape_string($obj->getCommentaireIdCommentaire());
		$visuel_id_visuel = $this->db->real_escape_string($obj->getVisuelIdVisuel());
		$tuto_id_tuto = $this->db->real_escape_string($obj->getTutoIdTuto());

		$req = "INSERT INTO `signal`
		VALUES(
			NULL,
			'$commentaire_signal',
			$actif_signal,
			'$date_signal',
			$user_id_user,
			$chaine_id_chaine,
			$commentaire_id_commentaire,
			$visuel_id_visuel,
			$tuto_id_tuto
		)
		"; 
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function selectAllSignal(){
		$req = "SELECT * FROM `signal` ORDER BY date_signal";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Signal($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function deleteSignalsByChaine(Chaine $obj){
		$id_chaine = $obj->getIdChaine();
		$req = "DELETE FROM `signal` WHERE chaine_id_chaine = $id_chaine";
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteSignalsUser($id){
		$req = "DELETE FROM `signal` WHERE user_id_user = $id";
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function allSigalsChaine($id){
		$req = "SELECT * FROM `signal` WHERE chaine_id_chaine = $id";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Signal($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectSignalById($id){
		$id = $this->db->real_escape_string($id);

		$req = "SELECT * FROM `signal` WHERE id_signal = $id";
		$query = $this->db->query($req);
		return ($query->num_rows == 1)?new Signal($query->fetch_array()):NULL;
	}

	function updateActifSignalById(Signal $obj){
		$actif_signal = $this->db->real_escape_string($obj->getActifSignal());

		$req = "UPDATE `signal` SET 
			actif_signal = $actif_signal
			WHERE id_signal = ".$obj->getIdSignal();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

}
?>