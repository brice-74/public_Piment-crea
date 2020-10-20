<?php
namespace ORM\Chaine\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Model\ManagerChaine;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\User\Model\ManagerUser;
use ORM\User\Entity\User;
use ORM\Visuel\Entity\Visuel;
use ORM\Tuto\Entity\Tuto;
use ORM\Abonnement\Entity\Abonnement;
use ORM\Chaine\Entity\Chaine;

use Vendors\FormBuilded\FormSearch;
use Vendors\LandingPage\LandingPage;
use Vendors\Flash\Flash;

class ViewDescriptionChaine extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Description de la chaine");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Chaine/View/viewChaine.php",
		]);

		$page 		= new LandingPage();
		$flash 		= new Flash();
		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}
		$val_retour["form"] = $build;

		$connexion		= new Connexion();
		$managerChaine	= new ManagerChaine($connexion);
		$managerAbo		= new ManagerAbonnement($connexion);
		$managerUser		= new ManagerUser($connexion);
		$managerTuto		= new ManagerTuto($connexion);
		$managerVisuel		= new ManagerVisuel($connexion);

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
			$membres = $managerUser->selectUsersByChaine($chaine->getIdChaine());
			if(!is_null($membres)){
				$nbMembres = 0;
				foreach ($membres as $membre) {
					$nbMembres++;
				}
			}else{
				$nbMembres = 0;
			}
			$val_retour["members"] = $nbMembres;
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

			$val_retour["chaine"] = $chaine;
			$val_retour["desc-chaine"] = $chaine;
		}
		else{
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