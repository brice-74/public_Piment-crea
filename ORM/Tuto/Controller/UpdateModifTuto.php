<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;

use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;

use Vendors\LandingPage\LandingPage;

use DateTime;

class UpdateModifTuto extends Controller{

	function getResult(){
		
		$page = new LandingPage();
		$flash = new Flash();
		$page = new LandingPage();

		$ua = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/iphone|android|blackberry|symb|ipad|ipod|phone/i',$ua)){
			$flash->setFlash("Fonctionnalité inaccessible sur téléphone et tablette","normal timeout");
			$page = new LandingPage();
			if($page->existPage()){
				$erno = $page->getPage();
			}else{
				$erno = "index";
			}
			header("Location:".$erno);
			exit();
		}

		$cx 				= new Connexion();
		$managerTuto 	= new ManagerTuto($cx);
		$http 			= new HTTPRequest();
		$id_tuto = $http->getDataGet("id");

		$tuto = $managerTuto->selectTutoById($id_tuto);
		$date 		= new DateTime();
		$date_modif 	= $date->format('Y-m-d H:i:s');

		if(!is_null($tuto)){
			$tuto->setDateModifTuto($date_modif);
			$managerTuto->updateDateModif($tuto);
			$cx->close();
			header("Location: modifier-tuto-".$tuto->getIdTuto());
			exit();
		}else{
			$flash->setFlash("Impossible de modifier le tuto, veuillez contacter le webmaster","nogood timeout");
			if($page->existPage()){
				$erno = $page->getPage();
			}else{
				$erno = "index";
			}
			$cx->close();
			header("Location:".$erno);
			exit();
		}
		
		
	}
}
?>

