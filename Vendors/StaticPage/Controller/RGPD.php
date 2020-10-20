<?php 
namespace Vendors\StaticPage\Controller;
use Vendors\FormBuilded\FormSearch;
use OCFram\Controller;

class RGPD extends Controller{

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Mentions légales - CGU - Politique de Confidentialité");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "Vendors/StaticPage/View/rgpd.php",
		]);
		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search")];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}
		$val_retour["form"] = $build;

		return $val_retour;
	}
}
?>