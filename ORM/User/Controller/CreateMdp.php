<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormMdp;
use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;


class CreateMdp extends Controller {	
	
	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Recréer un mot de passe");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/formMdp.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormMdp()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$http 	= new HTTPRequest();
			$token 	= $http->getDataGet("id");
			$newMdp = $http->getDataPost("pass_user");

			$connexion	= new Connexion();
			$manager	= new ManagerUser($connexion);
			$user 		= $manager->oneUserByTokenValid($token);
			$flash		= new Flash();

			if(!is_null($user)) {
				$user->setPassUser($newMdp);
				$manager->updatePassUser($user);
				$connexion->close();
				$flash->setFlash("Connectez-vous avec 
					ce nouveau mot de passe","good timeout");
				$_SESSION['modifMdp'] = true;
				header("Location: connexion");
				exit();
			}else{
				$flash->setFlash("Délai de réinitialisation expiré. Veuillez 
					renouveler votre demande de mot de passe en cliquant ici : 
					<a href=\"mot-passe-oublie\" class=\"a-link\" title=\"Réinitialiser\">recommencer la tentative</a>","nogood"
				);
			}


			$connexion->close();
		}

		return $val_retour;
	}

	
}
?>