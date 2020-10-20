<?php
namespace ORM\Signal\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Entity\Chaine;
use ORM\Chaine\Model\ManagerChaine;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

class ToggleActifChaine extends Controller {

	function getResult(){

		$connexion = new Connexion();
		$flash = new Flash();
		$managerChaine = new ManagerChaine($connexion);

		$http = new HTTPRequest();
		$id = $http->getDataGet('id');

		$chaine = $managerChaine->selectChaine($id);

		if(!is_null($chaine)){
			if($chaine->getActifChaine() == 1){
				$chaine->setActifChaine(0);
			}else{
				$chaine->setActifChaine(1);
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucune Chaine trouvé","nogood timeout");
			header('Location: vue-admin');
			exit();
		}

		if($managerChaine->updateActifChaineById($chaine)){
			$connexion->close();
			$flash->setFlash("Update réalisé avec succès","good timeout");
			header('Location: vue-admin');
			exit();
		}else{
			$connexion->close();
			$flash->setFlash("Erreur lors de l'update","nogood timeout");
			header('Location: vue-admin');
			exit();
		}

		$connexion->close();
		return $val_retour;
	}

}


?>