<?php
namespace ORM\Proposition\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Proposition\Entity\Proposition;
use ORM\Proposition\Model\ManagerProposition;

use Vendors\Flash\Flash;


class TraitementRemoveProp extends Controller {

	function getResult(){
		$flash 		 = new Flash();
		$http 		 = new HTTPRequest();
		$connexion = new Connexion();
		$managerProp = new ManagerProposition($connexion);

		$id = $http->getDataPost('prop');
		$prop = $managerProp->selectPropById($id);

		if((!is_null($prop))&&($prop->getUserIdUser() == $_SESSION['auth']['id'])){

			if($managerProp->removeProp($prop->getIdProposition())){
				$result['go'] = 'go';
				unset($_SESSION['prop'][strval($prop->getIdProposition())]);
			}else{
				$flash->setFlash("Erreur#1 : Impossible de supprimer la proposition, veuillez contacter le webmaster","nogood timeout");
				$result['flash'] = $flash->getFlash();
			}
		}else{
			$flash->setFlash("Erreur#2 : Impossible de supprimer la proposition, veuillez contacter le webmaster","nogood timeout");
			$result['flash'] = $flash->getFlash();
		}
		echo json_encode($result);
		$connexion->close();
	
	}

}

?>