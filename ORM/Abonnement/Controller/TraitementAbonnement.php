<?php
namespace ORM\Abonnement\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Abonnement\Entity\Abonnement;
use ORM\Chaine\Entity\Chaine;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use DateTime;


class TraitementAbonnement extends Controller {

	function getResult(){
		$result = [];
		$flash		= new Flash();
		$http 		= new HTTPRequest();

		$id_chaine		= $http->getDataPost("idChaine");

		$cx				= new Connexion();
		$manager_abo 		= new ManagerAbonnement($cx);
		$manager_chaine	= new ManagerChaine($cx);

		$date 		= new DateTime();
		$date 		= $date->format('Y-m-d H:i:s');

		$chaine = $manager_chaine->selectChaineById($id_chaine);
		if(isset($_SESSION['auth'])){
			if(!is_null($chaine)){
				$abo = $manager_abo->selectAbonnementByChaineAndUser($chaine->getIdChaine(),$_SESSION['auth']['id']);
				
				if(is_null($abo)){
					$abo = new Abonnement(array(
						'user_id_user' 		=> $_SESSION['auth']['id'],
						'chaine_id_chaine' 	=> $chaine->getIdChaine(),
						'date_abonnement' 	=> $date
					));

					if($manager_abo->insertAbo($abo)){
						$result["addAbo"] = $chaine;
					}else{
						$flash->setFlash("Erreur : Impossible de vous abonner, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}else{

					if($manager_abo->removeAbo($abo->getIdAbonnement())){
						$result["removeAbo"] = $chaine;
					}else{
						$flash->setFlash("Erreur : Impossible de vous désabonner, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}
			}else{
				$flash->setFlash("Erreur : Les actions liées aux abonnements sont impossibles, veuillez contacter le webmaster","nogood timeout");
				$result['flash'] = $flash->getFlash();
			}
		}else{
			$flash->setFlash("Vous devez créer un compte pour vous abonner","normal timeout");
			$result['flash'] = $flash->getFlash();
		}
		
		$result["nbAbo"] = $manager_abo->selectNbAbonnementByChaine($chaine->getIdChaine());
		
		$cx->close();
		echo json_encode($result);
	}
}
?>