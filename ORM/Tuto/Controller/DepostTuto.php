<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;
use ORM\User\Model\ManagerUser;
use ORM\User\Entity\User;
use Vendors\LandingPage\LandingPage;

use DateTime;



class DepostTuto extends Controller{

	function getResult(){
		$flash = new Flash();

		$cx = new Connexion();
		$manager = new ManagerTuto($cx);
		$managerUser 	= new ManagerUser($cx);

		$http = new HTTPRequest();
		$id_tuto = $http->getDataGet('id');

		$obj = $manager->selectTutoById($id_tuto);

		if(!is_null($obj)){

			$members = $managerUser->selectUsersByChaine($obj->getChaineIdChaine());
			$go = false;
			foreach ($members as $member) {
				if($member->getIdUser() == $_SESSION['auth']['id']){
					$go = true;
				}
			}
			if($go){
				if($manager->updateDepostTuto($obj)){
					$cx->close();
					$flash->setFlash("Tutoriel dépublié avec succès","good timeout");
					header('Location: brouillons');
					exit();
				}else{
					$cx->close();
					$flash->setFlash("Erreur#2 : Un problème est survenu lors de la dépublication du tutoriel, veuillez contacter le webmaster","nogood timeout");
					header('Location: '.$_SESSION['authChaine']['nom']);
					exit();
				}
			}else{
				$flash->setFlash("Accès interdit","nogood timeout");
				$cx->close();
				header('Location: vue-chaine/'.$_SESSION['authChaine']['nom']);
				exit();
			}
		
		}else{
			$cx->close();
			$flash->setFlash("Erreur#1 : Un problème est survenu lors de la récupération du tutoriel, veuillez contacter le webmaster","nogood timeout");
			header('Location: vue-chaine/'.$_SESSION['authChaine']['nom']);
			exit();
		}
	}
}
?>

