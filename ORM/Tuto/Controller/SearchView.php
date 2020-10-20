<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;
use ORM\Chaine\Entity\Chaine;
use ORM\Chaine\Model\ManagerChaine;

use Vendors\FormBuilded\FormSearch;
use Vendors\LandingPage\LandingPage;
use OCFram\HTTPRequest;


class SearchView extends Controller {

	function getResult(){
		$http = new HTTPRequest();

		$this->setLayout("front");
		$this->setTitle("Recherche");
		$this->setDescription("Recherche");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Tuto/View/viewSearch.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		$build[] = $form[0]->buildForm();

		$search		= $http->getDataGet("search");
		if(empty($search)){
			$page = new LandingPage();
			if($page->existPage()){
				$attero = $page->getPage();
			}else{
				$attero = "index";
			}
			header("Location: ".$attero);
			exit();
		}
		$cx			= new Connexion();
		$manager_tuto 		= new ManagerTuto($cx);
		$manager_chaine 	= new ManagerChaine($cx);

		$chaines = $manager_chaine->selectChaineByName($search);
		$tutos = $manager_tuto->selectTutoByTitle($search);

		if((!is_null($tutos)) || (!is_null($chaines))){
			if(!is_null($tutos)){
				$val_retour['tutos'] = $tutos;
			}
			if(!is_null($chaines)){
				$val_retour['chaines'] = $chaines;
			}
		}else{
			$val_retour['no'] = 'Aucun résultat';
		}

		$val_retour["form"] = $build;
		$cx->close();
		return $val_retour;
	}
}
?>