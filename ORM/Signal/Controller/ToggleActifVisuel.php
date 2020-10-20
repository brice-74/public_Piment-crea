<?php
namespace ORM\Signal\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Visuel\Entity\Visuel;
use ORM\Visuel\Model\ManagerVisuel;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

class ToggleActifVisuel extends Controller {

	function getResult(){

		$connexion = new Connexion();
		$flash = new Flash();
		$managerVisuel = new ManagerVisuel($connexion);

		$http = new HTTPRequest();
		$id = $http->getDataGet('id');

		$visu = $managerVisuel->selectVisuel($id);

		if(!is_null($visu)){
			if($visu->getActifVisuel() == 1){
				$visu->setActifVisuel(0);
			}else{
				$visu->setActifVisuel(1);
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucun visuel trouvé","nogood timeout");
			header('Location: vue-admin');
			exit();
		}

		if($managerVisuel->updateActifVisuById($visu)){
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