<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Model\ManagerChaine;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Note\Model\ManagerNote;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Visuel\Entity\Visuel;
use ORM\Abonnement\Entity\Abonnement;
use ORM\Note\Entity\Note;
use ORM\Tuto\Entity\Tuto;
use ORM\Chaine\Entity\Chaine;
use ORM\Favoris\Entity\Favoris;

use Vendors\FormBuilded\FormSearch;
use Vendors\LandingPage\LandingPage;
use Vendors\Flash\Flash;

class ViewTutosChaine extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Profil");
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

		$cx		= new Connexion();
		$managerNote		= new ManagerNote($cx);
		$managerTuto		= new ManagerTuto($cx);
		$managerVisuel		= new ManagerVisuel($cx);
		$managerChaine		= new ManagerChaine($cx);
		$managerFavoris	= new ManagerFavoris($cx);
		$managerAbo			= new ManagerAbonnement($cx);
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
			$tutos = $managerTuto->allTutoslByChaine($chaine->getIdChaine());
			$page->setPage("chaine-".$chaine->getIdChaine()."-".$chaine->getNomChaine()."/tutos");

			$abo = false;
			if(isset($_SESSION['auth'])){
				$aboObj = $managerAbo->selectAbonnementByChaineAndUser($chaine->getIdChaine(),$_SESSION['auth']['id']);
				if(!is_null($aboObj)){
					$abo = true;
				}
			}
			$val_retour["abo"] = $abo;

			$val_retour["nbAbo"] = $managerAbo->selectNbAbonnementByChaine($chaine->getIdChaine());
			$val_retour["nbTuto"] = $managerTuto->selectNbTutoByChaine($chaine->getIdChaine());
			$val_retour["nbVisu"] = $managerVisuel->selectNbVisuByChaine($chaine->getIdChaine());
			
			if(!is_null($tutos)){
				$val_retour["tutos"] = $tutos;
				
				foreach ($tutos as $tuto) {
					if(isset($_SESSION['auth'])){
						$fav = $managerFavoris->favorisTutoExist($_SESSION['auth']["id"],$tuto->getIdTuto());
						if(!is_null($fav)){
							$tabFav[] = $fav;
							$val_retour["favorisTuto"] = $tabFav;
						}
					}
					$note = $managerNote->countAndSumNoteByTuto2($tuto->getIdTuto());
					if(!is_null($note)){
						$tabNote[] = $note;
						$val_retour["note"] = $tabNote;
					}
				}

			}else{
				$val_retour["tutos"] = "Aucun tutoriel trouvé sur cette chaine";
			}

		}else{
			$cx->close();
			$flash->setFlash("Aucune chaine trouvé","nogood timeout");
			header("Location: ".DOMAINE."index");
			exit();
		}
		$cx->close();
		return $val_retour;
	}

}


?>