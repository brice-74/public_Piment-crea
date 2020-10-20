<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Tuto\Model\ManagerTuto;

use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use OCFram\HTTPRequest;


class TraitementHtmlTuto extends Controller {

	function getResult(){
		$result = [];
		$flash		= new Flash();
		$http 		= new HTTPRequest();

		$html		= $http->getDataPost("html",1);
		$id_tuto		= $http->getDataPost("id_tuto");

		$cx			= new Connexion();
		$manager_tuto 	= new ManagerTuto($cx);

		$tuto = $manager_tuto->selectTutoById($id_tuto);

		if(!is_null($tuto)){
			if(!is_null($html)){
				if($tuto->getHtmlTuto() != $html){
					$tuto->setHtmlTuto($html);
					if($manager_tuto->updateHtmlTuto($tuto)){
						$result['good'] = 'good';
					}else{
						$flash->setFlash("Erreur#html : Une erreur c'est produite, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}
			}
		}else{
			$flash->setFlash("Erreur : Impossible de modifier le tutoriel, veuillez contacter le webmaster","nogood timeout");
			$result['flash'] = $flash->getFlash();
		}
		$cx->close();
		echo json_encode($result);
	}
}
?>