<?php
namespace ORM\Favoris\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Like\Model\ManagerLike;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Note\Model\ManagerNote;
use ORM\Note\Entity\Note;
use ORM\Favoris\Entity\Favoris;
use ORM\Like\Entity\Like;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;



class FavorisByUser extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Favoris");
		$this->setDescription("Favoris");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Favoris/View/viewFavoris.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;
		
		$cx		= new Connexion();
		$managerNote		= new ManagerNote($cx);
		$managerFavoris = new ManagerFavoris($cx);
		$managerLike = new ManagerLike($cx);

		$tab_visu_fav = $managerFavoris->visuelsAndChainesByFavoris($_SESSION['auth']['id']);
		$tab_tuto_fav = $managerFavoris->tutosAndChainesByFavoris($_SESSION['auth']['id']);

		if(!is_null($tab_visu_fav)){
			$val_retour['visuels'] = $tab_visu_fav;
			foreach ($tab_visu_fav as $visuel) {
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
				$countLikes[] = $managerLike->countLikeVisuel($visuel->getIdVisuel());
				$val_retour["countLikes"] = $countLikes;
			}
		}else{
			$val_retour['visuels'] = 'Aucun Favoris';
		}

		if(!is_null($tab_tuto_fav)){
			$val_retour['tutos'] = $tab_tuto_fav;
			foreach ($tab_tuto_fav as $tuto) {
				$fav = $managerFavoris->favorisTutoExist($_SESSION['auth']["id"],$tuto->getIdTuto());
				if(!is_null($fav)){
					$tabFav[] = $fav;
					$val_retour["favorisTuto"] = $tabFav;
				}
				$note = $managerNote->countAndSumNoteByTuto2($tuto->getIdTuto());
				if(!is_null($note)){
					$tabNote[] = $note;
					$val_retour["note"] = $tabNote;
				}
			}
		}else{
			$val_retour['tutos'] = 'Aucun Favoris';
		}
		


		return $val_retour;
	}

}

?>