<?php
namespace ORM\Tuto\Model;
use OCFram\Manager;
use ORM\Tuto\Entity\Tuto;
use ORM\Chaine\Entity\Chaine;

/*
id_tuto	
titre_tuto	
visuel_tuto	
html_tuto	
date_crea_tuto	
date_modif_tuto	
date_post_tuto	
actif_tuto	
post_tuto	
chaine_id_chaine
*/

class ManagerTuto extends Manager {

	function updateActifTutoById(Tuto $obj){
		$actif_tuto = $this->db->real_escape_string($obj->getActifTuto());

		$req = "UPDATE tuto SET 
			actif_tuto = $actif_tuto
			WHERE id_tuto = ".$obj->getIdTuto();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

		function selectTutosPostAndChainesByLang($offset,$langs){
			$req = "SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
							/*tuto.html_tuto,	*/
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_language
					ON tuto_has_language.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_language.language_id_language IN($langs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset
			";
			$query = $this->db->query($req);
			if($query->num_rows > 0){
				while($row = $query->fetch_array()){
					$tableau[] = new tuto($row);
				}
				return $tableau;
			}else{
				NULL;
			}
		}	

		function selectTutosPostAndChainesBylog($offset,$logs){
			$req = "SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
							/*tuto.html_tuto,	*/
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_logiciel
					ON tuto_has_logiciel.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_logiciel.logiciel_id_logiciel IN($logs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset
			";
			$query = $this->db->query($req);
			if($query->num_rows > 0){
				while($row = $query->fetch_array()){
					$tableau[] = new tuto($row);
				}
				return $tableau;
			}else{
				NULL;
			}
		}	

		function selectTutosPostAndChainesByTheme($offset,$themes){
			$req = "SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
							/*tuto.html_tuto,*/	
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_theme
					ON tuto_has_theme.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_theme.theme_id_theme IN($themes)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset
			";
			$query = $this->db->query($req);
			if($query->num_rows > 0){
				while($row = $query->fetch_array()){
					$tableau[] = new tuto($row);
				}
				return $tableau;
			}else{
				NULL;
			}
		}


		function selectTutosPostAndChainesBylogAndLang($offset,$logs,$langs){
			$req = "
				(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,		
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_logiciel
					ON tuto_has_logiciel.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_logiciel.logiciel_id_logiciel IN($logs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
				UNION
				(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_language
					ON tuto_has_language.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_language.language_id_language IN($langs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
			";
			$query = $this->db->query($req);
			if($query->num_rows > 0){
				while($row = $query->fetch_array()){
					$tableau[] = new tuto($row);
				}
				return $tableau;
			}else{
				NULL;
			}
		}	

		function selectTutosPostAndChainesByThemeAndlang($offset,$themes,$langs){
			$req = "(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_theme
					ON tuto_has_theme.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_theme.theme_id_theme IN($themes)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
				UNION
				(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,		
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_language
					ON tuto_has_language.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_language.language_id_language IN($langs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
			";
			$query = $this->db->query($req);
			if($query->num_rows > 0){
				while($row = $query->fetch_array()){
					$tableau[] = new tuto($row);
				}
				return $tableau;
			}else{
				NULL;
			}
		}

		function selectTutosPostAndChainesByThemeAndlog($offset,$themes,$logs){
			$req = "(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,		
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_theme
					ON tuto_has_theme.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_theme.theme_id_theme IN($themes)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
				UNION
				(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_logiciel
					ON tuto_has_logiciel.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_logiciel.logiciel_id_logiciel IN($logs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
			";
			$query = $this->db->query($req);
			if($query->num_rows > 0){
				while($row = $query->fetch_array()){
					$tableau[] = new tuto($row);
				}
				return $tableau;
			}else{
				NULL;
			}
		}		


		function selectTutosPostAndChainesByCat($offset,$themes,$logs,$langs){
			$req = "(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_theme
					ON tuto_has_theme.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_theme.theme_id_theme IN($themes)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
				UNION
				(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,	
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_logiciel
					ON tuto_has_logiciel.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_logiciel.logiciel_id_logiciel IN($logs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
				UNION
				(SELECT 	
							tuto.id_tuto,	
							tuto.titre_tuto,	
							tuto.visuel_tuto,		
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
							chaine.date_crea_chaine
					FROM tuto 
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
				INNER JOIN tuto_has_language
					ON tuto_has_language.tuto_id_tuto = tuto.id_tuto
				WHERE tuto.actif_tuto = 1
				AND chaine.actif_chaine = 1
				AND tuto.post_tuto = 1
				AND tuto_has_language.language_id_language IN($langs)
				GROUP BY tuto.id_tuto
				ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset)
			";
			$query = $this->db->query($req);
			if($query->num_rows > 0){
				while($row = $query->fetch_array()){
					$tableau[] = new tuto($row);
				}
				return $tableau;
			}else{
				NULL;
			}
		}

		function selectTutosAndChainesAbos($id_user){
		$id_user	= $this->db->real_escape_string($id_user);
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
						chaine.date_crea_chaine
				FROM tuto 
			INNER JOIN chaine
				ON tuto.chaine_id_chaine = chaine.id_chaine
			INNER JOIN abonnement
				ON abonnement.chaine_id_chaine = chaine.id_chaine
			WHERE tuto.actif_tuto = 1
			AND tuto.post_tuto = 1
			AND chaine.actif_chaine = 1
			AND abonnement.user_id_user = $id_user
			GROUP BY tuto.id_tuto
			ORDER BY tuto.date_post_tuto DESC
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new tuto($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function selectTutoByTitle($saisie){
		$saisie =  $this->db->real_escape_string($saisie);

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
			chaine.date_crea_chaine
			FROM tuto
				INNER JOIN chaine
					ON tuto.chaine_id_chaine = chaine.id_chaine
			WHERE LOWER(tuto.titre_tuto) LIKE LOWER('%$saisie%')
			AND actif_tuto = 1
			AND post_tuto = 1
		";

		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Tuto($row);
			}
			return $tableau;
		}else{
			return NULL;
		}
	}

	function insertTuto($obj){
		$date_crea = $obj->getDateCreaTuto();
		$id_chaine = $obj->getChaineIdChaine();

		$req = "INSERT INTO tuto 
			VALUES(
				NULL,	
				NULL,
				NULL,
				NULL,
				'$date_crea',
				NULL,
				NULL,
				1,
				0,
				$id_chaine
			)
		";
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function selectTutoPostById($id){
		$id	= $this->db->real_escape_string($id);

		$req = "SELECT * FROM tuto
			WHERE id_tuto = $id
			AND actif_tuto = 1
			AND post_tuto = 1
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Tuto($query->fetch_array()):NULL;
	}

	function selectTutoById($id){
		$id	= $this->db->real_escape_string($id);

		$req = "SELECT * FROM tuto
			WHERE id_tuto = $id
			AND actif_tuto = 1
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Tuto($query->fetch_array()):NULL;
	}

	function selectTuto($id){
		$id	= $this->db->real_escape_string($id);

		$req = "SELECT * FROM tuto
			WHERE id_tuto = $id
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Tuto($query->fetch_array()):NULL;
	}

	function selectNoPostTutoById($id){
		$id	= $this->db->real_escape_string($id);

		$req = "SELECT * FROM tuto
			WHERE id_tuto = $id
			AND actif_tuto = 1
			AND post_tuto = 0
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Tuto($query->fetch_array()):NULL;
	}

	function selectNbTutoByChaine($id){
		$id	= $this->db->real_escape_string($id);

		$req = "SELECT COUNT(id_tuto) AS nbTuto 
			FROM tuto
			WHERE chaine_id_chaine = $id
			AND actif_tuto = 1
			AND post_tuto = 1
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Tuto($query->fetch_array()):NULL;
	}
	
	function selectNoPostTutos($id_chaine){

		$req = "SELECT * FROM tuto
			WHERE post_tuto = 0
			AND chaine_id_chaine = $id_chaine
			AND actif_tuto = 1
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

	function updateTitreTuto(Tuto $obj){
		$id_tuto 			= $this->db->real_escape_string($obj->getIdTuto());
		$titre_tuto 		= $this->db->real_escape_string($obj->getTitreTuto());
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());

		$req = "UPDATE tuto
			SET
			titre_tuto	= '$titre_tuto'

			WHERE chaine_id_chaine = $chaine_id_chaine
			AND id_tuto = $id_tuto
			";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateDepostTuto(Tuto $obj){
		$id_tuto 			= $this->db->real_escape_string($obj->getIdTuto());
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());

		$req = "UPDATE tuto
			SET
			post_tuto	= 0,
			date_post_tuto	= NULL

			WHERE chaine_id_chaine = $chaine_id_chaine
			AND id_tuto = $id_tuto
			";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updatePostTuto(Tuto $obj){
		$id_tuto 			= $this->db->real_escape_string($obj->getIdTuto());
		$post 				= $this->db->real_escape_string($obj->getPostTuto());
		$date_post 			= $this->db->real_escape_string($obj->getDatePostTuto());
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());

		$req = "UPDATE tuto
			SET
			post_tuto	= $post,
			date_post_tuto	= '$date_post'

			WHERE chaine_id_chaine = $chaine_id_chaine
			AND id_tuto = $id_tuto
			";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateVisuelTuto(Tuto $obj){
		$id_tuto 			= $this->db->real_escape_string($obj->getIdTuto());
		$visuel_tuto 		= $this->db->real_escape_string($obj->getVisuelTuto());
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());

		$req = "UPDATE tuto
			SET
			visuel_tuto	= '$visuel_tuto'

			WHERE chaine_id_chaine = $chaine_id_chaine
			AND id_tuto = $id_tuto
			";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateHtmlTuto(Tuto $obj){
		$id_tuto 			= $this->db->real_escape_string($obj->getIdTuto());
		$html_tuto 			= $this->db->real_escape_string($obj->getHtmlTuto());
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());

		$req = "UPDATE tuto
			SET
			html_tuto	= '$html_tuto'

			WHERE chaine_id_chaine = $chaine_id_chaine
			AND id_tuto = $id_tuto
			";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateDateModif(Tuto $obj){
		$id_tuto 			= $this->db->real_escape_string($obj->getIdTuto());
		$date_modif_tuto 	= $this->db->real_escape_string($obj->getDateModifTuto());
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());

		$req = "UPDATE tuto
			SET
			date_modif_tuto	= '$date_modif_tuto'

			WHERE chaine_id_chaine = $chaine_id_chaine
			AND id_tuto = $id_tuto
			";

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function selectTutosPostAndChaines($offset){
		$req = "SELECT 	
						tuto.id_tuto,
						tuto.titre_tuto,
						tuto.visuel_tuto,
						/*tuto.html_tuto,*/
						tuto.date_crea_tuto,
						tuto.date_modif_tuto,
						tuto.date_post_tuto,
						tuto.actif_tuto,
						tuto.post_tuto,
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
				FROM tuto 
			INNER JOIN chaine
				ON tuto.chaine_id_chaine = chaine.id_chaine
			WHERE tuto.actif_tuto = 1
			AND tuto.post_tuto = 1
			AND chaine.actif_chaine = 1
			GROUP BY tuto.id_tuto
			ORDER BY tuto.date_post_tuto DESC LIMIT 24 OFFSET $offset
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

	function allIdTuto(){
		$req = "SELECT id_tuto
				FROM tuto 
			WHERE actif_tuto = 1
			AND post_tuto = 1
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new tuto($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	function allTutoslByChaine($id_chaine){
		$req = "SELECT * FROM tuto
			WHERE chaine_id_chaine = $id_chaine
			AND actif_tuto = 1
			AND post_tuto = 1
			ORDER BY date_post_tuto DESC
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

	function allTutosByChaine($id_chaine){
		$req = "SELECT * FROM tuto
			WHERE chaine_id_chaine = $id_chaine
			ORDER BY date_post_tuto DESC
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

	function deleteTutosByChaine(Chaine $obj){
		$id_chaine = $obj->getIdChaine();
		$req = "DELETE FROM tuto WHERE chaine_id_chaine = $id_chaine";
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteTutoById($id){
		$id_tuto = $this->db->real_escape_string($id);
		$req = "DELETE FROM tuto WHERE id_tuto = $id_tuto";
		$query = $this->db->query($req);
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}


	
/*$id_tuto 			= $this->db->real_escape_string($obj->getIdTuto());
		$titre_tuto 		= $this->db->real_escape_string($obj->getTitreTuto());
		$visuel_tuto 		= $this->db->real_escape_string($obj->getVisuelTuto());	
		$html_tuto 			= $this->db->real_escape_string($obj->getHtmlTuto());	
		$date_crea_tuto 	= $obj->getDateCreaTuto();
		$date_modif_tuto 	= $obj->getDateModifTuto();	
		$date_post_tuto 	= $obj->getDatePostTuto();
		$actif_tuto 		= $obj->getActifTuto();	
		$post_tuto 			= $obj->getPostTuto();
		$chaine_id_chaine = $this->db->real_escape_string($obj->getChaineIdChaine());*/
}	
?>