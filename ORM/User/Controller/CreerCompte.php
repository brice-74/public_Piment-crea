<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Entity\User;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormInscription;
use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\AutoMailer\AutoMailer;

use DateTime;


class CreerCompte extends Controller {

	function getResult(){

		$flash 	= new Flash();
		if(isset($_SESSION["auth"])){
			$flash->setFlash("Vous êtes déjà connecté","normal timeout");
			header("Location: index");
			die();
		}

		$this->setLayout("front");
		$this->setTitle("Créez un compte");
		$this->setDescription("Création d'un compte sur Piment Créa");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/User/View/formInscription.php",
		]);

		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormInscription()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;
		

		//Si soumission d'un form valide (sans erreur)
		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			//Alors traitement final
			$http 		= new HTTPRequest();
			$date 		= new DateTime();
			$date_crea 	= $date->format('Y-m-d H:i:s');
			$token 		= time().rand(1000000,9000000);
			
			$date->setTimestamp(strtotime("+15 minutes"));
			$date_token	= $date->format('Y-m-d H:i:s');

			$compte = new User(array(
				"nom_user" 				=> $http->getDataPost("nom_user"),
				"prenom_user" 			=> $http->getDataPost("prenom_user"),
				"email_user" 			=> $http->getDataPost("email_user"),
				"pass_user" 			=> $http->getDataPost("pass_user"),
				"date_rgpd_user" 		=> $date_crea,
				"rgpd_user"				=> TRUE,
				"actif_user" 			=> 0,
				"statut_user" 			=> 0,
				"token_mdp_user" 		=> $token,
				"date_token_mdp_user" 	=> $date_token,
			));
			
			//Est-ce bien un nouveau User ?
			$connexion 	= new Connexion();
			$manager 	= new ManagerUser($connexion);
			$user 		= $manager->userExist($compte->getEmailUser());
			if(!is_null($user)){
				$flash->setFlash("Vous avez déjà un compte sur notre plateforme <a class=\"a-linkNeg\" href=\"connexion\" title=\"Connexion\">connexion</a>.","normal");
			}else{
				if($manager->insertUser($compte) > 0){
					$automailer = new AutoMailer(
						$compte->getEmailUser(),
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
								Votre demande de création de compte a été enregistrée.
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
						$flash->setFlash("Un mail d'activation vous a été envoyé. Vous disposez de 15 minutes pour confirmer la création de 
							votre compte. Il est possible que ce mail soit dans vos 
							spams ou messages indésirables.","good");
					}else{
						//Erreur mail pas parti
						$flash->setFlash("Pb lors de l'envoi du mail d'activation. 
						Veuillez contacter le webmaster.","nogood timeout");
					}

				}else{
					//Insert échoué donc message
					$flash->setFlash("Echec lors de la création de votre 
					compte. Veuillez renouveler ultérieurement  ou 
					 contacter le webmaster.","nogood timeout");
				}
			}

			$connexion->close();
			
		}///Fin de la soumission


		return $val_retour;
	}

}

?>