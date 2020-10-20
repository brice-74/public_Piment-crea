<?php
namespace ORM\Chaine\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Model\ManagerChaine;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Like\Model\ManagerLike;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Note\Model\ManagerNote;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\User\Model\ManagerUser;
use ORM\User\Entity\User;
use ORM\Abonnement\Entity\Abonnement;
use ORM\Commentaire\Entity\Commentaire;
use ORM\Note\Entity\Note;
use ORM\Tuto\Entity\Tuto;
use ORM\Chaine\Entity\Chaine;
use ORM\Like\Entity\Like;

use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormAvatarChaine;
use Vendors\FormBuilded\FormBandeau;
use Vendors\Flash\Flash;
use Vendors\File\Uploader;

class ViewMyChaine extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Vue sur la chaine");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Chaine/View/viewMyChaine.php",
		]);

		$flash = new Flash();
		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormBandeau(),new FormAvatarChaine()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}
		$val_retour["form"] = $build;

		$connexion		= new Connexion();
		$managerUser 	= new ManagerUser($connexion);
		$managerAbo 	= new ManagerAbonnement($connexion);
		$managerCom 	= new ManagerCommentaire($connexion);
		$managerNote	= new ManagerNote($connexion);
		$managerTuto	= new ManagerTuto($connexion);
		$managerChaine	= new ManagerChaine($connexion);
		$managerVisuel	= new ManagerVisuel($connexion);
		$managerLike	= new ManagerLike($connexion);
		$chaine = $managerChaine->selectChaineById($_SESSION["authChaine"]["id"]);

		if(!is_null($chaine)){
			$val_retour["chaine"] = $chaine;
			$abo = $managerAbo->countAbonnementsChaine($chaine->getIdChaine());
			$val_retour['nbAbo'] = $abo->countAbonnements;
			$visuels = $managerVisuel->allVisuelByChaine($chaine->getIdChaine());

			$members = $managerUser->selectUsersByChaine($chaine->getIdChaine());
			$val_retour["membres"] = $members;

			if(!is_null($visuels)){
				$val_retour["visuels"] = $visuels;
				$nbVisu = 0;
				foreach ($visuels as $visuel) {
					$nbVisu++;
					$commentaires[] = $managerCom->selectComAndUsersByVisu($visuel->getIdVisuel());
					$visuLike = $managerLike->countLikeVisuel($visuel->getIdVisuel());
					$sumLike[] = $visuLike->sommeLikes;
					$countLikes[] = $visuLike;
					$val_retour["countLikes"] = $countLikes;
				}
				if(isset($commentaires)){
					$val_retour["comVisu"] = $commentaires;
				}
				$val_retour["sumLike"] = array_sum($sumLike);
				$val_retour["nbVisu"] = $nbVisu;
			}else{
				$val_retour["visuels"] = "Aucun visuel trouvé";
			}

			$tutos = $managerTuto->allTutoslByChaine($chaine->getIdChaine());
			if(!is_null($tutos)){
				$val_retour["tutos"] = $tutos;
				$nbTuto = 0;
				foreach($tutos as $tuto){
					$nbTuto++;
					$commentaires[] = $managerCom->selectComAndUsersByTuto($tuto->getIdTuto());
					$note = $managerNote->countAndSumNoteByTuto2($tuto->getIdTuto());
					$countNote[] = $note->countNote;
					$sumNote[] = $note->sumNote;
					if(!is_null($note)){
						$tabNote[] = $note;
					}
				}
				$val_retour["sumNote"] = array_sum($sumNote);
				$val_retour["countNote"] = array_sum($countNote);
				$val_retour["nbTuto"] = $nbTuto;
				if(isset($tabNote)){
					$val_retour["note"] = $tabNote;
				}
				if(isset($commentaires)){
					$val_retour["comTuto"] = $commentaires;
				}

			}else{
				$val_retour["tutos"] = "Aucun tuto trouvé";
			}
		}else{
			$connexion->close();
			$flash->setFlash("Aucune chaine trouvé","nogood timeout");
		}

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$destination = 'medias/chaine/id-'.$chaine->getIdChaine().'/bandeau/';

			$http 		 = New HTTPRequest();
			$file		 = $http->getDataFiles("visuel_chaine");

			if(!is_dir($destination)){
				mkdir($destination, 0777,TRUE);
			}

			$uploader 	 = new Uploader($file,$destination);
			$visuel 	 = $uploader->upload();

			if(!is_null($visuel)){
				$chaine->setVisuelChaine($visuel);

				//Redimensionnement
				$uploader->imageSizing(2100);

				//Update de la table avec le nouveau nom de fichier
				if($managerChaine->updateVisuel($chaine)){
					$_SESSION["authChaine"]["visuel"] 	= $visuel;
					$flash->setFlash("Bandeau uploadé","good timeout");
				}else{
					$flash->setFlash("Impossible de changer le bandeau pour le moment","nogood timeout");
				}

			}else{
				$flash->setFlash("Problème lors de l'upload du fichier, veuillez contacter le webmaster","nogood timeout");
			}
			$connexion->close();
			header("Location: ".$_SESSION["authChaine"]["nom"]);
			exit();
		}

		if(($form[2]->isSubmit("go2"))&&($form[2]->isValid())){
			$destination = 'medias/chaine/id-'.$chaine->getIdChaine().'/avatars/';

			$http 		 = New HTTPRequest();
			$file		 = $http->getDataFiles("avatar_chaine");

			if(!is_dir($destination)){
				mkdir($destination, 0777,TRUE);
			}

			$uploader 	 = new Uploader($file,$destination);
			$avatar 	 = $uploader->upload();

			if(!is_null($avatar)){
				$chaine->setAvatarChaine($avatar);

				$uploader->imageSizing(300);

				if($managerChaine->updateAvatar($chaine)){
					$_SESSION["authChaine"]["avatar"] 	= $avatar;
					$flash->setFlash("Avatar uploadé","good timeout");
				}else{
					$flash->setFlash("Impossible de changer l'avatar pour le moment","nogood timeout");
				}

			}else{
				$flash->setFlash("Problème lors de l'upload du fichier, veuillez contacter le webmaster","nogood timeout");
			}
			$connexion->close();
			header("Location: ".$_SESSION["authChaine"]["nom"]);
			exit();
		}
		$connexion->close();
		return $val_retour;
	}

}


?>