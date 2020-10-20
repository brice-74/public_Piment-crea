<?php
namespace Vendors\StaticPage\Controller;
use OCFram\Controller;
use Vendors\FormBuilded\FormSearch;


class Concept extends Controller{

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Piment Créa - Tuto Photoshop les meilleurs tutoriaux photoshop gratuit, tuto débutant, Tuto Photoshop, illustrator, Cinema 4D, 3D, design graphique");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "Vendors/StaticPage/View/concept.php",
		]);
		$this->setDescription("Tuto et visuels axés design graphique, photo-manipulation, 3D et interface web");

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

