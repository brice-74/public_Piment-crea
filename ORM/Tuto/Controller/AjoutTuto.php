<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use Vendors\LandingPage\LandingPage;
use Vendors\Flash\Flash;

use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;

use DateTime;



class AjoutTuto extends Controller{

	function getResult(){
		$page = new LandingPage();
		$flash = new Flash();

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

		$cx = new Connexion();
		$manager = new ManagerTuto($cx);

		$date 		= new DateTime();
		$date_crea 	= $date->format('Y-m-d H:i:s');

		$tuto = new Tuto(array(
			"date_crea_tuto" 	=> $date_crea,
			"chaine_id_chaine"=> $_SESSION["authChaine"]["id"]
		));

		$id_tuto = $manager->insertTuto($tuto);
		$cx->close();

		if($id_tuto > 0){
			header("Location: creation-tuto-".$id_tuto);
		}else{
			$flash->setFlash("Un problème est survenu lors de la création du tutoriel, veuillez contacter le webmaster","nogood timeout");

			if($page->existPage()){
				$erno = $page->getPage();
			}else{
				$erno = "index";
			}
			header("Location:".$erno);
			exit();
		}
	}
}
?>

