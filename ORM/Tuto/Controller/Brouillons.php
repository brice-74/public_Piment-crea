<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Language\Model\ManagerLanguage;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;

use Vendors\FormBuilded\FormSearch;

use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;

class Brouillons extends Controller{

	function getResult(){
		$flash 			= new Flash();
		$page 		= new LandingPage();

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
		$this->setLayout("front");
		$this->setTitle("Tutoriaux non postés");
		$this->setDescription("Tutoriaux non postés");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Tuto/View/brouillons.php",
		]);

		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller = new Controller();
		$controller->getSearch($form[0]);
		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}
		$val_retour["form"] = $build;

		$cx 				= new Connexion();
		$managerTuto 	= new ManagerTuto($cx);
		$http 			= new HTTPRequest();

		$tutos = $managerTuto->selectNoPostTutos($_SESSION['authChaine']['id']);
		if(!is_null($tutos)){
			$val_retour["tutos"] = $tutos;
		}else{
			$val_retour["tutos"] = "Aucun tuto non posté sur cette chaine";
		}


		

		return $val_retour;
	}
}
?>

