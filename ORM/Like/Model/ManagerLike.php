<?php
namespace ORM\Like\Model;
use OCFram\Manager;
use ORM\Like\Entity\Like;

/*
id_like
post_like
date_like
user_id_user
visuel_id_visuel
*/

class ManagerLike extends Manager {

	function deleteLikesUser($id){
		$req = "DELETE FROM `like` 
		WHERE user_id_user = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function deleteLikesVisuel($id){
		$req = "DELETE FROM `like` 
		WHERE visuel_id_visuel = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows > 0)?TRUE:FALSE;
	}

	function countLikeVisuel($id_visu){
		$req = " SELECT 
			`like`.visuel_id_visuel,
			SUM(`like`.post_like) AS sommeLikes     
			FROM `like`
            INNER JOIN visuel ON visuel.id_visuel = `like`.visuel_id_visuel
			WHERE `like`.visuel_id_visuel = $id_visu
			GROUP BY visuel.id_visuel
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Like($query->fetch_array()):NULL;
	}

	function countLikesUser($id_user){
		$req = " SELECT 
			SUM(post_like) AS countLikes
			FROM `like`
			WHERE user_id_user = $id_user
		";
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Like($query->fetch_array()):NULL;
	}

	function insertPostLike($obj){
		$date 	 = $obj->getDateLike();
		$id_user = $obj->getUserIdUser();
		$id_visu = $obj->getVisuelIdVisuel();
		$req = "
			INSERT INTO `like`
			VALUES(
			NULL,
			1,
			'$date',
			$id_user,
			$id_visu
			)
		";	
		$query = $this->db->query($req);
		return $this->db->insert_id;
	}

	function likeExist($id_user,$id_visu){
		$req = "
			SELECT * FROM `like`
			WHERE user_id_user = $id_user
			AND visuel_id_visuel = $id_visu
		";	
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Like($query->fetch_array()):NULL;
	}

	function likePostExist($id_user,$id_visu){
		$req = "
			SELECT * FROM `like`
			WHERE user_id_user = $id_user
			AND visuel_id_visuel = $id_visu
			AND post_like = 1
		";	
		$query = $this->db->query($req);
		return ($query->num_rows > 0)?new Like($query->fetch_array()):NULL;
	}

	function updatePost(Like $like){
		$post_like 			= $like->getPostLike();
		$date_like 			= $like->getDateLike();
		$user_id_user 		= $like->getUserIdUser();
		$visuel_id_visuel 	= $like->getVisuelIdVisuel();

		$req = "UPDATE `like` 
			SET post_like = '$post_like',
				date_like = '$date_like'
			WHERE user_id_user = $user_id_user
			AND visuel_id_visuel = $visuel_id_visuel
			";


		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	

}
?>