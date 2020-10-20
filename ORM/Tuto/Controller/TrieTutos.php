<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\Tuto\Model\ManagerTuto;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Note\Model\ManagerNote;
use ORM\Note\Entity\Note;
use ORM\Tuto\Entity\Tuto;
use ORM\Chaine\Entity\Chaine;
use ORM\Favoris\Entity\Favoris;
use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Language\Model\ManagerLanguage;
use ORM\Language\Entity\Language;
use ORM\Logiciel\Entity\Logiciel;
use ORM\Theme\Entity\Theme;

use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormTrieTuto;
use Vendors\LandingPage\LandingPage;



class TrieTutos extends Controller {

	function getResult(){
		$page = new LandingPage();

		$this->setLayout("front");
		$this->setTitle("Tutoriaux triés");
		$this->setDescription("Tutoriaux triés");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Tuto/View/actifTutos.php",
		]);


		$http 		 = new HTTPRequest();
		$page->setPage(str_replace('/', '', $http->getUri()));
		$themes = str_replace('-',',',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('theme')));
		$logs = str_replace('-',',',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('log')));
		$langs = str_replace('-',',',preg_replace('/[a-zA-Z_]/','',$http->getDataGet('lang')));

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormTrieTuto()];
		$controller->getSearch($form[0]);

		$build[] = $form[0]->buildForm();

		$cx		= new Connexion();
		$managerNote		= new ManagerNote($cx);
		$managerFavoris	= new ManagerFavoris($cx);
		$managerTuto		= new ManagerTuto($cx);

		if((empty($themes))&&(empty($logs))&&(empty($langs))){
			header('Location: tutoriaux');
			exit();
		}

		if((empty($themes))&&(empty($logs))){
			// trie language
			$tutos = $managerTuto->selectTutosPostAndChainesByLang(0,$langs);
		}else if((empty($themes))&&(empty($langs))){
			// trie logiciel
			$tutos = $managerTuto->selectTutosPostAndChainesBylog(0,$logs);
		}else if((empty($logs))&&(empty($langs))){
			// trie theme
			$tutos = $managerTuto->selectTutosPostAndChainesByTheme(0,$themes);
		}else if(empty($logs)){
			// trie theme / language
			$tutos = $managerTuto->selectTutosPostAndChainesByThemeAndlang(0,$themes,$langs);
		}else if(empty($langs)){
			// trie theme / logiciel
			$tutos = $managerTuto->selectTutosPostAndChainesByThemeAndlog(0,$themes,$logs);
		}else if(empty($themes)){
			// trie logiciel / language
			$tutos = $managerTuto->selectTutosPostAndChainesBylogAndLang(0,$logs,$langs);
		}else{
			// trie all
			$tutos = $managerTuto->selectTutosPostAndChainesByCat(0,$themes,$logs,$langs);
		}

		$managerTheme		= new ManagerTheme($cx);
		$managerLogiciel	= new ManagerLogiciel($cx);
		$managerLanguage	= new ManagerLanguage($cx);
		$tabV = $managerTuto->allIdTuto();
		foreach ($tabV as $v) {
			$tabId[] = $v->getIdTuto();
		}
		$imp = implode(",", $tabId);
		$tabLogciel = $managerLogiciel->SelectTutoHasLogicielByTuto($imp);
		$tabTheme = $managerTheme->SelectTutoHasThemeByTuto($imp);
		$tabLanguage = $managerLanguage->SelectTutoHasLanguageByTuto($imp);

		$build[] = $form[1]->buildForm($tabTheme,$tabLogciel,$tabLanguage);


		if(!is_null($tutos)){
			foreach ($tutos as $tuto) {
				if(isset($_SESSION['auth'])){
					$fav = $managerFavoris->favorisTutoExist($_SESSION['auth']["id"],$tuto->getIdTuto());
					if(!is_null($fav)){
						$tabFav[] = $fav;
					}
					$note = $managerNote->countAndSumNoteByTuto2($tuto->getIdTuto());
					if(!is_null($note)){
						$tabNote[] = $note;
					}
				}
			}
			if(isset($tabFav)){
				$val_retour["favoris"] = $tabFav;
			}
			if(isset($tabNote)){
				$val_retour["note"] = $tabNote;
			}

			$val_retour["tutos"] = $tutos;
		}else{
			$val_retour["tutos"] = "Aucun tutoriel trouvé";
		}

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$values_theme = $http->getMultiChoiceData("/^theme-[0-9]+$/","/^theme_tuto$/");
			$values_logiciel = $http->getMultiChoiceData("/^logiciel-[0-9]+$/","/^logiciel_tuto$/");
			$values_language = $http->getMultiChoiceData("/^language-[0-9]+$/","/^language_tuto$/");

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
			if(!empty($values_language)){
				$impLanguage = implode('-', $values_language);
				$url .= '+languages_'.$impLanguage;
			}else{
				$url .= '+languages_';
			}

			header('Location: tutoriaux'.$url);
			
		}

		$val_retour["form"] = $build;
		$cx->close();
		return $val_retour;
	}

}

?>