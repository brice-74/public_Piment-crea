<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;
use ORM\Chaine\Entity\Chaine;
use ORM\Chaine\Model\ManagerChaine;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;


class TraitementSearch extends Controller {

	function getResult(){
		$result = [];
		$flash		= new Flash();
		$http 		= new HTTPRequest();

		$search		= $http->getDataPost("value");

		$cx			= new Connexion();
		$manager_tuto 		= new ManagerTuto($cx);
		$manager_chaine 	= new ManagerChaine($cx);

		$chaines = $manager_chaine->selectChaineByName($search);
		$tutos = $manager_tuto->selectTutoByTitle($search);

		if((!is_null($tutos)) || (!is_null($chaines))){
			if(!is_null($tutos)){
				foreach ($tutos as $tuto) {
					$result['tutos'][] = $tuto->getTitreTuto();
				}
			}
			if(!is_null($chaines)){
				foreach ($chaines as $chaine) {
					$result['chaines'][] = $chaine->getNomChaine();
				}
			}
		}else{
			$result['no'] = 'Aucun résultat';
		}
		
		$cx->close();
		echo json_encode($result);
	}
}
?>