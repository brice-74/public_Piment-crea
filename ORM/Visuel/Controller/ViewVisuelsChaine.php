<?php
namespace ORM\Visuel\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Model\ManagerChaine;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Like\Model\ManagerLike;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;
use ORM\Abonnement\Entity\Abonnement;
use ORM\Chaine\Entity\Chaine;
use ORM\Like\Entity\Like;
use ORM\Favoris\Entity\Favoris;

use Vendors\FormBuilded\FormSearch;
use Vendors\LandingPage\LandingPage;
use Vendors\Flash\Flash;

class ViewVisuelsChaine extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Visuels chaine");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Chaine/View/viewChaine.php",
		]);

		$page = new LandingPage();
		$flash = new Flash();
		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}
		$val_retour["form"] = $build;

		$connexion		= new Connexion();
		$managerAbo		= new ManagerAbonnement($connexion);
		$managerChaine	= new ManagerChaine($connexion);
		$managerTuto	= new ManagerTuto($connexion);
		$managerVisuel	= new ManagerVisuel($connexion);
		$managerLike	= new ManagerLike($connexion);
		$managerFavoris= new ManagerFavoris($connexion);
		$http 			= new HTTPRequest();
		$chaine = $managerChaine->selectChaineById($http->getDataGet("id"));

		$nameChaine = $http->getDataGet("name");
	
		$go = false;
		if(!is_null($chaine)){
			if($nameChaine == $chaine->getNomChaine()){
				$go = true;
			}
		}
		if($go){
			$val_retour["chaine"] = $chaine;
			$visuels = $managerVisuel->allVisuelByChaine($chaine->getIdChaine());
			$page->setPage("chaine-".$chaine->getIdChaine()."-".$chaine->getNomChaine()."/visuels");

			$val_retour["nbAbo"] = $managerAbo->selectNbAbonnementByChaine($chaine->getIdChaine());
			$val_retour["nbTuto"] = $managerTuto->selectNbTutoByChaine($chaine->getIdChaine());
			$val_retour["nbVisu"] = $managerVisuel->selectNbVisuByChaine($chaine->getIdChaine());

			$abo = false;
			if(isset($_SESSION['auth'])){
				$aboObj = $managerAbo->selectAbonnementByChaineAndUser($chaine->getIdChaine(),$_SESSION['auth']['id']);
				if(!is_null($aboObj)){
					$abo = true;
				}
			}
			$val_retour["abo"] = $abo;

			if(!is_null($visuels)){
				$val_retour["visuels"] = $visuels;

				foreach ($visuels as $visuel) {
					$countLikes[] = $managerLike->countLikeVisuel($visuel->getIdVisuel());
					$val_retour["countLikes"] = $countLikes;
					if(isset($_SESSION['auth'])){
						$like = $managerLike->likePostExist($_SESSION['auth']["id"],$visuel->getIdVisuel());
						$fav = $managerFavoris->favorisVisuelExist($_SESSION['auth']["id"],$visuel->getIdVisuel());
						if(!is_null($like)){
							$tabLike[] = $like;
							$val_retour["likes"] = $tabLike;
						}
						if(!is_null($fav)){
							$tabFav[] = $fav;
							$val_retour["favoris"] = $tabFav;
						}
					}
				}
			}else{
				$val_retour["visuels"] = "Aucun visuel trouvé sur cette chaine";
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucune chaine trouvé","nogood timeout");
			header("Location: ".DOMAINE."index");
			exit();
		}
		$connexion->close();
		return $val_retour;
	}

}


?>