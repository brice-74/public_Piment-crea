<?php
namespace ORM\Commentaire\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Visuel\Entity\Visuel;
use ORM\Commentaire\Entity\Commentaire;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use DateTime;

class TraitementCommentaire extends Controller {

	function getResult(){
		$flash		= new Flash();
		$http 		= new HTTPRequest();
		$contenu		= $http->getDataPost("contenu",1);
		$id_visu		= $http->getDataPost("visuel");
		$id_commentaire		= $http->getDataPost("id_com");

		$cx			= new Connexion();
		$manager_com 	= new ManagerCommentaire($cx);
		$managerVisu 	= new ManagerVisuel($cx);

		if(!is_null($id_commentaire)){
			if(isset($_SESSION['auth'])){
				$comment = $manager_com->selectComByIdAndUser($id_commentaire,$_SESSION['auth']['id']);
				if(!is_null($comment)){
					if($manager_com->removeCom($comment->getIdCommentaire())){
						$result['count_com'] = $manager_com->countComByVisu($comment->getVisuelIdVisuel());
						$result['RemoveCom'] = "commentaire-".$comment->getIdCommentaire();
					}else{
						$flash->setFlash("Erreur#3 : Impossible de suprimer le commentaire, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}else{
					$flash->setFlash("Erreur#2 : Impossible de suprimer le commentaire, veuillez contacter le webmaster","nogood timeout");
					$result['flash'] = $flash->getFlash();
				}
			}else{
				$flash->setFlash("Erreur#1 : Impossible de suprimer le commentaire, veuillez contacter le webmaster","nogood timeout");
				$result['flash'] = $flash->getFlash();
			}
		}

		$date 	= new DateTime();
		$date 	= $date->format('Y-m-d H:i:s');
		$visu = $managerVisu->selectVisuelById($id_visu);

		if(!is_null($visu)){
			if(!is_null($contenu)){
				if(!empty($contenu)){
					if(isset($_SESSION['auth'])){
						$com = new Commentaire(array(
							"new_post_commentaire" 	=> 1,
							"contenu_commentaire" 	=> $contenu,
							"date_commentaire" 		=> $date,
							"visuel_id_visuel" 		=> $visu->getIdVisuel(),
							"user_id_user"				=> $_SESSION['auth']['id'],
						));

						if(isset($_SESSION['authChaine'])){
							if($visu->getChaineIdChaine() == $_SESSION['authChaine']['id']){
								$com->setNewPostCommentaire(0);
							}
						}
						$id_com = $manager_com->insertCommentaireVisu($com);
						if(!is_null($id_com)){
							$commentaire = $manager_com->selectComAndUserByIdCom($id_com);
							if(is_null($commentaire['avatar_user'])){
								$commentaire['avatar_user'] = 'templates/front/img/piment.jpg';
							}else{
								$commentaire['avatar_user'] = "medias/user/id-".$_SESSION['auth']['id']."/avatars/".$_SESSION['auth']['avatar'];
							}
							$result['count_com'] = $manager_com->countComByVisu($commentaire['visuel_id_visuel']);
							$result['commentaire'] = $commentaire;
						}else{
							$flash->setFlash("Impossible de laisser un commentaire, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}else{
						$flash->setFlash("Vous devez créer un compte pour laisser un commentaire","normal timeout");
						$result['flash'] = $flash->getFlash();
					}
				}else{
					$flash->setFlash("Votre commentaire est vide","normal timeout");
					$result['flash'] = $flash->getFlash();
				}
			}
		}
		
		
		
		echo json_encode($result);
		$cx->close();
	}
}
?>