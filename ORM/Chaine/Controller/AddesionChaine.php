<?php
namespace ORM\Chaine\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Chaine\Entity\Chaine;
use ORM\User\Entity\User;
use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormConnexion;


use Vendors\Flash\Flash;


class AddesionChaine extends Controller {

	function getResult(){

		$http 	= new HTTPRequest();
		$token 	= $http->getDataGet("id");

		$connexion 	= new Connexion();
		$manager 	= new ManagerUser($connexion);
		$managerChaine 	= new ManagerChaine($connexion);
		$flash 		= new Flash();

		$user = $manager->oneUserByTokenChaineValid($token);

		if(!is_null($user)){
			$idChaine = preg_replace('/^[0-9]+--/', '', $token);
			$chaine = $managerChaine->selectChaineById($idChaine);
			if(!is_null($chaine)){
				$user->setStatutUser(2);
				$user->setChaineIdChaine($idChaine);

				if($manager->updateAddesionUser($user)){
					$_SESSION["authChaine"]["visuel"] 		= $chaine->getVisuelChaine();
					$_SESSION["authChaine"]["avatar"] 		= $chaine->getAvatarChaine();
					$_SESSION["authChaine"]["id"] 			= $chaine->getIdChaine();
					$_SESSION["authChaine"]["nom"] 			= $chaine->getNomChaine();
					$_SESSION["authChaine"]["description"] = $chaine->getDescriptionChaine();
					$_SESSION["authChaine"]["lien_in"]		= $chaine->getLienInChaine();
					$_SESSION["authChaine"]["lien_fb"] 		= $chaine->getLienFbChaine();
					$_SESSION["authChaine"]["lien_insta"] 	= $chaine->getLienInstaChaine();
					$_SESSION["authChaine"]["lien_ytb"] 	= $chaine->getLienYtbChaine();
					$_SESSION["authChaine"]["lien_tw"] 		= $chaine->getLienTwChaine();
					$_SESSION["auth"]["statut"] 			= 2;

					$connexion->close();
					$flash->setFlash("Bienvenu sur la chaine ".$chaine->getNomChaine(),"good timeout");
					header("Location: vue-chaine/".$chaine->getNomChaine());
					exit();
				}else{
					$connexion->close();
					$flash->setFlash("Erreur#2 : Addésion impossible, veuillez contacter le webmaster.","nogood timeout");
					header("Location: index");
					exit();
				}
			}else{
				$connexion->close();
				$flash->setFlash("Erreur#1 : Addésion impossible, veuillez contacter le webmaster.","nogood timeout");
				header("Location: index");
				exit();
			}
		}else{
			$connexion->close();
			$flash->setFlash("Vous avez dépasser le délai de 15 minutes, pour des raisons de sécurité, veuillez demander un nouveau mail d'addésion.","normal");
			header("Location: index");
			exit();
		}

		$connexion->close();

		return $val_retour;
	}

}
?>