<?php
namespace ORM\Signal\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Tuto\Entity\Tuto;
use ORM\Tuto\Model\ManagerTuto;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

class ToggleActifTuto extends Controller {

	function getResult(){

		$connexion = new Connexion();
		$flash = new Flash();
		$managerTuto = new ManagerTuto($connexion);

		$http = new HTTPRequest();
		$id = $http->getDataGet('id');

		$tuto = $managerTuto->selectTuto($id);

		if(!is_null($tuto)){
			if($tuto->getActifTuto() == 1){
				$tuto->setActifTuto(0);
			}else{
				$tuto->setActifTuto(1);
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucun tuto trouvé","nogood timeout");
			header('Location: vue-admin');
			exit();
		}

		if($managerTuto->updateActifTutoById($tuto)){
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