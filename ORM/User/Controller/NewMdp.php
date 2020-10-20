<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormMail;
use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\AutoMailer\AutoMailer;
use Vendors\LandingPage\LandingPage;

use DateTime;

class NewMdp extends Controller {

	function getResult(){
		$page = new LandingPage();
		$page->setPage("profil");

		$this->setLayout("front");
		$this->setTitle("Mail de récupération du token");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/formMailMdp.php",
		]);

		$controller = new Controller();

		if(isset($_SESSION["auth"])){
			$connexion	= new Connexion();
			$manager	= new ManagerUser($connexion);
			$user		= $manager->oneUserById($_SESSION["auth"]["id"]);

			$date 	= new DateTime();
			$token 	= time().rand(1000000,9000000);
			$date->setTimestamp(strtotime("+15 minutes"));
			$date_token = $date->format('Y-m-d H:i:s');

			$user->setTokenMdpUser($token);
			$user->setDateTokenMdpUser($date_token);
			$manager->updateTokenUser($user);

			if($connexion->affected_rows == 1){
				$user		= $manager->oneUserById($_SESSION["auth"]["id"]);
				header('Location: nouveau-mdp-'.$user->getTokenMdpUser());
			}else{
				$flash->setFlash("Erreur lors de la recupération du profil, veuillez contacter le webmaster","nogood timeout");
			}

		}else{
			$form	= [new FormSearch('get', null, DOMAINE."search"),new FormMail()];
		}
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$http 		= new HTTPRequest();
			$email 	 	= $http->getDataPost("email_user");

			$connexion 	= new Connexion();
			$manager 	= new ManagerUser($connexion);
			$user 		= $manager->userExist($email);
			$flash = new Flash();

			if(!is_null($user)){
				//On tient quelqu'un : on va lui envoyer la procédure
				//de réinitialisation du mot de passe avec token 
				//et durée de validité
				$date 	= new DateTime();
				$token 	= time().rand(1000000,9000000);
				$date->setTimestamp(strtotime("+15 minutes"));
				$date_token = $date->format('Y-m-d H:i:s');

				if($user->getActifUser() == 1){
					$user->setTokenMdpUser($token);
					$user->setDateTokenMdpUser($date_token);
					$manager->updateTokenUser($user);

					if($connexion->affected_rows == 1){
						//Envoi du mail
						$automailer = new AutoMailer(
							$email,
							"Réinitialisation de votre mot de passe sur Piment-Créa",
							"
							<div style='background-color:rgb(255,255,255);width:100%;padding:50px 0px;display:flex;'>
								<img style='margin:auto;height:auto;width:20%;min-width:100px;max-width:200px;' src=\"https://instinct-crea.fr/templates/front/img/logo.jpg\" 
								alt=\"Logotype Piment-Créa\">
							</div>
							<div style='background-color:rgb(243,242,249);padding:50px 0;border-radius:10px;'>
								<h1 style='text-align:center;color:rgb(33,36,77);margin-bottom:50px;'>
									Réinitialisation de votre mot de passe
								</h1>
								<p style='margin-top:0;margin-bottom:50px;text-align:center;'>
									Pour réinitialiser votre mot de passe, veuillez cliquer sur ce lien :
								</p>
								<p style='display:flex;'>
									<a style='text-decoration: none;color:rgb(255,255,255);margin:auto;padding:10px 20px;border-radius:3px; background-color:rgb(230,50,38);'
									href=\"https://instinct-crea.fr/nouveau-mdp-".$token."\" 
									title=\"Activer mon compte\">
										Changer mon Mdp
									</a>
								</p>
							</div>
							"
						);
						//...
						if($automailer->sendMail()){
							//Allez voir votre mail d'activation
							$flash->setFlash("Un mail de réinitialisation vous a été envoyé. Vous disposez de 15 minutes pour vous recréer un mot de passe. Il est possible que ce mail soit dans vos spams ou messages indésirables.","good");
						}else{
							//Erreur mail pas parti
							$flash->setFlash("Pb lors de l'envoi du mail de réinitialisation. Veuillez contacter le webmaster.","nogood timeout");
						}
					}

				}else{
					$flash->setFlash("Vous ne pouvez pas réinitialiser 
						votre mot de passe car vous n'avez pas de compte 
						actif chez nous","good timeout");
				}
			}else{
				$flash->setFlash("Si ce email existe sur notre plateforme 
				vous recevrez un mail de réinitialisation du mot de passe, 
				sinon créez-vous un compte.","normal");
			}

			$connexion->close();

		}

		return $val_retour;

	}

}


?>