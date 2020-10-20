<?php
namespace ORM\Visuel\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\Visuel\Model\ManagerVisuel;
use ORM\Like\Model\ManagerLike;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Visuel\Entity\Visuel;
use ORM\Chaine\Entity\Chaine;
use ORM\Like\Entity\Like;
use ORM\Favoris\Entity\Favoris;

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;

use Vendors\DateTime\DateTimeTransform; 



class NextActifVisu extends Controller {

	function getResult(){
		/*$page = new LandingPage();
		$page->setPage("visuels");*/
		
		$cx		= new Connexion();
		$managerVisuel	= new ManagerVisuel($cx);
		$managerLike	= new ManagerLike($cx);
		$managerFavoris	= new ManagerFavoris($cx);

		$transformDate = new DateTimeTransform();

		$http = new HTTPRequest();
		$offset = $http->getDataPost('offset');
		$values = $http->getDataPost('select');
		$exp = explode(",", $values);

		foreach ($exp as $value) {
			if(preg_match('/^theme-/', $value)){
				$theme[] = preg_replace('/[a-zA-Z-]/', '', $value);
			}
			if(preg_match('/^logiciel-/', $value)){
				$log[] = preg_replace('/[a-zA-Z-]/', '', $value);
			}
		}
		if(isset($theme)){
			$themes = implode(',', $theme);
		}
		if(isset($log)){
			$logs = implode(',', $log);
		}
		
		

		if((isset($themes)) || (isset($logs))){

			if(!isset($logs)){
				$tabVisuChaine = $managerVisuel->selectVisuelsAndChainesByThemes($offset,$themes);
			}else if(!isset($themes)){
				$tabVisuChaine = $managerVisuel->selectVisuelsAndChainesByLogs($offset,$logs);
			}else{
				$tabVisuChaine = $managerVisuel->selectVisuelsAndChainesByCat($offset,$themes,$logs);
			}

		}else{
			$tabVisuChaine = $managerVisuel->selectVisuelsAndChaines($offset);
		}

		if(!is_null($tabVisuChaine)){
			foreach ($tabVisuChaine as $visuel) {

				$visuel->{'3'} = $transformDate->transformDateTime($visuel->{'3'});
				if(isset($_SESSION['auth'])){
					$like = $managerLike->likePostExist($_SESSION['auth']["id"],$visuel->getIdVisuel());
					$fav = $managerFavoris->favorisVisuelExist($_SESSION['auth']["id"],$visuel->getIdVisuel());
					$tabLike[] = $like;
					$tabFav[] = $fav;
				}
				$countLikes[] = $managerLike->countLikeVisuel($visuel->getIdVisuel());
			}
			if(isset($_SESSION['auth'])){
				$result["user"] = $_SESSION['auth']['id'];
				$result["favoris"] = $tabFav;
				$result["likes"] = $tabLike;
			}
			$result["countLikes"] = $countLikes;
			$result["visu"] = $tabVisuChaine;
		}else{
			$result["visu"] = "Aucun visuel trouvé";
		}
		$cx->close();
		echo json_encode($result);
		exit();
	}

}

?>