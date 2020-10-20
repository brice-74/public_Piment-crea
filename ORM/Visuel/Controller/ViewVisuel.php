<?php
namespace ORM\Visuel\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Theme\Model\ManagerTheme;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Like\Model\ManagerLike;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Favoris\Entity\Favoris;
use ORM\Like\Entity\Like;
use ORM\Visuel\Entity\Visuel;
use ORM\Chaine\Entity\Chaine;
use ORM\Logiciel\Entity\Logiciel;
use ORM\Theme\Entity\Theme;
use ORM\Commentaire\Entity\Commentaire;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;



class ViewVisuel extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Visuel");
		$this->setDescription("Visuel");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Visuel/View/viewVisuel.php",
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
		$managerLogiciel 	= new ManagerLogiciel($cx);
		$managerTheme 	= new ManagerTheme($cx);
		$managerLike	= new ManagerLike($cx);
		$managerVisuel	= new ManagerVisuel($cx);
		$managerFavoris= new ManagerFavoris($cx);
		$managerChaine	= new ManagerChaine($cx);
		$http 			= new HTTPRequest();
		$visuel = $managerVisuel->selectVisuelById($http->getDataGet("id"));
		$titleVisu = $http->getDataGet("title");

		$go = false;
		if(!is_null($visuel)){
			if($titleVisu == preg_replace('/.jpg$|.png$|.jpeg$/', '', $visuel->getVisuelVisuel())){
				$go = true;
			}
		}
		if($go){
			$chaine = $managerChaine->selectChaineById($visuel->getChaineIdChaine());
			if(isset($_SESSION['auth'])){
				$like = $managerLike->likePostExist($_SESSION['auth']["id"],$visuel->getIdVisuel());
				$fav = $managerFavoris->favorisVisuelExist($_SESSION['auth']["id"],$visuel->getIdVisuel());
				if(!is_null($like)){
					$tabLike[] = $like;
				}
				if(!is_null($fav)){
					$tabFav[] = $fav;
				}
			}
			if(isset($tabFav)){
				$val_retour["favoris"] = $tabFav;
			}
			if(isset($tabLike)){
				$val_retour["likes"] = $tabLike;
			}

			$themes = $managerTheme->selectThemesVisuel($visuel->getIdVisuel());
			if(!is_null($themes)){
				$val_retour["themes"] = $themes;
			}

			$logiciels = $managerLogiciel->selectLogicielsVisuel($visuel->getIdVisuel());
			if(!is_null($logiciels)){
				$val_retour["logiciels"] = $logiciels;
			}

			$commentaires = $managerCom->selectComAndUsersByVisu($visuel->getIdVisuel());
			$countCom = $managerCom->countComByVisu($visuel->getIdVisuel());
			$countLikes[] = $managerLike->countLikeVisuel($visuel->getIdVisuel());

			$val_retour["commentaires"] = $commentaires;
			$val_retour["countCom"] = $countCom;
			$val_retour["countLikes"] = $countLikes;
			$val_retour["visuel"] = $visuel;
			$val_retour["chaine"] = $chaine;
			if(isset($_SESSION['authChaine'])){
				if($chaine->getIdChaine() == $_SESSION['authChaine']['id']){
					$managerCom->updateNewPostComsByVisu($visuel->getIdVisuel());
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
			$flash->setFlash("Aucun visuel trouvé","nogood timeout");
			header("Location: ".$direction);
			exit();
		}

		return $val_retour;
	}

}

?>