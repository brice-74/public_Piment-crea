<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\User\Model\ManagerUser;
use Vendors\FormBuilded\FormSearch;
use Vendors\FormBuilded\FormMail;

use Vendors\Flash\Flash;
use Vendors\AutoMailer\AutoMailer;
use Vendors\LandingPage\LandingPage;

use DateTime;

class NewActivation extends Controller {	

	function getResult(){
		$page = new LandingPage();
		$page->setPage("creation-compte");

		$this->setLayout("front");
		$this->setTitle("Recevoir un nouveau mail d'activation");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/formMail.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormMail()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;

		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			//OK POUR LE TRAITEMENT FINAL
			$http 	= new HTTPRequest();
			$mail		= $http->getDataPost("email_user");
			$flash 	= new Flash();
			$date 	= new DateTime();
			$token 	= time().rand(1000000,9000000);
			$date->setTimestamp(strtotime("+15 minutes"));
			$date_token = $date->format('Y-m-d H:i:s');

			$connexion	= new Connexion();
			$manager	= new ManagerUser($connexion);
			$user 		= $manager->userExist($mail);
			if(!is_null($user)){
				//GETTER : statut, actif
				if(($user->getStatutUser() == 0)&&($user->getActifUser() == 0)){
					$user->setTokenMdpUser($token);
					$user->setDateTokenMdpUser($date_token);
					if($manager->updateTokenUser($user)){
						//Envoi du mail
						$automailer = new AutoMailer(
							$mail,
							"Création de votre compte sur Piment-Créa",
							"
							<div style='background-color:rgb(255,255,255);width:100%;padding:50px 0px;display:flex;'>
								<img style='margin:auto;height:auto;width:20%;min-width:100px;max-width:200px;' src=\"https://instinct-crea.fr/templates/front/img/logo.jpg\" 
								alt=\"Logotype Piment-Créa\">
							</div>
							<div style='background-color:rgb(243,242,249);padding:50px 0;border-radius:10px;'>
								<h1 style='text-align:center;color:rgb(33,36,77);margin-bottom:50px;'>
									Lien d'activation de votre compte
								</h1>
								<p style='margin-bottom:5px;text-align:center;'>
									Voici votre nouveau mail d'activation.
								</p>
								<p style='margin-top:0;margin-bottom:50px;text-align:center;'>
									Pour finaliser votre inscription, veuillez cliquer sur ce lien :
								</p>
								<p style='display:flex;'>
									<a style='text-decoration: none;color:rgb(255,255,255);margin:auto;padding:10px 20px;border-radius:3px; background-color:rgb(230,50,38);'
									href=\"https://instinct-crea.fr/activation-".$token."\" 
									title=\"Activer mon compte\">
										Activer mon compte
									</a>
								</p>
							</div>
							"
						);
						//...
						if($automailer->sendMail()){
							//Allez voir votre mail d'activation
							$flash->setFlash("Un mail d'activation vous a été envoyé. Vous disposez de 15 minutes pour confirmer la création de votre compte. Il est possible que ce mail soit dans vos spams ou messages indésirables.","good");
						}else{
							//Erreur mail pas parti
							$flash->setFlash("Pb lors de l'envoi du mail d'activation. Veuillez contacter le webmaster.","nogood timeout");
						}
					}else{
						$flash->setFlash("Pb, contactez le webmaster.","nogood timeout");
					}
				}else{
					$flash->setFlash("Connectez-vous ou utilisez la 
						fonction mot de passe oublié.","normal timeout");
					header("Location: connexion");
					exit();
				}
			}else{
				$connexion->close();
				$flash->setFlash("Créez vous un compte.","normal timeout");
				header("Location: inscription");
				exit();
			}

			$connexion->close();
		}
		//Fin de la soumission

		//--
		return $val_retour;
	}

}
?>