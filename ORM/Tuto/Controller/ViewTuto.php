<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Theme\Model\ManagerTheme;
use ORM\Language\Model\ManagerLanguage;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Note\Model\ManagerNote;

use ORM\Favoris\Entity\Favoris;
use ORM\Note\Entity\Note;
use ORM\Tuto\Entity\Tuto;
use ORM\Chaine\Entity\Chaine;
use ORM\Logiciel\Entity\Logiciel;
use ORM\Theme\Entity\Theme;
use ORM\Language\Entity\Language;
use ORM\Commentaire\Entity\Commentaire;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;



class ViewTuto extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("tutoriel");
		$this->setDescription("tutoriel");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Tuto/View/viewTuto.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;
		
		$cx		= new Connexion();
		$managerCom 	= new ManagerCommentaire($cx);
		$managerLanguage 	= new ManagerLanguage($cx);
		$managerLogiciel 	= new ManagerLogiciel($cx);
		$managerTheme 	= new ManagerTheme($cx);
		$managerTuto	= new ManagerTuto($cx);
		$managerFavoris= new ManagerFavoris($cx);
		$managerChaine	= new ManagerChaine($cx);
		$manager_note 	= new ManagerNote($cx);
		$http 			= new HTTPRequest();
		$tuto = $managerTuto->selectTutoPostById($http->getDataGet("id"));
		$titleTuto = $http->getDataGet("title");

		$go = false;
		if(!is_null($tuto)){
			if($titleTuto == $tuto->getTitreTuto()){
				$go = true;
			}
		}
		if($go){
			$chaine = $managerChaine->selectChaineById($tuto->getChaineIdChaine());
			if(isset($_SESSION['auth'])){
				$fav = $managerFavoris->favorisTutoExist($_SESSION['auth']["id"],$tuto->getIdTuto());
				if(!is_null($fav)){
					$tabFav[] = $fav;
				}
				$note = $manager_note->issetNote($tuto->getIdTuto(),$_SESSION["auth"]["id"]);
				if(!is_null($note)){
					$tabNote[] = $note;
				}
			}

			if(!is_null($manager_note->issetNoteByTuto($tuto->getIdTuto()))){
				$tableau = $manager_note->countAndSumNoteByTuto($tuto->getIdTuto());
				$moy = $tableau['sumNote'] / $tableau['countNote'];
				$val_retour["moy"] = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;
			}
			

			if(isset($tabNote)){
				$val_retour["note"] = $tabNote;
			}
			if(isset($tabFav)){
				$val_retour["favoris"] = $tabFav;
			}

			$themes = $managerTheme->selectThemesTuto($tuto->getIdTuto());
			if(!is_null($themes)){
				$val_retour["themes"] = $themes;
			}

			$logiciels = $managerLogiciel->selectLogicielsTuto($tuto->getIdTuto());
			if(!is_null($logiciels)){
				$val_retour["logiciels"] = $logiciels;
			}

			$languages = $managerLanguage->selectLanguagesTuto($tuto->getIdTuto());
			if(!is_null($languages)){
				$val_retour["languages"] = $languages;
			}

			$commentaires = $managerCom->selectComAndUsersByTuto($tuto->getIdTuto());
			$countCom = $managerCom->countComByTuto($tuto->getIdTuto());

			$val_retour["commentaires"] = $commentaires;
			$val_retour["countCom"] = $countCom;
			$val_retour["tuto"] = $tuto;
			$val_retour["chaine"] = $chaine;
			if(isset($_SESSION['authChaine'])){
				if($chaine->getIdChaine() == $_SESSION['authChaine']['id']){
					$managerCom->updateNewPostComsByTuto($tuto->getIdTuto());
				}
			}
		}else{
			$page = new LandingPage();
			if($page->existPage()){
				$direction = $page->getPage();
			}else{
				$direction = "index";
			}
			$cx->close();
			$flash = new Flash();
			$flash->setFlash("Aucun tutoriel trouvé","nogood timeout");
			header("Location: ".$direction);
			exit();
		}

		return $val_retour;
	}

}

?>