<?php
namespace ORM\Chaine\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Entity\Chaine;
use ORM\Chaine\Model\ManagerChaine;
use ORM\User\Model\ManagerUser;

use Vendors\LandingPage\LandingPage;
use Vendors\FormBuilded\FormCreaChaine;
use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;

use DateTime;


class CreerChaine extends Controller {

	function getResult(){

		$flash 	= new Flash();
		if(!isset($_SESSION["auth"])){
			$flash->setFlash("Il vous faut un d'abord un compte pour pouvoir créer une chaine","normal timeout");

			$page = new LandingPage();
			$page->setPage("creation-chaine");

			header("Location: creation-compte");
			die();
		}
		if($_SESSION["auth"]["statut"] > 1){
			$flash->setFlash("Vous êtes déjà associé à une chaine","normal timeout");
			header("Location: index");
			die();
		}

		$this->setLayout("front");
		$this->setTitle("Créez une chaine");
		$this->setDescription("Création d'une chaine sur Piment Créa");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Chaine/View/formCreaChaine.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormCreaChaine()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;
		

		//Si soumission d'un form valide (sans erreur)
		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			//Alors traitement final
			$http 		= new HTTPRequest();
			$date 		= new DateTime();
			$date_crea 	= $date->format('Y-m-d H:i:s');

			$chaine = new Chaine(array(
				"nom_chaine" 			=> $http->getDataPost("nom_chaine"),
				"description_chaine"	=> $http->getDataPost("description_chaine",1),
				"lien_in_chaine"		=> $http->getDataPost("lien_in_chaine"),
				"lien_fb_chaine"		=> $http->getDataPost("lien_fb_chaine"),
				"lien_insta_chaine"		=> $http->getDataPost("lien_insta_chaine"),
				"lien_ytb_chaine"		=> $http->getDataPost("lien_ytb_chaine"),
				"lien_tw_chaine"		=> $http->getDataPost("lien_tw_chaine"),
				"date_crea_chaine" 		=> $date_crea,
				"avatar_chaine"			=> NULL,
				"visuel_chaine"			=> NULL
			));

			$connexion 	= new Connexion();
			$managerChaine 	= new ManagerChaine($connexion);
			$managerUser	= new ManagerUser($connexion);

			if($managerChaine->chaineExist($chaine->getNomChaine()) == FALSE){
				$id_chaine = $managerChaine->insertChaine($chaine);

				if($id_chaine > 0){
					$user = $managerUser->oneUserById($_SESSION["auth"]["id"]);
					$chaine = $managerChaine->selectChaineById($id_chaine);

					if(!is_null($chaine)){

						if($managerUser->updateStatutChaineUser($user,$chaine)){
							$_SESSION["authChaine"]["visuel"] 		= $chaine->getVisuelChaine();
							$_SESSION["authChaine"]["avatar"] 		= $chaine->getAvatarChaine();
							$_SESSION["authChaine"]["id"] 			= $chaine->getIdChaine();
							$_SESSION["authChaine"]["nom"] 			= $chaine->getNomChaine();
							$_SESSION["authChaine"]["description"] 	= $chaine->getDescriptionChaine();
							$_SESSION["authChaine"]["lien_in"]		= $chaine->getLienInChaine();
							$_SESSION["authChaine"]["lien_fb"] 		= $chaine->getLienFbChaine();
							$_SESSION["authChaine"]["lien_insta"] 	= $chaine->getLienInstaChaine();
							$_SESSION["authChaine"]["lien_ytb"] 	= $chaine->getLienYtbChaine();
							$_SESSION["authChaine"]["lien_tw"] 		= $chaine->getLienTwChaine();
							$_SESSION["auth"]["statut"] 			= 2;

							$connexion->close();
							$flash->setFlash("Chaine créée avec succès","good timeout");
							header("Location: vue-chaine/".$_SESSION["authChaine"]["nom"]);
							exit();
						}else{
							$flash->setFlash("Un problème est survenu lors de la création de votre compte, veuillez contacter le webmaster","nogood timeout");
						}
					}else{
						$flash->setFlash("Un problème est survenu lors de la création de votre compte, veuillez contacter le webmaster","nogood timeout");
					}
				}else{
					$flash->setFlash("Un problème est survenu lors de la création de votre compte, veuillez contacter le webmaster","nogood timeout");
				}
			}else{
				$flash->setFlash($chaine->getNomChaine()." existe déjà, veuillez essayer un autre nom","normal timeout");
			}
		$connexion->close();
		}

		return $val_retour;
	}

}

?>