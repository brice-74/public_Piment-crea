<?php
namespace ORM\Proposition\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Proposition\Entity\Proposition;
use ORM\Proposition\Model\ManagerProposition;

use Vendors\Flash\Flash;

use DateTime;


class TraitementFormProp extends Controller {

	function getResult(){
		$flash 		 = new Flash();
		$http 		 = new HTTPRequest();
		$date 		= new DateTime();
		$connexion = new Connexion();
		$managerProp = new ManagerProposition($connexion);

		if(empty($http->getDataPost('titre_proposition'))){
			$flash->setFlash("Vous n'avez rien renseigné","normal timeout");
			header('Location: poster-visuel');
			exit();
		}

		$date 	= $date->format('Y-m-d H:i:s');
		$prop = new Proposition([
			"categorie_proposition" => 'NULL',
			"titre_proposition" => $http->getDataPost('titre_proposition'),
			"actif_proposition" => 1,
			"date_proposition" => $date,
			"user_id_user" => $_SESSION['auth']['id'],
			"visuel_id_visuel" => 'NULL',
			"tuto_id_tuto" => 'NULL'
		]);

		$id = $managerProp->insertProp($prop);
		if($id){
			$_SESSION["propVisu"][] = $id;
			$flash->setFlash("Catégorie envoyé avec succès","good timeout");
			header('Location: poster-visuel');
			exit();
		}else{
			$flash->setFlash("Impossible de proposer une catégorie, veuillez contacter le webmaster","nogood timeout");
			header('Location: poster-visuel');
			exit();
		}

		
	
	}

}

?>