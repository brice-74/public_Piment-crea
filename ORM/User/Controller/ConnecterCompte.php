<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use ORM\Chaine\Model\ManagerChaine;

use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormConnexion;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;

class ConnecterCompte extends Controller {

	function getResult(){
		$flash = new Flash();

		if(isset($_SESSION["auth"])){
			if(isset($_SESSION['modifMdp'])){
				unset($_SESSION['modifMdp']);
				$flash->setFlash("Mot de passe modifié","good timeout");
				header("Location: index");
				exit();
				die();
			}else{
				$flash->setFlash("Vous êtes déjà connecter","normal timeout");
				header("Location: index");
				exit();
				die();
			}
			
		}

		$this->setLayout("front");
		$this->setTitle("Connexion");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/formConnexion.php",
		]);


		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormConnexion()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$http 		= new HTTPRequest();
			$login 	 	= $http->getDataPost("email_user");
			$pass 	 	= $http->getDataPost("pass_user");

			$connexion 	= new Connexion();
			$managerUser 	= new ManagerUser($connexion);
			$user 		= $managerUser->connectUser($login,$pass);

			if(is_null($user)){
				$flash->setFlash("Impossible de se connecter 
					avec ces identifiants","nogood timeout");

				if(isset($_SESSION["sleep"])){
					$_SESSION["sleep"] = $_SESSION["sleep"]+0.5;
					sleep($_SESSION["sleep"]);
				}else{
					$_SESSION["sleep"] = 0.5;
					sleep($_SESSION["sleep"]);
				}
				
			}else{
				if(isset($_SESSION["sleep"])) {unset($_SESSION["sleep"]);}

				$_SESSION["auth"]["id"] 		= $user->getIdUser();
				$_SESSION["auth"]["statut"] 	= $user->getStatutUser();
				$_SESSION["auth"]["nom"] 		= $user->getNomUser();
				$_SESSION["auth"]["prenom"] 	= $user->getPrenomUser();
				$_SESSION["auth"]["email"] 		= $user->getEmailUser();
				$_SESSION["auth"]["avatar"] 	= $user->getAvatarUser();
				$_SESSION["auth"]["date"] 	= $user->getDateRgpdUser();
				$id_chaine = $user->getChaineIdChaine();


				if(isset($id_chaine)){
					$managerChaine	= new ManagerChaine($connexion);
					$chaine = $managerChaine->selectChaineById($id_chaine);
					$_SESSION["authChaine"]["id"] 		= $chaine->getIdChaine();
					$_SESSION["authChaine"]["nom"] 		= $chaine->getNomChaine();
					$_SESSION["authChaine"]["visuel"] 	= $chaine->getVisuelChaine();
					$_SESSION["authChaine"]["avatar"] 	= $chaine->getAvatarChaine();
					$_SESSION["authChaine"]["date"] 	= $chaine->getDateCreaChaine();
				}

				$flash->setFlash("Vous êtes connecté","good timeout");

				$connexion->close();
				header("Location: profil");
				exit();
			}
			$connexion->close();
		}
		
		return $val_retour;

	}

}


?>