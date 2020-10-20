<?php
namespace ORM\Proposition\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Proposition\Entity\Proposition;
use ORM\Proposition\Model\ManagerProposition;
use ORM\Visuel\Entity\Visuel;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Tuto\Entity\Tuto;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Theme\Entity\Theme;
use ORM\Theme\Model\ManagerTheme;
use ORM\Language\Entity\Language;
use ORM\Language\Model\ManagerLanguage;
use ORM\Logiciel\Entity\Logiciel;
use ORM\Logiciel\Model\ManagerLogiciel;

use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormAjoutCatProp;
use Vendors\LandingPage\LandingPage;
use Vendors\Flash\Flash;

use DateTime;

class AjoutCategorieProp extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Ajouter une catégorie proposé");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Proposition/View/viewFormAjoutCatProp.php",
		]);

		$flash = new Flash();
		$http 			= new HTTPRequest();
		$connexion 			= new Connexion();
		$managerTheme 		= new ManagerTheme($connexion);
		$managerLanguage 	= new ManagerLanguage($connexion);
		$managerLogiciel 	= new ManagerLogiciel($connexion);
		$managerProp 		= new ManagerProposition($connexion);

		$id = $http->getDataGet('id');
		$proposition = $managerProp->selectPropById($id);

		if(is_null($proposition)){
			$connexion->close();
			$flash->setFlash('Aucune proposition trouvé','nogood timeout');
			header('Location: vue-admin');
			exit();
		}

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormAjoutCatProp('post', $proposition)];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$date = new DateTime(); 
			$date = $date->format('Y-m-d H:i:s');
			$go = true;
			$cat = $http->getDataPost('categorie');
			$titre = $http->getDataPost('titre_categorie');

			if(($cat != 'language')&&($cat != 'logiciel')&&($cat != 'theme')){
				$go = false;
				$connexion->close();
				$flash->setFlash("Erreur#2 : Aucune catégorie valide",'nogood timeout');
				header('Location: vue-admin');
				exit();
			}

			if($titre != $proposition->getTitreProposition()){
				$proposition->setTitreProposition($titre);
				if($managerProp->updateTitreProp($proposition) == false){
					$go = false;
					$connexion->close();
					$flash->setFlash("Erreur#1 : Erreur lors de l'update du titre de la propositon",'nogood timeout');
					header('Location: vue-admin');
					exit();
				}
			}

			if($go){
				if($cat == 'theme'){
					$obj = new Theme(array(
						'titre_theme' => $proposition->getTitreProposition(),
						'actif_theme' => 1,
						'date_theme' => $date
					));
					$idCat = $managerTheme->insertTheme($obj);

				}else if($cat == 'logiciel'){
					$obj = new Logiciel(array(
						'titre_logiciel' => $proposition->getTitreProposition(),
						'actif_logiciel' => 1,
						'date_logiciel' => $date
					));
					$idCat = $managerLogiciel->insertLogiciel($obj);

				}else if($cat == 'language'){
					$obj = new Language(array(
						'titre_language' => $proposition->getTitreProposition(),
						'actif_language' => 1,
						'date_language' => $date
					));
					$idCat = $managerLanguage->insertLanguage($obj);
				}
				if($idCat > 0){
					if(!is_null($proposition->getTutoIdTuto())){
						if($cat == 'theme'){
							if($managerTheme->insertTutoHasTheme($proposition->getTutoIdTuto(),$idCat)){
								$res = true;
							}else{
								$res = false;
							}
						}else if($cat == 'logiciel'){
							if($managerLogiciel->insertTutoHasLogiciel($proposition->getTutoIdTuto(),$idCat)){
								$res = true;
							}else{
								$res = false;
							}
						}
						else if($cat == 'language'){
							if($managerLanguage->insertTutoHasLanguage($proposition->getTutoIdTuto(),$idCat)){
								$res = true;
							}else{
								$res = false;
							}
						}
					}
					if(!is_null($proposition->getVisuelIdVisuel())){
						if($cat == 'theme'){
							if($managerTheme->insertVisuelHasTheme($proposition->getVisuelIdVisuel(),$idCat)){
								$res = true;
							}else{
								$res = false;
							}
						}else if($cat == 'logiciel'){
							if($managerLogiciel->insertVisuelHasLogiciel($proposition->getVisuelIdVisuel(),$idCat)){
								$res = true;
							}else{
								$res = false;
							}
						}
					}
					if($res){
						$connexion->close();
						$flash->setFlash("Succès des insert de catégorie et d'association",'good timeout');
						header('Location: vue-admin');
						exit();
					}else{
						$connexion->close();
						$flash->setFlash("Erreur#4 : Erreur lors de l'insert de l'association",'nogood timeout');
						header('Location: vue-admin');
						exit();
					}
				}else{
					$connexion->close();
					$flash->setFlash("Erreur#3 : Erreur lors de l'insert de la catégorie",'nogood timeout');
					header('Location: vue-admin');
					exit();
				}
				
			}
		}

		$connexion->close();
		return $val_retour;
	}

}


?>