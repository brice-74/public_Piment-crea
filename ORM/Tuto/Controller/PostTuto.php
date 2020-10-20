<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Language\Model\ManagerLanguage;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;
use Vendors\LandingPage\LandingPage;

use DateTime;



class PostTuto extends Controller{

	function getResult(){
		$flash = new Flash();
		$page = new LandingPage();

		/*$ua = $_SERVER['HTTP_USER_AGENT'];
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
		}*/

		$cx = new Connexion();
		$manager = new ManagerTuto($cx);

		$http = new HTTPRequest();
		$id_tuto = $http->getDataGet('id');

		$obj = $manager->selectTutoById($id_tuto);

		if(!is_null($obj)){

			if(is_null($obj->getTitreTuto())){
				$cx->close();
				$flash->setFlash("Le titre du tutoriel est obligatoire","normal timeout");
				header('Location: brouillons');
				exit();
			}
			if(is_null($obj->getVisuelTuto())){
				$cx->close();
				$flash->setFlash("Le visuel principal du tutoriel est obligatoire","normal timeout");
				header('Location: brouillons');
				exit();
			}

			$go = FALSE;

			$managerTheme = new ManagerTheme($cx);
			if(!is_null($managerTheme->SelectTutoHasTheme($obj->getIdTuto()))){
				$go = TRUE;
			}

			$managerLogiciel = new ManagerLogiciel($cx);
			if(!is_null($managerLogiciel->SelectTutoHasLogiciel($obj->getIdTuto()))){
				$go = TRUE;
			}

			$managerLanguage = new ManagerLanguage($cx);
			if(!is_null($managerLanguage->SelectTutoHasLanguage($obj->getIdTuto()))){
				$go = TRUE;
			}


			if($go == FALSE){
				$cx->close();
				$flash->setFlash("Sélèctionner au moin une catégorie parmis les thèmes, logiciels et languages","normal timeout");
				header('Location: brouillons');
				exit();

			}else{
				$date 		= new DateTime();
				$date_post 	= $date->format('Y-m-d H:i:s');
				$obj->setPostTuto(1);
				$obj->setDatePostTuto($date_post);

				if($manager->updatePostTuto($obj)){
					$cx->close();
					$flash->setFlash("Tutoriel posté avec succès","good timeout");
					header('Location: brouillons');
					exit();
				}else{
					$cx->close();
					$flash->setFlash("Erreur#2 : Un problème est survenu lors du post du tutoriel, veuillez contacter le webmaster","nogood timeout");
					header('Location: brouillons');
					exit();
				}
			}
			
		}else{
			$cx->close();
			$flash->setFlash("Erreur#1 : Un problème est survenu lors du post du tutoriel, veuillez contacter le webmaster","nogood timeout");
			header('Location: brouillons');
			exit();
		}
	}
}
?>

