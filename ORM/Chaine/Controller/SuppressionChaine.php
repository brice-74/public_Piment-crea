<?php 
namespace ORM\Chaine\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Visuel\Entity\Visuel;
use ORM\Tuto\Entity\Tuto;

use ORM\Chaine\Model\ManagerChaine;
use ORM\User\Model\ManagerUser;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Theme\Model\ManagerTheme;
use ORM\Language\Model\ManagerLanguage;
use ORM\Signal\Model\ManagerSignal;
use ORM\Signal\Entity\Signal;

use ORM\Like\Model\ManagerLike;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Note\Model\ManagerNote;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\File\DeleteFile;

class SuppressionChaine extends Controller {
	function getResult(){

		$flash				= new Flash();
		$connexion			= new Connexion();

		$managerTheme		= new ManagerTheme($connexion);
		$managerLogiciel	= new ManagerLogiciel($connexion);
		$managerLanguage	= new ManagerLanguage($connexion);
		$managerVisuel		= new ManagerVisuel($connexion);
		$managerTuto		= new ManagerTuto($connexion);
		$managerChaine		= new ManagerChaine($connexion);
		$managerUser		= new ManagerUser($connexion);

		$managerSign		= new ManagerSignal($connexion);
		$managerLike			= new ManagerLike($connexion);
		$managerCommentaire	= new ManagerCommentaire($connexion);
		$managerFavoris		= new ManagerFavoris($connexion);
		$managerAbonnement	= new ManagerAbonnement($connexion);
		$managerNote			= new ManagerNote($connexion);

		$chaine		= $managerChaine->selectChaineById($_SESSION["authChaine"]["id"]);
		$user		= $managerUser->oneUserById($_SESSION["auth"]["id"]);

		$members = $managerUser->selectUsersByChaine($chaine->getIdChaine());
		$member = 0;
		$go = false;
		foreach ($members as $m) {
			$member++;
			if($m->getIdUser() == $_SESSION['auth']['id']){
				$go = true;
			}
		}

		if($go == false){
			$flash->setFlash("Accès interdit","normal timeout");
			$connexion->close();
			header("Location: index");
			exit();
		}

		if($member > 1){
			$flash->setFlash("Impossible de supprimer la chaine, vous êtes encore $member membres sur la chaine.","normal timeout");
			$connexion->close();
			header("Location: vue-chaine/".$chaine->getNomChaine());
			exit();
		}

		$managerAbonnement->deleteAbonnementsChaine($chaine->getIdChaine());

		$visuels = $managerVisuel->allVisuelByChaine($chaine->getIdChaine());
		if(!is_null($visuels)){
			foreach ($visuels as $visuel) {
				$managerCommentaire->deleteCommentairesVisuel($visuel->getIdVisuel());
				$managerTheme->removeVisuelHasTheme($visuel->getIdVisuel());
				$managerLogiciel->removeVisuelHasLogiciel($visuel->getIdVisuel());
				$managerFavoris->deleteFavorisVisuel($visuel->getIdVisuel());
				$managerLike->deleteLikesVisuel($visuel->getIdVisuel());
			}
			if($managerVisuel->deleteVisuelsByChaine($chaine) == false){
				$flash->setFlash("Erreur#2 : Problème lors de la suppression, 
					veuillez contacter le webmaster ou renouveler ultérieurement.","nogood timeout");
				$connexion->close();
				header("Location: vue-chaine/".$chaine->getNomChaine());
				exit();
			}
		}
		$tutos = $managerTuto->allTutosByChaine($chaine->getIdChaine());
		if(!is_null($tutos)){
			foreach ($tutos as $tuto) {
				$managerCommentaire->deleteCommentairesTuto($tuto->getIdTuto());
				$managerTheme->removeTutosHasTheme($tuto->getIdTuto());
				$managerLogiciel->removeTutosHasLogiciel($tuto->getIdTuto());
				$managerLanguage->removeTutosHasLanguage($tuto->getIdTuto());
				$managerFavoris->deleteFavorisTuto($tuto->getIdTuto());
				$managerNote->deleteNotesTuto($tuto->getIdTuto());
			}
			if($managerTuto->deleteTutosByChaine($chaine) == false){
				$flash->setFlash("Erreur#4 : Problème lors de la suppression, 
					veuillez contacter le webmaster ou renouveler ultérieurement.","nogood timeout");
				$connexion->close();
				header("Location: vue-chaine/".$chaine->getNomChaine());
				exit();
			}
		}

		$signals = $managerSign->allSigalsChaine($chaine->getIdChaine());
		if(!is_null($signals)){
			if($managerSign->deleteSignalsByChaine($chaine) == false){
				$flash->setFlash("Erreur#5 : Problème lors de la suppression, 
					veuillez contacter le webmaster ou renouveler ultérieurement.","nogood timeout");
				$connexion->close();
				header("Location: vue-chaine/".$chaine->getNomChaine());
				exit();
			}
		}

		if($managerUser->removeStatutChaineUser($user)){
			$_SESSION["auth"]["statut"] = 1;
			unset($_SESSION["authChaine"]);

			if($managerChaine->deleteChaine($chaine)){
				$deleteFile = new DeleteFile();
				$chemin = 'medias/chaine/id-'.$chaine->getIdChaine();
				$deleteFile->deleteDirFiles($chemin);

				$flash->setFlash("Chaine définitivement supprimé","good timeout");
			}else{
				$flash->setFlash("Erreur#3 : Problème lors de la suppression, 
				veuillez contacter le webmaster ou renouveler ultérieurement.","nogood timeout");
			}
		}else{
			$flash->setFlash("Erreur#1 : Problème lors de la suppression, 
				veuillez contacter le webmaster ou renouveler ultérieurement.","nogood timeout");
		}
		$connexion->close();
		header("Location: profil");
		exit();
	}
}
?>