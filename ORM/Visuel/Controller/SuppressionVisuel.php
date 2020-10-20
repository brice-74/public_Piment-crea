<?php
namespace ORM\Visuel\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Theme\Entity\Theme;
use ORM\Visuel\Entity\Visuel;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Like\Model\ManagerLike;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Commentaire\Model\ManagerCommentaire;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;


class SuppressionVisuel extends Controller {
	function getResult(){


		$page 				= new LandingPage();
		$http 				= new HTTPRequest();
		$flash				= new Flash();
		$connexion			= new Connexion();
		$managerVisuel		= new ManagerVisuel($connexion);
		$managerTheme		= new ManagerTheme($connexion);
		$managerLogiciel	= new ManagerLogiciel($connexion);
		$managerLike		= new ManagerLike($connexion);
		$managerFavoris	= new ManagerFavoris($connexion);
		$managerCom			= new ManagerCommentaire($connexion);

		$id_visuel 	= $http->getDataGet("id");
		$visuel		= $managerVisuel->selectVisuelById($id_visuel);

		if(!is_null($visuel)){
			if($visuel->getChaineIdChaine() == $_SESSION["authChaine"]["id"]){
				$id_visuel = $visuel->getIdVisuel();
				$managerTheme->removeVisuelHasTheme($id_visuel);
				$managerLogiciel->removeVisuelHasLogiciel($id_visuel);
				$managerLike->deleteLikesVisuel($id_visuel);
				$managerFavoris->deleteFavorisVisuel($id_visuel);
				$managerCom->deleteCommentairesVisuel($id_visuel);

				if($managerVisuel->removeVisuelById($id_visuel)){
					$chemin = 'medias/chaine/id-'.$_SESSION["authChaine"]['id'].'/visuel/';
					unlink($chemin.$visuel->getVisuelVisuel());
					unlink($chemin.'min-'.$visuel->getVisuelVisuel());
					$flash->setFlash("Visuel supprimer avec succès.","good timeout");
				}else{
					$flash->setFlash("Erreur#2 : Impossible de supprimer le visuel, veuillez contacter le webmaster","nogood timeout");
				}
			}else{
				$flash->setFlash("Vous n'avez pas les droits d'éditions de se contenu","nogood timeout");
			}
		}else{
			$flash->setFlash("Erreur#1 : Impossible de supprimer le visuel, veuillez contacter le webmaster","nogood timeout");
		}

		if($page->existPage()){
			$attero = $page->getPage();
		}else{
			$attero = "index";
		}
		$connexion->close();
		header("Location: ".$attero);
		exit();
		return $val_retour;	
	}
}
?>