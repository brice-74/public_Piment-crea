<?php
namespace ORM\Logiciel\Model;
use OCFram\Manager;
use ORM\Logiciel\Entity\Logiciel;
/*
id_logiciel
titre_logiciel
actif_logiciel
date_logiciel
*/

class ManagerLogiciel extends Manager {

	function SelectVisuHasLogicielByVisu($chaine){
		$req = "SELECT 
			logiciel.id_logiciel,
			logiciel.titre_logiciel
		 FROM logiciel
			INNER JOIN visuel_has_logiciel
				ON visuel_has_logiciel.logiciel_id_logiciel = logiciel.id_logiciel
			WHERE visuel_has_logiciel.visuel_id_visuel 
			AND logiciel.actif_logiciel
			IN($chaine) GROUP BY logiciel_id_logiciel
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Logiciel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function SelectTutoHasLogicielByTuto($chaine){
		$req = "SELECT 
			logiciel.id_logiciel,
			logiciel.titre_logiciel
		 FROM logiciel
			INNER JOIN tuto_has_logiciel
				ON tuto_has_logiciel.logiciel_id_logiciel = logiciel.id_logiciel
			WHERE tuto_has_logiciel.tuto_id_tuto AND logiciel.actif_logiciel AND tuto_has_logiciel.tuto_id_tuto IN($chaine) GROUP BY logiciel_id_logiciel
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Logiciel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectLogiciels(){
		$req = "SELECT * FROM logiciel WHERE actif_logiciel = 1";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Logiciel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectLogicielsByIds($chaine){
		$req = "SELECT * FROM logiciel WHERE actif_logiciel = 1 AND id_logiciel IN($chaine)";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Logiciel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function removeVisuelHasLogiciel($id_visuel){
		$req = "DELETE FROM visuel_has_logiciel
		WHERE visuel_id_visuel = $id_visuel";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function insertVisuelHasLogiciel($id_visuel,$id_logiciel){
		$req = "INSERT INTO visuel_has_logiciel
		VALUES(
			$id_visuel,
			$id_logiciel
		)
		"; 
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function issetTutoHasLogiciel($id_tuto,$id_log){
		$req = "SELECT * FROM tuto_has_logiciel
			WHERE tuto_id_tuto = $id_tuto
			AND logiciel_id_logiciel = $id_log
		";
		$query = $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:FALSE;
	}

	function removeTutoHasLogiciel($id_tuto,$id_log){
		$req = "DELETE FROM tuto_has_logiciel
			WHERE tuto_id_tuto = $id_tuto
			AND logiciel_id_logiciel = $id_log
		";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function removeTutosHasLogiciel($id_tuto){
		$req = "DELETE FROM tuto_has_logiciel
			WHERE tuto_id_tuto = $id_tuto
		";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function insertTutoHasLogiciel($id_tuto,$id_log){
		$req = "INSERT INTO tuto_has_logiciel
		VALUES(
			$id_tuto,
			$id_log
		)
		"; 
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function insertLogiciel(Logiciel $obj){
		$titre = $this->db->real_escape_string($obj->getTitreLogiciel());
		$actif = $this->db->real_escape_string($obj->getActifLogiciel());
		$date = $this->db->real_escape_string($obj->getDateLogiciel());

		$req = "INSERT INTO logiciel
		VALUES(
			NULL,
			'$titre',
			$actif,
			'$date'
		)
		"; 
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function SelectTutoHasLogiciel($id_tuto){
		$req = "SELECT * FROM tuto_has_logiciel
			WHERE tuto_id_tuto = $id_tuto
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Logiciel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectLogicielsVisuel($id_visuel){
		$req = "SELECT 	
						logiciel.id_logiciel,
						logiciel.titre_logiciel,
						logiciel.actif_logiciel,
						logiciel.date_logiciel 
				FROM visuel_has_logiciel
					INNER JOIN logiciel
						ON visuel_has_logiciel.logiciel_id_logiciel = logiciel.id_logiciel
				WHERE logiciel.actif_logiciel = 1
            AND visuel_has_logiciel.visuel_id_visuel = $id_visuel";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Logiciel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectLogicielsTuto($id_tuto){
		$req = "SELECT 	
						logiciel.id_logiciel,
						logiciel.titre_logiciel,
						logiciel.actif_logiciel,
						logiciel.date_logiciel 
				FROM tuto_has_logiciel
					INNER JOIN logiciel
						ON tuto_has_logiciel.logiciel_id_logiciel = logiciel.id_logiciel
				WHERE logiciel.actif_logiciel = 1
            AND tuto_has_logiciel.tuto_id_tuto = $id_tuto";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Logiciel($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

}
?>