<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Tuto\Model\ManagerTuto;

use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use OCFram\HTTPRequest;


class TraitementOneImgTuto extends Controller {

	function getResult(){
		$result = [];
		$flash		= new Flash();
		$http 		= new HTTPRequest();

		$visuel	= $http->getDataFiles("oneImg");
		$id_tuto		= $http->getDataPost("id_tuto");

		$cx			= new Connexion();
		$manager_tuto 	= new ManagerTuto($cx);

		$tuto = $manager_tuto->selectTutoById($id_tuto);

		if(!is_null($tuto)){
			if(!is_null($visuel)){
				$destination = 'medias/chaine/id-'.$_SESSION["authChaine"]["id"].'/tuto-'.$id_tuto.'/';

				if(!is_dir($destination)){
					mkdir($destination, 0777,TRUE);
				}
				$uploader 	 = new Uploader($visuel,$destination);
				$one_img 	 = $uploader->upload();

				if(!is_null($one_img)){
					$uploader->imageSizing(2100);
					$result['img'] = $one_img;
					$result['id_tuto'] = $tuto->getIdTuto();
					$result['id_chaine'] = $_SESSION['authChaine']['id'];
				}else{
					$flash->setFlash("Erreur#1 : Impossible de changer l'image, veuillez contacter le webmaster","nogood timeout");
					$result['flash'] = $flash->getFlash();
				}
			}
		}else{
			$flash->setFlash("Erreur#2 : Impossible de changer l'image, veuillez contacter le webmaster","nogood timeout");
			$result['flash'] = $flash->getFlash();
		}
		$cx->close();
		echo json_encode($result);
	}
}
?>