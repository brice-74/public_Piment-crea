<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Entity\User;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormProfil;
use Vendors\Flash\Flash;

use DateTime;


class ModifierProfil extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Modifier son profil");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/formProfil.php",
		]);

		$connexion	= new Connexion();
		$manager	= new ManagerUser($connexion);
		$user		= $manager->oneUserById($_SESSION["auth"]["id"]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormProfil("post",$user)];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		
		//Si soumission d'un form valide (sans erreur)
		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$flash	= new Flash();
			$http = new HTTPRequest();
			$user->setNomUser($http->getDataPost("nom_user"));
			$user->setPrenomUser($http->getDataPost("prenom_user"));
			$user->setEmailUser($http->getDataPost("email_user"));
			$user->setPassUser($http->getDataPost("pass_user"));

			if($manager->oneUserByIdAndPass($user)){
				//La modif
				if($manager->updateProfil($user)){
					$_SESSION["auth"]["statut"] 	= $user->getStatutUser();
					$_SESSION["auth"]["nom"] 			= $user->getNomUser();
					$_SESSION["auth"]["prenom"] 	= $user->getPrenomUser();
					
					$connexion->close();
					$flash->setFlash("Modifications confirmés","good timeout");
					header("Location: profil");
					exit();
				}else{
					$flash->setFlash("Vous n'avez pas fait de modification","normal timeout");
				}

			}else{
				//Attention pas le bon mdp
				$flash->setFlash("Merci de renseigner le 
					bon mot de passe actuel","nogood timeout");
			}
			
			
		}//Fin de la soumission

		$connexion->close();

		return $val_retour;

	}

}

?>