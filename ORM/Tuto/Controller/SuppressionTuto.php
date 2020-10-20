<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Theme\Entity\Theme;
use ORM\Tuto\Entity\Tuto;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Language\Model\ManagerLanguage;
use ORM\Note\Model\ManagerNote;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Commentaire\Model\ManagerCommentaire;

use Vendors\FormBuilded\FormSearch;
use Vendors\File\DeleteFile;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;


class SuppressionTuto extends Controller {
	function getResult(){

		$deleteFile 		= new DeleteFile();
		$page 				= new LandingPage();
		$http 				= new HTTPRequest();
		$deleteFile 		= new DeleteFile();
		$flash				= new Flash();
		$connexion			= new Connexion();
		$managerTuto		= new ManagerTuto($connexion);
		$managerTheme		= new ManagerTheme($connexion);
		$managerLogiciel	= new ManagerLogiciel($connexion);
		$managerLanguage	= new ManagerLanguage($connexion);
		$managerNote		= new ManagerNote($connexion);
		$managerFavoris	= new ManagerFavoris($connexion);
		$managerCom			= new ManagerCommentaire($connexion);

		$id_tuto 	= $http->getDataGet("id");
		$tuto			= $managerTuto->selectNoPostTutoById($id_tuto);

		if(!is_null($tuto)){
			if($tuto->getChaineIdChaine() == $_SESSION['authChaine']['id']){
				$managerCom->deleteCommentairesTuto($tuto->getIdTuto());
				$managerTheme->removeTutosHasTheme($tuto->getIdTuto());
				$managerLogiciel->removeTutosHasLogiciel($tuto->getIdTuto());
				$managerLanguage->removeTutosHasLanguage($tuto->getIdTuto());
				$managerFavoris->deleteFavorisTuto($tuto->getIdTuto());
				$managerNote->deleteNotesTuto($tuto->getIdTuto());

				if($managerTuto->deleteTutoById($tuto->getIdTuto())){
					$chemin = 'medias/chaine/id-'.$_SESSION["authChaine"]['id'].'/tuto-'.$tuto->getIdTuto();
					$deleteFile->deleteDirFiles($chemin);
					$flash->setFlash("Brouillon supprimer avec succès.","good timeout");
				}else{
					$flash->setFlash("Erreur#2 : Impossible de supprimer le tutoriel, veuillez contacter le webmaster","nogood timeout");
				}
			}else{
				$flash->setFlash("Vous n'avez pas les droits d'édition sur se contenu","nogood timeout");
			}
			
		}else{
			$flash->setFlash("Erreur#1 : Impossible de supprimer le tutoriel, veuillez contacter le webmaster","nogood timeout");
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