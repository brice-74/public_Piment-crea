<?php
namespace ORM\Abonnement\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Abonnement\Entity\Abonnement;
use ORM\Like\Model\ManagerLike;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Chaine\Entity\Chaine;
use ORM\Like\Entity\Like;
use ORM\Favoris\Entity\Favoris;
use ORM\Visuel\Entity\Visuel;
use ORM\Visuel\Model\ManagerVisuel;

use ORM\Tuto\Entity\Tuto;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Note\Entity\Note;
use ORM\Note\Model\ManagerNote;

use Vendors\LandingPage\LandingPage;
use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

use DateTime;


class ViewVisuelsAbonnements extends Controller {

	function getResult(){

		$page = new LandingPage();
		$page->setPage('abonnements');

		$this->setLayout("front");
		$this->setTitle("Les derniers contenus de vos abonnements");
		$this->setDescription("Les derniers visuels de vos abonnements");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Abonnement/View/viewAbonnements.php",
		]);

		$flash 				= new Flash();
		$cx 					= new Connexion();
		$managerNote 			= new ManagerNote($cx);
		$managerChaine 		= new ManagerChaine($cx);
		$managerTuto 			= new ManagerTuto($cx);
		$managerAbonnement 	= new ManagerAbonnement($cx);
		$managerVisuel 		= new ManagerVisuel($cx);
		$managerLike 			= new ManagerLike($cx);
		$managerFavoris 		= new ManagerFavoris($cx);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;
		
		$tutos = $managerTuto->selectTutosAndChainesAbos($_SESSION['auth']['id']);
		$visuels = $managerVisuel->selectVisuelsAndChainesAbos($_SESSION['auth']['id']);
		$chaines = $managerChaine->selectChainesAbo($_SESSION['auth']['id']);

		if(!is_null($chaines)){
			$val_retour['chaines'] = $chaines;
		}else{	
			$val_retour['chaines'] = 'Aucun abonnement';
		}

		if(!is_null($tutos)){
			$val_retour['tutos'] = $tutos;

			foreach($tutos as $tuto){
				$fav = $managerFavoris->favorisTutoExist($_SESSION['auth']["id"],$tuto->getIdTuto());
				$note = $managerNote->countAndSumNoteByTuto2($tuto->getIdTuto());
				if(!is_null($note)){
					$tabNote[] = $note;
					$val_retour["note"] = $tabNote;
				}
				if(!is_null($fav)){
					$tabFav[] = $fav;
					$val_retour["favorisTuto"] = $tabFav;
				}
			}
		}else{	
			$val_retour['tutos'] = 'Aucun tutoriel';
		}

		if(!is_null($visuels)){
			$val_retour['visuels'] = $visuels;

			foreach($visuels as $visuel){
				$countLikes[] = $managerLike->countLikeVisuel($visuel->getIdVisuel());
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
			$val_retour["countLikes"] = $countLikes;
		}else{	
			$val_retour['visuels'] = 'Aucun visuel';
		}

		$cx->close();
		return $val_retour;
	}

}

?>