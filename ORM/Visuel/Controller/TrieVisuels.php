<?php
namespace ORM\Visuel\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\Visuel\Model\ManagerVisuel;
use ORM\Like\Model\ManagerLike;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Logiciel\Entity\Logiciel;
use ORM\Theme\Entity\Theme;
use ORM\Visuel\Entity\Visuel;
use ORM\Chaine\Entity\Chaine;
use ORM\Like\Entity\Like;
use ORM\Favoris\Entity\Favoris;

use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormTrieVisu;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;



class TrieVisuels extends Controller {

	function getResult(){
		$page = new LandingPage();

		$this->setLayout("front");
		$this->setTitle("Visuel triés");
		$this->setDescription("Visuel triés");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Visuel/View/actifVisuels.php",
		]);

		$http 		 = new HTTPRequest();
		$page->setPage(str_replace('/', '', $http->getUri()));
		$themes = str_replace('-',',',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('theme')));
		$logs = str_replace('-',',',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('log')));

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormTrieVisu()];
		$controller->getSearch($form[0]);

		$build[] = $form[0]->buildForm();
		
		$connexion		= new Connexion();
		$managerVisuel	= new ManagerVisuel($connexion);
		$managerLike	= new ManagerLike($connexion);
		$managerFavoris	= new ManagerFavoris($connexion);

		if((empty($themes))&&(empty($logs))){
			header('Location: visuels');
			exit();
		}

		if(empty($logs)){
			$tabVisuChaine = $managerVisuel->selectVisuelsAndChainesByThemes(0,$themes);
		}else if(empty($themes)){
			$tabVisuChaine = $managerVisuel->selectVisuelsAndChainesByLogs(0,$logs);
		}else{
			$tabVisuChaine = $managerVisuel->selectVisuelsAndChainesByCat(0,$themes,$logs);
		}
			
		$managerTheme		= new ManagerTheme($connexion);
		$managerLogiciel	= new ManagerLogiciel($connexion);
		
		$tabV = $managerVisuel->allIdVisu();
		foreach ($tabV as $v) {
			$tabId[] = $v->getIdVisuel();
		}
		$imp = implode(",", $tabId);
		$tabLogciel = $managerLogiciel->SelectVisuHasLogicielByVisu($imp);
		$tabTheme = $managerTheme->SelectVisuHasThemeByVisu($imp);

		$build[] = $form[1]->buildForm($tabTheme,$tabLogciel);
	

		if(!is_null($tabVisuChaine)){

			foreach ($tabVisuChaine as $visuel) {
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
				$countLikes[] = $managerLike->countLikeVisuel($visuel->getIdVisuel());
			}
			if(isset($tabFav)){
				$val_retour["favoris"] = $tabFav;
			}
			if(isset($tabLike)){
				$val_retour["likes"] = $tabLike;
			}

			$val_retour["countLikes"] = $countLikes;
			$val_retour["visuels"] = $tabVisuChaine;
		}else{
			$val_retour["visuels"] = "Aucun visuel trouvé";
		}



		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$http 		 = New HTTPRequest();

			$values_theme = $http->getMultiChoiceData("/^theme-[0-9]+$/","/^theme_visuel$/");
			$values_logiciel = $http->getMultiChoiceData("/^logiciel-[0-9]+$/","/^logiciel_visuel$/");

			$url = '';
			if(!empty($values_theme)){
				$impThemes = implode('-', $values_theme);
				$url .= '+themes_'.$impThemes;
			}else{
				$url .= '+themes_';
			}
			if(!empty($values_logiciel)){
				$impLogiciels = implode('-', $values_logiciel);
				$url .= '+logiciels_'.$impLogiciels;
			}else{
				$url .= '+logiciels_';
			}

			header('Location: visuels'.$url);
			
		}

		$val_retour["form"] = $build;
		$connexion->close();
		return $val_retour;
	}

}

?>