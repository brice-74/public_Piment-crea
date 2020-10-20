<?php
namespace ORM\Note\Model;
use OCFram\Manager;
use ORM\Note\Entity\Note;

/*
id_note
post_note
date_note
user_id_user
tuto_id_tuto
*/

class ManagerNote extends Manager {

	function countNotesUser($id_user){
		$req = " SELECT 
			COUNT(id_note) AS countNote
			FROM note
			WHERE user_id_user = $id_user
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Note($query->fetch_array()):NULL;
	}

	function deleteNotesUser($id){
		$req = "DELETE FROM note 
		WHERE user_id_user = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteNotesTuto($id){
		$req = "DELETE FROM note 
		WHERE tuto_id_tuto = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function countAndSumNoteByTuto($id_tuto){
		$id_tuto = $this->db->real_escape_string($id_tuto);

		$req = "
			SELECT
				COUNT(id_note) AS countNote,
				SUM(post_note) AS sumNote
				FROM note
				WHERE tuto_id_tuto = $id_tuto;
		";

		$query = $this->db->query($req);
		return ($query->num_rows > 0)?$query->fetch_array():NULL;
	}

	function countAndSumNoteByTuto2($id_tuto){
		$id_tuto = $this->db->real_escape_string($id_tuto);

		$req = "
			SELECT 
			note.tuto_id_tuto,
			COUNT(note.id_note) AS countNote,
			SUM(note.post_note) AS sumNote
			FROM note
             INNER JOIN tuto
                ON tuto.id_tuto = note.tuto_id_tuto
			WHERE tuto_id_tuto = $id_tuto
            GROUP BY tuto.id_tuto
		";

		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Note($query->fetch_array()):NULL;
	}

	function issetNoteByTuto($id_tuto){
		$id_tuto = $this->db->real_escape_string($id_tuto);

		$req = "SELECT * FROM note
			WHERE tuto_id_tuto = $id_tuto
		";

		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Note($query->fetch_array()):NULL;
	}

	function issetNote($id_tuto,$id_user){
		$id_user = $this->db->real_escape_string($id_user);
		$id_tuto = $this->db->real_escape_string($id_tuto);

		$req = "SELECT * FROM note
			WHERE user_id_user = $id_user
			AND tuto_id_tuto = $id_tuto
		";

		$query = $this->db->query($req);
		return ($query->num_rows == 1)?new Note($query->fetch_array()):NULL;
	}

	function insertNote(Note $obj){
		$date = $this->db->real_escape_string($obj->getDateNote());
		$val_note = $this->db->real_escape_string($obj->getPostNote());
		$id_user = $this->db->real_escape_string($obj->getUserIdUser());
		$id_tuto = $this->db->real_escape_string($obj->getTutoIdTuto());

		$req = "INSERT INTO note 
			VALUES(
				NULL,
				$val_note,
				'$date',
				$id_user,
				$id_tuto
			)
		";
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function updateNote(Note $obj){
		$id_note = $this->db->real_escape_string($obj->getIdNote());
		$date = $this->db->real_escape_string($obj->getDateNote());
		$val_note = $this->db->real_escape_string($obj->getPostNote());

		$req = "UPDATE note 
			SET
				post_note = $val_note,
				date_note = '$date'
			WHERE id_note = $id_note
		";
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}
}	
?>