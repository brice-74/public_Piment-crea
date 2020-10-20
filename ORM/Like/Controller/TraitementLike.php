<?php
namespace ORM\Like\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Like\Model\ManagerLike;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Visuel\Entity\Visuel;
use ORM\Like\Entity\Like;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use DateTime;

class TraitementLike extends Controller {

	function getResult(){
		$flash		= new Flash();
		$http 		= new HTTPRequest();
		$id_visu	= $http->getDataPost("likePost");

		$cx			= new Connexion();
		$manager_like 	= new ManagerLike($cx);
		$manager_visu 	= new ManagerVisuel($cx);

		$date 	= new DateTime();
		$date 	= $date->format('Y-m-d H:i:s');

		if(isset($_SESSION["auth"])){
			$id_user = $_SESSION["auth"]["id"];
			$visuel = $manager_visu->selectVisuelById($id_visu);

			if(!is_null($visuel)){
				$id_visu = $visuel->getIdVisuel();
				$like = $manager_like->likeExist($id_user,$id_visu);

				if(!is_null($like)){
					$post = $like->getPostLike();

					if($post == 1){
						$like->setPostLike(0);
						$like->setDateLike($date);

						if($manager_like->updatePost($like)){
							$like = $manager_like->countLikeVisuel($id_visu);
							$result['CountLike'] = $like->sommeLikes;
							$result['PostLike'] = 'removePost';
						}else{
							$flash->setFlash("Erreur#4 : Impossible de supprimer le like, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}else{
						$like->setPostLike(1);
						$like->setDateLike($date);

						if($manager_like->updatePost($like)){
							$like = $manager_like->countLikeVisuel($id_visu);
							$result['CountLike'] = $like->sommeLikes;
							$result['PostLike'] = 'addPost';
						}else{
							$flash->setFlash("Erreur#3 : Impossible de liker le visuel, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}
				}else{
					$obj = new Like([
						"date_like" => $date,
						"user_id_user" => $id_user,
						"visuel_id_visuel" => $id_visu
					]);

					if($manager_like->insertPostLike($obj)){
						$like = $manager_like->countLikeVisuel($id_visu);
						$result['CountLike'] = $like->sommeLikes;
						$result['PostLike'] = 'addPost';
					}else{
						$flash->setFlash("Erreur#2 : Impossible de liker le visuel, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}
			}else{
				$flash->setFlash("Erreur#1 : Impossible de liker le visuel, veuillez contacter le webmaster","nogood timeout");
				$result['flash'] = $flash->getFlash();
			}
		}else{
			$flash->setFlash("Créez un compte pour liker !","normal timeout");
			$result['flash'] = $flash->getFlash();
		}
		echo json_encode($result);
		$cx->close();
	}
}
?>