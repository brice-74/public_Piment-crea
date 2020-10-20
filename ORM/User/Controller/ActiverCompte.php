<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormConnexion;


use Vendors\Flash\Flash;


class ActiverCompte extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Activation compte");
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

		$http 	= new HTTPRequest();
		$token 	= $http->getDataGet("id");

		$connexion 	= new Connexion();
		$manager 	= new ManagerUser($connexion);
		$flash 		= new Flash();

		$user = $manager->oneUserByTokenValid($token);

		if(!is_null($user)){
			if(mkdir('medias/user/id-'.$user->getIdUser(), 0777,TRUE)){
				$user->setStatutUser(1);
				$user->setActifUser(1);
				$manager->updateActivationUser($user);

				$connexion->close();
				$flash->setFlash("Compte activé, merci de vous connecter","good timeout");
				header("Location: connexion");
				exit();
			}else{
				$flash->setFlash("Echec lors de l'activation du compte, veuillez contacter le webmaster","nogood timeout");
			}
		}else{
			$flash->setFlash("Trop lent ! Merci de cliquer 
			pour recevoir un <a class=\"a-link\" href=\"nouvelle-activation\" 
			title=\"Nouveau mail\">nouveau mail</a> d'activation. 
			","nogood");
		}

		$connexion->close();

		return $val_retour;
	}

}
?>