<?php
namespace ORM\Language\Model;
use OCFram\Manager;
use ORM\Language\Entity\Language;
/*
id_language
titre_language
actif_language
date_language
*/

class ManagerLanguage extends Manager {

	function insertLanguage(Language $obj){
		$titre = $this->db->real_escape_string($obj->getTitreLanguage());
		$actif = $this->db->real_escape_string($obj->getActifLanguage());
		$date = $this->db->real_escape_string($obj->getDateLanguage());

		$req = "INSERT INTO language
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

	function SelectTutoHasLanguageByTuto($chaine){
		$req = "SELECT 
			language.id_language,
			language.titre_language
		 FROM language
			INNER JOIN tuto_has_language
				ON tuto_has_language.language_id_language = language.id_language
			WHERE tuto_has_language.tuto_id_tuto AND language.actif_language = 1 AND tuto_has_language.tuto_id_tuto IN($chaine) GROUP BY language_id_language
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Language($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectLanguage(){
		$req = "SELECT * FROM language WHERE actif_language = 1";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Language($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectLanguagesTuto($id_tuto){
		$req = "SELECT 	
						language.id_language,
						language.titre_language,
						language.actif_language,
						language.date_language 
				FROM tuto_has_language
					INNER JOIN language
						ON tuto_has_language.language_id_language = language.id_language
				WHERE language.actif_language = 1
            AND tuto_has_language.tuto_id_tuto = $id_tuto";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Language($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function removeTutosHasLanguage($id_tuto){
		$req = "DELETE FROM tuto_has_language
			WHERE tuto_id_tuto = $id_tuto
		";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function issetTutoHasLanguage($id_tuto,$id_lang){
		$req = "SELECT * FROM tuto_has_language
			WHERE tuto_id_tuto = $id_tuto
			AND language_id_language = $id_lang
		";
		$query = $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:FALSE;
	}

	function removeTutoHasLanguage($id_tuto,$id_lang){
		$req = "DELETE FROM tuto_has_language
			WHERE tuto_id_tuto = $id_tuto
			AND language_id_language = $id_lang
		";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function insertTutoHasLanguage($id_tuto,$id_lang){
		$req = "INSERT INTO tuto_has_language
		VALUES(
			$id_tuto,
			$id_lang
		)
		"; 
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function SelectTutoHasLanguage($id_tuto){
		$req = "SELECT * FROM tuto_has_language
			WHERE tuto_id_tuto = $id_tuto
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Language($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

}
?>