<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\User\Model\ManagerUser;
use ORM\User\Entity\User;
use ORM\Language\Model\ManagerLanguage;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;
use ORM\Proposition\Model\ManagerProposition;
use ORM\Proposition\Entity\Proposition;

use Vendors\FormBuilded\FormOneImageTuto;
use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormTitreTuto;
use Vendors\FormBuilded\FormImageTuto;
use Vendors\FormBuilded\FormCatTuto;
use Vendors\FormBuilded\FormProposition;

use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;

use DateTime;

class BuilderTuto extends Controller{

	function getResult(){
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

		$this->setLayout("front");
		$this->setTitle("Edition d'un tutoriel");
		$this->setDescription("Edition d'un tutoriel");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Tuto/View/builderTuto.php",
		]);

		$cx 				= new Connexion();
		$managerUser 	= new ManagerUser($cx);
		$managerTuto 	= new ManagerTuto($cx);
		$managerProp 	= new ManagerProposition($cx);
		$http 			= new HTTPRequest();
		$id_tuto = $http->getDataGet("id");

		$tuto = $managerTuto->selectTutoById($id_tuto);

		if(!is_null($tuto)){
			$val_retour["tuto"] = $tuto;
			$members = $managerUser->selectUsersByChaine($tuto->getChaineIdChaine());
			$go = false;
			foreach ($members as $member) {
				if($member->getIdUser() == $_SESSION['auth']['id']){
					$go = true;
				}
			}
			if($go){
				$props = $managerProp->selectPropsByTuto($tuto->getIdTuto());
				if(!is_null($props)){
					$val_retour["props"] = $props;
				}
			}else{
				$flash->setFlash("Accès interdit","nogood timeout");
				if($page->existPage()){
					$erno = $page->getPage();
				}else{
					$erno = "index";
				}
				$cx->close();
				header("Location:".$erno);
				exit();
			}
			
		}else{
			$flash->setFlash("Un problème est survenu lors de la création du tutoriel, veuillez contacter le webmaster","nogood timeout");
			if($page->existPage()){
				$erno = $page->getPage();
			}else{
				$erno = "index";
			}
			$cx->close();
			header("Location:".$erno);
			exit();
		}


		$controller = new Controller();
		$form	= [
			new FormSearch('get', null, DOMAINE."search"), 
			new FormTitreTuto("post",$tuto), 
			new FormImageTuto(), 
			new FormCatTuto(),
			new FormOneImageTuto(),
			new FormProposition('post', null, DOMAINE."traitement-prop-".$tuto->getIdTuto())
		];
		$controller->getSearch($form[0]);

		$managerTheme = new ManagerTheme($cx);
		$managerLogiciel = new ManagerLogiciel($cx);
		$managerLanguage = new ManagerLanguage($cx);

		$languages = $managerLanguage->selectLanguage();
		$logiciels = $managerLogiciel->selectLogiciels();
		$themes = $managerTheme->selectThemes();

		$build[] = $form[0]->buildForm();
		$build[] = $form[1]->buildForm();
		$build[] = $form[2]->buildForm($tuto);
		$build[] = $form[3]->buildForm($themes,$logiciels,$languages,$tuto->getIdTuto());
		$build[] = $form[4]->buildForm();
		$build[] = $form[5]->buildForm();

		$val_retour["form"] = $build;

		$cx->close();
		return $val_retour;
	}
}
?>

