<?php
namespace ORM\Proposition\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Proposition\Entity\Proposition;
use ORM\Proposition\Model\ManagerProposition;
use ORM\Tuto\Entity\Tuto;
use ORM\Tuto\Model\ManagerTuto;
use Vendors\LandingPage\LandingPage;


use Vendors\Flash\Flash;

use DateTime;


class TraitementFormPropTuto extends Controller {

	function getResult(){
		$flash 		 = new Flash();
		$http 		 = new HTTPRequest();
		$date 		= new DateTime();
		$connexion = new Connexion();
		$managerProp = new ManagerProposition($connexion);
		$managerTuto = new ManagerTuto($connexion);
		$id = $http->getDataGet('id');
		$tuto = $managerTuto->selectTutoById($id);

		if(!is_null($tuto)){
			if(empty($http->getDataPost('titre_proposition'))){
				$flash->setFlash("Vous n'avez rien renseigné","normal timeout");
				header('Location: creation-tuto-'.$tuto->getIdTuto());
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
				"tuto_id_tuto" => $tuto->getIdTuto()
			]);

			$id = $managerProp->insertProp($prop);
			if($id){
				$_SESSION["propVisu"][] = $id;
				$flash->setFlash("Catégorie envoyé avec succès","good timeout");
				header('Location: creation-tuto-'.$tuto->getIdTuto());
				exit();
			}else{
				$flash->setFlash("Erreur#1 : Impossible de proposer une catégorie, veuillez contacter le webmaster","nogood timeout");
				header('Location: creation-tuto-'.$tuto->getIdTuto());
				exit();
			}
		}else{
			$flash->setFlash("Erreur#2 : Impossible de proposer une catégorie, veuillez contacter le webmaster","nogood timeout");
			header('Location: index');
			exit();
		}	
	
	}

}

?>