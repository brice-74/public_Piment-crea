<?php
namespace ORM\Favoris\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Favoris\Model\ManagerFavoris;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;
use ORM\Favoris\Entity\Favoris;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use DateTime;

class TraitementFavorisTuto extends Controller {

	function getResult(){
		$flash		= new Flash();
		$http 		= new HTTPRequest();
		$id_tuto	= $http->getDataPost("favorisPost");

		$cx			= new Connexion();
		$manager_fav 	= new ManagerFavoris($cx);
		$manager_tuto 	= new ManagerTuto($cx);

		$date 	= new DateTime();
		$date 	= $date->format('Y-m-d H:i:s');

		if(isset($_SESSION["auth"])){
			$id_user = $_SESSION["auth"]["id"];
			$tuto = $manager_tuto->selectTutoPostById($id_tuto);

			if(!is_null($tuto)){
				$id_tuto = $tuto->getIdTuto();
				$fav = $manager_fav->favorisTutoExist($id_user,$id_tuto);

				if(!is_null($fav)){
					if($manager_fav->removeTutoFavoris($fav)){
						$result['PostFavoris'] = 'removeFav';
					}else{
						$flash->setFlash("Erreur#3 : Impossible de retirer le tutoriel des favoris, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}	
				}else{
					$obj = new Favoris([
						"date_favoris" => $date,
						"user_id_user" => $id_user,
						"tuto_id_tuto" => $id_tuto
					]);
					if($manager_fav->insertTutoFavoris($obj)){
						$result['PostFavoris'] = 'addFav';
					}else{
						$flash->setFlash("Erreur#3 : Impossible d'ajouter le tutoriel aux favoris, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}
			}else{
				$flash->setFlash("Erreur#1 : Impossible d'ajouter le tutoriel aux favoris, veuillez contacter le webmaster","nogood timeout");
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