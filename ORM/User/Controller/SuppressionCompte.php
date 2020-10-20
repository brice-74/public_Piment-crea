<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use ORM\Like\Model\ManagerLike;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Note\Model\ManagerNote;
use ORM\Signal\Model\ManagerSignal;

use Vendors\Flash\Flash;
use Vendors\File\DeleteFile;

class SuppressionCompte extends Controller {
	function getResult(){
		$flash		= new Flash();
		$connexion	= new Connexion();
		$managerUser			= new ManagerUser($connexion);
		$managerLike			= new ManagerLike($connexion);
		$managerCommentaire	= new ManagerCommentaire($connexion);
		$managerFavoris		= new ManagerFavoris($connexion);
		$managerAbonnement	= new ManagerAbonnement($connexion);
		$managerNote			= new ManagerNote($connexion);
		$managerSignal			= new ManagerSignal($connexion);

		$user		= $managerUser->oneUserById($_SESSION["auth"]["id"]);

		$managerFavoris->deleteFavorisUser($user->getIdUser());
		$managerLike->deleteLikesUser($user->getIdUser());
		$managerCommentaire->deleteCommentairesUser($user->getIdUser());
		$managerAbonnement->deleteAbonnementsUser($user->getIdUser());
		$managerNote->deleteNotesUser($user->getIdUser());
		$managerSignal->deleteSignalsUser($user->getIdUser());


		if($managerUser->deleteUser($user)){
			$deleteFile = new DeleteFile();
			$chemin = 'medias/user/id-'.$user->getIdUser();
			$deleteFile->deleteDirFiles($chemin);

			$flash->setFlash("Compte définitivement supprimé","good timeout");
			unset($_SESSION["auth"]);
			if(isset($_SESSION["authChaine"])){ unset($_SESSION["authChaine"]);}
			$connexion->close();
			header("Location: connexion");
			exit();
		}else{
			$flash->setFlash("Problème lors de la suppression, 
				veuillez contacter le webmaster ou renouveler ultérieurement.","nogood timeout");
			$connexion->close();
			header("Location: profil");
			exit();
		}
	}
}
?>