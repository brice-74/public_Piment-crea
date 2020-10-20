<?php
namespace ORM\Chaine\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Entity\Chaine;
use ORM\Chaine\Model\ManagerChaine;

use Vendors\LandingPage\LandingPage;
use Vendors\FormBuilded\FormModifChaine;
use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

use DateTime;


class ModifInfosChaine extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Modification informations chaine");
		$this->setDescription("Modification informations chaine");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Chaine/View/formModifChaine.php",
		]);

		$flash 				= new Flash();
		$connexion 			= new Connexion();
		$managerChaine 	= new ManagerChaine($connexion);
		$chaine = $managerChaine->selectChaineById($_SESSION['authChaine']['id']);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormModifChaine("post",$chaine)];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;
		
		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){

			$http = new HTTPRequest();

			$chaine->setDescriptionChaine($http->getDataPost("description_chaine",1));
			$chaine->setLienInChaine($http->getDataPost("lien_in_chaine"));
			$chaine->setLienFbChaine($http->getDataPost("lien_fb_chaine"));
			$chaine->setLienInstaChaine($http->getDataPost("lien_insta_chaine"));
			$chaine->setLienYtbChaine($http->getDataPost("lien_ytb_chaine"));
			$chaine->setLienTwChaine($http->getDataPost("lien_tw_chaine"));

			if($managerChaine->updateInfos($chaine)){
				$connexion->close();
				$flash->setFlash("Modifications effectués avec succès","good timeout");
				header("Location: vue-chaine/".$_SESSION['authChaine']['nom']);
				exit();
			}else{
				$flash->setFlash("Erreur#1 : Impossible de modifier les informations, veuillez contacter le webmaster","nogood timeout");
			}
		
		}

		$connexion->close();
		return $val_retour;
	}

}

?>