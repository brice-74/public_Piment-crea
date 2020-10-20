<?php
namespace ORM\Favoris\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Favoris\Model\ManagerFavoris;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Visuel\Entity\Visuel;
use ORM\Favoris\Entity\Favoris;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use DateTime;

class TraitementFavoris extends Controller {

	function getResult(){
		$flash		= new Flash();
		$http 		= new HTTPRequest();
		$id_visu	= $http->getDataPost("favorisPost");

		$cx			= new Connexion();
		$manager_fav 	= new ManagerFavoris($cx);
		$manager_visu 	= new ManagerVisuel($cx);

		$date 	= new DateTime();
		$date 	= $date->format('Y-m-d H:i:s');

		if(isset($_SESSION["auth"])){
			$id_user = $_SESSION["auth"]["id"];
			$visuel = $manager_visu->selectVisuelById($id_visu);

			if(!is_null($visuel)){
				$id_visu = $visuel->getIdVisuel();
				$fav = $manager_fav->favorisVisuelExist($id_user,$id_visu);

				if(!is_null($fav)){
					if($manager_fav->removeVisuelFavoris($fav)){
						$result['PostFavoris'] = 'removeFav';
					}else{
						$flash->setFlash("Erreur#3 : Impossible de retirer le visuel des favoris, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}	
				}else{
					$obj = new Favoris([
						"date_favoris" => $date,
						"user_id_user" => $id_user,
						"visuel_id_visuel" => $id_visu
					]);
					if($manager_fav->insertVisuelFavoris($obj)){
						$result['PostFavoris'] = 'addFav';
					}else{
						$flash->setFlash("Erreur#3 : Impossible d'ajouter le visuel aux favoris, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}
			}else{
				$flash->setFlash("Erreur#1 : Impossible d'ajouter le visuel aux favoris, veuillez contacter le webmaster","nogood timeout");
				$result['flash'] = $flash->getFlash();
			}
		}else{
			$flash->setFlash("Créez un compte pour ajouter aux favoris !","normal timeout");
			$result['flash'] = $flash->getFlash();
		}
		echo json_encode($result);
		$cx->close();
	}
}
?>