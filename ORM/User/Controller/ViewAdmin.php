<?php
namespace ORM\User\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Signal\Entity\Signal;
use ORM\Signal\Model\ManagerSignal;
use ORM\Proposition\Entity\Proposition;
use ORM\Proposition\Model\ManagerProposition;

use Vendors\FormBuilded\FormSearch;
use Vendors\LandingPage\LandingPage;
use Vendors\Flash\Flash;

class ViewAdmin extends Controller {

	function getResult(){
		$page = new LandingPage();
		$page->setPage("vue-admin");

		$this->setLayout("front");
		$this->setTitle("Administration");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/viewAdmin.php",
		]);
		
		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		$connexion = new Connexion();
		$managerSignal 	= new ManagerSignal($connexion);
		$managerProp 		= new ManagerProposition($connexion);

		$signals = $managerSignal->selectAllSignal();
		if(!is_null($signals)){
			$val_retour['signals'] = $signals;
		}else{
			$val_retour['signals'] = 'Aucun signalement';
		} 

		$propTuto = $managerProp->selectPropsTuto();
		if(!is_null($propTuto)){
			$val_retour['propTuto'] = $propTuto;
		}else{
			$val_retour['propTuto'] = 'Aucune proposition';
		} 

		$propVisu = $managerProp->selectPropsVisu();
		if(!is_null($propVisu)){
			$val_retour['propVisu'] = $propVisu;
		}else{
			$val_retour['propVisu'] = 'Aucune proposition';
		} 

		$connexion->close();
		return $val_retour;
	}

}


?>