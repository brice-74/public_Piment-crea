<?php
namespace ORM\Proposition\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Proposition\Entity\Proposition;
use ORM\Proposition\Model\ManagerProposition;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

class AddActifProp extends Controller {

	function getResult(){

		$connexion = new Connexion();
		$flash = new Flash();
		$managerProposition = new ManagerProposition($connexion);

		$http = new HTTPRequest();
		$id = $http->getDataGet('id');

		$prop = $managerProposition->selectProp($id);

		if(!is_null($prop)){
			if($prop->getActifPropostion() == 1){
				$prop->setActifPropostion(0);
			}else{
				$prop->setActifPropostion(1);
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucun Signalement trouvé","nogood timeout");
			header('Location: vue-admin');
			exit();
		}

		if($managerProposition->updateActifPropById($prop)){
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