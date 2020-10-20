<?php
namespace ORM\Visuel\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Visuel\Entity\Visuel;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Proposition\Entity\Proposition;
use ORM\Proposition\Model\ManagerProposition;
use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;

use Vendors\FormBuilded\FormPostVisuel;
use Vendors\FormBuilded\FormProposition;
use Vendors\FormBuilded\FormSearch;
use Vendors\File\Uploader;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;

use DateTime;


class AjoutVisuel extends Controller {

	function getResult(){
		$flash 			= new Flash();
		$page 		= new LandingPage();

		$ua = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/iphone|android|blackberry|symb|ipad|ipod|phone/i',$ua)){
			$flash->setFlash("Fonctionnalité inaccessible sur téléphone et tablette","normal timeout");
			$page = new LandingPage();
			if($page->existPage()){
				$erno = $page->getPage();
			}else{
				$erno = "index";
			}
			header("Location:".$erno);
			exit();
		}

		$this->setLayout("front");
		$this->setTitle("Poster un visuel");
		$this->setDescription("Poster un visuel");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Visuel/View/formPostVisuel.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new formPostVisuel(), new FormProposition('post', null, DOMAINE."traitement-prop")];
		$controller->getSearch($form[0]);

		$connexion = new Connexion();
		$managerTheme = new ManagerTheme($connexion);
		$managerLogiciel = new ManagerLogiciel($connexion);
		$logiciels = $managerLogiciel->selectLogiciels();
		$themes = $managerTheme->selectThemes();

		$build[] = $form[0]->buildForm();
		$build[] = $form[1]->buildForm($themes,$logiciels);
		$build[] = $form[2]->buildForm();

		$val_retour["form"] = $build;

		$managerProp = new ManagerProposition($connexion);
		if(isset($_SESSION["propVisu"])){
			$chaine = implode(',', $_SESSION['propVisu']);
			$val_retour["props"] = $managerProp->selectPropByIds($chaine);
		}

		$http 		 = new HTTPRequest();
		$date 		= new DateTime();
		
		//Si soumission d'un form valide (sans erreur)
		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$date_post 	= $date->format('Y-m-d H:i:s');

			$destination = 'medias/chaine/id-'.$_SESSION["authChaine"]["id"].'/visuel/';

			if(!is_dir($destination)){
				mkdir($destination, 0777,TRUE);
			}

			$file		 = $http->getDataFiles("visuel_visuel");
			$uploader 	 = new Uploader($file,$destination);
			$visuel_visuel 	 = $uploader->upload();

			$values_theme = $http->getMultiChoiceData("/^theme-[0-9]+$/","/^theme_visuel$/");
			$values_logiciel = $http->getMultiChoiceData("/^logiciel-[0-9]+$/","/^logiciel_visuel$/");


			if(!is_null($visuel_visuel)){
				$uploader->copyMin();
				$uploader->imageSizing(2100);

				$visuel = new Visuel([
					"visuel_visuel" => $visuel_visuel,
					"description_visuel" => $http->getDataPost("description_visuel"),
					"date_post_visuel" => $date_post
				]);

				$managerVisuel = new ManagerVisuel($connexion);
				$id_visuel = $managerVisuel->createVisuel($visuel,$_SESSION["authChaine"]["id"]);

				if($id_visuel > 0){
					if((!empty($values_theme))||(!empty($values_logiciel))){

						foreach ($values_theme as $id_theme) {
							$managerTheme->insertVisuelHasTheme($id_visuel,$id_theme);
						}
						foreach ($values_logiciel as $id_logiciel) {
							$managerLogiciel->insertVisuelHasLogiciel($id_visuel,$id_logiciel);
						}
					}
					if(isset($_SESSION["propVisu"])){
						$chaine = implode(',', $_SESSION['propVisu']);
						$props = $managerProp->selectPropByIds($chaine);

						foreach ($props as $prop) {
							$prop->setVisuelIdVisuel($id_visuel);
							$managerProp->updatePropVisu($prop);
						}
						unset($_SESSION["propVisu"]);
					}

					$flash->setFlash("Visuel posté avec succès","good timeout");
					$connexion->close();
					header("Location: chaine-".$_SESSION["authChaine"]["id"]."-".$_SESSION["authChaine"]["nom"]."/visuels");
					exit();
				}
			}else{
				$flash->setFlash("L'upload de l'image à échoué, veuillez contacter le webmaster","nogood timeout");
			}
		}
		$connexion->close();
		return $val_retour;
	}

}

?>