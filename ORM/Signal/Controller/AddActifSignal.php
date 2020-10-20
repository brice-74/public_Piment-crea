<?php
namespace ORM\Signal\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Signal\Entity\Signal;
use ORM\Signal\Model\ManagerSignal;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

class AddActifSignal extends Controller {

	function getResult(){

		$connexion = new Connexion();
		$flash = new Flash();
		$managerSignal = new ManagerSignal($connexion);

		$http = new HTTPRequest();
		$idSign = $http->getDataGet('id');

		$signal = $managerSignal->selectSignalById($idSign);

		if(!is_null($signal)){
			if($signal->getActifSignal() == 1){
				$signal->setActifSignal(0);
			}else{
				$signal->setActifSignal(1);
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucun Signalement trouvé","nogood timeout");
			header('Location: vue-admin');
			exit();
		}

		if($managerSignal->updateActifSignalById($signal)){
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