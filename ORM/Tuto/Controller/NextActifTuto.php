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

use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;

use Vendors\DateTime\DateTimeTransform; 



class NextActifTuto extends Controller {

	function getResult(){
		/*$page = new LandingPage();
		$page->setPage("visuels");*/
		
		$cx		= new Connexion();
		$managerTuto		= new ManagerTuto($cx);
		$managerFavoris	= new ManagerFavoris($cx);
		$managerNote		= new ManagerNote($cx);
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
			if(preg_match('/^language-/', $value)){
				$lang[] = preg_replace('/[a-zA-Z-]/', '', $value);
			}
		}
		if(isset($theme)){
			$themes = implode(',', $theme);
		}
		if(isset($log)){
			$logs = implode(',', $log);
		}
		if(isset($lang)){
			$langs = implode(',', $lang);
		}

		if((!isset($themes))&&(!isset($logs))&&(!isset($langs))){
			$tabVTutoChaine = $managerTuto->selectTutosPostAndChaines($offset);
		}else{
			if((!isset($themes))&&(!isset($logs))){
			// trie language
			$tabVTutoChaine = $managerTuto->selectTutosPostAndChainesByLang($offset,$langs);
			}else if((!isset($themes))&&(!isset($langs))){
				// trie logiciel
				$tabVTutoChaine = $managerTuto->selectTutosPostAndChainesBylog($offset,$logs);
			}else if((!isset($logs))&&(!isset($langs))){
				// trie theme
				$tabVTutoChaine = $managerTuto->selectTutosPostAndChainesByTheme($offset,$themes);
			}else if(!isset($logs)){
				// trie theme / language
				$tabVTutoChaine = $managerTuto->selectTutosPostAndChainesByThemeAndlang($offset,$themes,$langs);
			}else if(!isset($langs)){
				// trie theme / logiciel
				$tabVTutoChaine = $managerTuto->selectTutosPostAndChainesByThemeAndlog($offset,$themes,$logs);
			}else if(!isset($themes)){
				// trie logiciel / language
				$tabVTutoChaine = $managerTuto->selectTutosPostAndChainesBylogAndLang($offset,$logs,$langs);
			}else{
				// trie all
				$tabVTutoChaine = $managerTuto->selectTutosPostAndChainesByCat($offset,$themes,$logs,$langs);
			}
		}


		if(!is_null($tabVTutoChaine)){
			foreach ($tabVTutoChaine as $tuto) {

				$tuto->{'5'} = $transformDate->transformDateTime($tuto->{'5'});
				if(isset($_SESSION['auth'])){
					$fav = $managerFavoris->favorisTutoExist($_SESSION['auth']["id"],$tuto->getIdTuto());
					$tabFav[] = $fav;
				}
				$note = $managerNote->countAndSumNoteByTuto2($tuto->getIdTuto());

				if($note->sumNote > 0){
					$moy = $note->sumNote / $note->countNote;
					$moy = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;
					$tabNote[] = [$moy,$note->getTutoIdTuto()];
				}else{
					$tabNote[] = null;
				}	
			}
			if(isset($_SESSION['auth'])){
				$result["user"] = $_SESSION['auth']['id'];
				$result["favoris"] = $tabFav;
			}
			if(isset($tabNote)){
				$result["note"] = $tabNote;
			}
			$result["tuto"] = $tabVTutoChaine;
		}else{
			$result["tuto"] = "Aucun tutoriel trouvé";
		}
		$cx->close();
		echo json_encode($result);
		exit();
	}

}

?>