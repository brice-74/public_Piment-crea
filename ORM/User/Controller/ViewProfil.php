<?php
namespace ORM\User\Controller;
use OCFram\Controller;

use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use ORM\User\Entity\User;
use ORM\Like\Model\ManagerLike;
use ORM\Like\Entity\Like;
use ORM\Favoris\Model\ManagerFavoris;
use ORM\Favoris\Entity\Favoris;
use ORM\Abonnement\Model\ManagerAbonnement;
use ORM\Abonnement\Entity\Abonnement;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Commentaire\Entity\Commentaire;
use ORM\Note\Model\ManagerNote;
use ORM\Note\Entity\Note;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Chaine\Entity\Chaine;

use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormAvatar;
use Vendors\File\Uploader;
use Vendors\Flash\Flash;

class ViewProfil extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Profil");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/profil.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormAvatar()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		$connexion	= new Connexion();
		$managerNote 			= new ManagerNote($connexion);
		$managerLike 			= new ManagerLike($connexion);
		$managerFavoris 		= new ManagerFavoris($connexion);
		$managerAbonnement 	= new ManagerAbonnement($connexion);
		$managerCommentaire 	= new ManagerCommentaire($connexion);
		$managerUser			= new ManagerUser($connexion);
		$managerChaine 		= new ManagerChaine($connexion);

		$val_retour["counter"][] 	= $managerNote->countNotesUser($_SESSION["auth"]["id"]);
		$val_retour["counter"][] 	= $managerLike->countLikesUser($_SESSION["auth"]["id"]);
		$val_retour["counter"][] 	= $managerFavoris->countFavorisVisuelUser($_SESSION["auth"]["id"]);
		$val_retour["counter"][] 	= $managerFavoris->countFavorisTutoUser($_SESSION["auth"]["id"]);
		$val_retour["counter"][] 	= $managerAbonnement->countAbonnementsUser($_SESSION["auth"]["id"]);
		$val_retour["counter"][] 	= $managerCommentaire->countCommentairesVisuelUser($_SESSION["auth"]["id"]);
		$val_retour["counter"][] 	= $managerCommentaire->countCommentairesTutoUser($_SESSION["auth"]["id"]);

		$user		= $managerUser->oneUserById($_SESSION["auth"]["id"]);

		if(isset($_SESSION['authChaine'])){
			$chaine = $managerChaine->selectChaineById($_SESSION['authChaine']['id']);
			/*$users = $managerUser->selectUsersByChaine($chaine->getIdChaine());*/

			$val_retour["chaine"] = $chaine;
			/*$val_retour["usersChaine"] = $users;*/
		}

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$destination = 'medias/user/id-'.$user->getIdUser().'/avatars/';
			$flash 		 = new Flash();

			$http 		 = new HTTPRequest();
			$file		 = $http->getDataFiles("avatar_user");

			if(!is_dir($destination)){
				mkdir($destination, 0777,TRUE);
			}

			$uploader 	 = new Uploader($file,$destination);
			$avatar 	 = $uploader->upload();

			if(!is_null($avatar)){
				$user->setAvatarUser($avatar);
				$uploader->imageSizing(300);

				if($managerUser->updateAvatar($user)){
					$_SESSION["auth"]["avatar"] 	= $avatar;
					$flash->setFlash("Avatar uploadé","good timeout");
				}else{
					$flash->setFlash("Impossible de changer l'avatar pour le moment","nogood timeout");
				}
			}else{
				$flash->setFlash("Problème lors de l'upload du fichier, veuillez contacter le webmaster","nogood timeout");
			}
			$connexion->close();
			header("Location:profil");
			exit();
		}
		$connexion->close();
		return $val_retour;
	}

}


?>