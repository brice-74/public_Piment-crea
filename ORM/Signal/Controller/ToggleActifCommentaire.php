<?php
namespace ORM\Signal\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Commentaire\Entity\Commentaire;
use ORM\Commentaire\Model\ManagerCommentaire;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

class ToggleActifCommentaire extends Controller {

	function getResult(){

		$connexion = new Connexion();
		$flash = new Flash();
		$managerCommentaire = new ManagerCommentaire($connexion);

		$http = new HTTPRequest();
		$id = $http->getDataGet('id');

		$com = $managerCommentaire->selectCom($id);

		if(!is_null($com)){
			if($com->getActifCommentaire() == 1){
				$com->setActifCommentaire(0);
			}else{
				$com->setActifCommentaire(1);
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucun Commentaire trouvé","nogood timeout");
			header('Location: vue-admin');
			exit();
		}

		if($managerCommentaire->updateActifComById($com)){
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