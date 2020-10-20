<?php
namespace ORM\Theme\Model;
use OCFram\Manager;
use ORM\Theme\Entity\Theme;
/*
id_theme
titre_theme
actif_theme
date_theme
*/

class ManagerTheme extends Manager {

	function insertTheme(Theme $obj){
		$titre = $this->db->real_escape_string($obj->getTitreTheme());
		$actif = $this->db->real_escape_string($obj->getActifTheme());
		$date = $this->db->real_escape_string($obj->getDateTheme());

		$req = "INSERT INTO theme
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

	function SelectVisuHasThemeByVisu($chaine){
		$req = "SELECT 
		theme.id_theme,
		theme.titre_theme
		 FROM theme
			INNER JOIN visuel_has_theme
				ON visuel_has_theme.theme_id_theme = theme.id_theme
			WHERE visuel_has_theme.visuel_id_visuel AND theme.actif_theme = 1 IN($chaine) GROUP BY theme_id_theme
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Theme($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function SelectTutoHasThemeByTuto($chaine){
		$req = "SELECT
			theme.id_theme,
			theme.titre_theme 
			FROM theme
			INNER JOIN tuto_has_theme
				ON tuto_has_theme.theme_id_theme = theme.id_theme
			WHERE tuto_has_theme.tuto_id_tuto AND theme.actif_theme = 1 AND tuto_has_theme.tuto_id_tuto  IN($chaine) GROUP BY theme_id_theme
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Theme($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectThemes(){
		$req = "SELECT * FROM theme WHERE actif_theme = 1";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Theme($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectThemesVisuel($id_visuel){
		$req = "SELECT 	
						theme.id_theme,
						theme.titre_theme,
						theme.actif_theme,
						theme.date_theme 
				FROM visuel_has_theme 
					INNER JOIN theme
						ON visuel_has_theme.theme_id_theme = theme.id_theme
				WHERE theme.actif_theme = 1
            AND visuel_has_theme.visuel_id_visuel = $id_visuel";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Theme($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

		function selectThemesTuto($id_tuto){
		$req = "SELECT 	
						theme.id_theme,
						theme.titre_theme,
						theme.actif_theme,
						theme.date_theme 
				FROM tuto_has_theme 
					INNER JOIN theme
						ON tuto_has_theme.theme_id_theme = theme.id_theme
				WHERE theme.actif_theme = 1
            AND tuto_has_theme.tuto_id_tuto = $id_tuto";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Theme($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function removeVisuelHasTheme($id_visuel){
		$req = "DELETE FROM visuel_has_theme
		WHERE visuel_id_visuel = $id_visuel";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function removeTutosHasTheme($id_tuto){
		$req = "DELETE FROM tuto_has_theme
			WHERE tuto_id_tuto = $id_tuto
		";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function insertVisuelHasTheme($id_visuel,$id_theme){
		$req = "INSERT INTO visuel_has_theme
		VALUES(
			$id_visuel,
			$id_theme
		)
		"; 
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function issetTutoHasTheme($id_tuto,$id_theme){
		$req = "SELECT * FROM tuto_has_theme
			WHERE tuto_id_tuto = $id_tuto
			AND theme_id_theme = $id_theme
		";
		$query = $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:FALSE;
	}

	function removeTutoHasTheme($id_tuto,$id_theme){
		$req = "DELETE FROM tuto_has_theme
			WHERE tuto_id_tuto = $id_tuto
			AND theme_id_theme = $id_theme
		";
		
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function insertTutoHasTheme($id_tuto,$id_theme){
		$req = "INSERT INTO tuto_has_theme
		VALUES(
			$id_tuto,
			$id_theme
		)
		"; 
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function SelectTutoHasTheme($id_tuto){
		$req = "SELECT * FROM tuto_has_theme
			WHERE tuto_id_tuto = $id_tuto
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Theme($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

}
?>