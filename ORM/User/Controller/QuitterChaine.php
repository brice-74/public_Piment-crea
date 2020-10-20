<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use ORM\User\Entity\User;

use Vendors\Flash\Flash;

class QuitterChaine extends Controller {

	function getResult(){
		$flash		= new Flash();
		$connexion	= new Connexion();
		$managerUser			= new ManagerUser($connexion);

		$user		= $managerUser->oneUserById($_SESSION["auth"]["id"]);

		if($managerUser->removeStatutChaineUser($user)){
			$flash->setFlash("Chaine quitté avec succès","good timeout");
			$_SESSION['auth']['statut'] = 1;
			unset($_SESSION["authChaine"]);
			$connexion->close();
			header("Location: profil");
			exit();
		}else{
			$flash->setFlash("Impossible de quitter la chaine, veuillez contacter le webmaster ou renouveler ultérieurement votre action.","good timeout");
			$connexion->close();
			header("Location: profil");
			exit();
		}
	}
}
?>