<?php
namespace ORM\Chaine\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\Chaine\Entity\Chaine;
use ORM\User\Entity\User;
use ORM\Chaine\Model\ManagerChaine;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormAjoutMembre;
use Vendors\FormBuilded\FormSearch;
use Vendors\Flash\Flash;
use Vendors\AutoMailer\AutoMailer;

use DateTime;


class AjoutMembre extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Ajout d'un membre sur sa chaine");
		$this->setDescription("Ajout d'un membre sur sa chaine");
		$this->setView([
			"vueFormSearch" => "Vendors/StaticPage/View/formSearch.php",
			"vueMain" => "ORM/Chaine/View/formAjoutMembre.php",
		]);
		$flash 	= new Flash();
		$controller = new Controller();
		$form	= [new FormSearch('get', null, DOMAINE."search"),new FormAjoutMembre()];
		$controller->getSearch($form[0]);

		foreach ($form as $formSeul) {
			$build[] = $formSeul->buildForm();
		}

		$val_retour["form"] = $build;
		
		if(($form[1]->isSubmit("go"))&&($form[1]->isValid())){
			$connexion 	= new Connexion();
			$http 		= new HTTPRequest();
			$date 		= new DateTime();
			$managerUser = new ManagerUser($connexion);

			$mail = $http->getDataPost('email_user');
			$userExist = $managerUser->userExist($mail);

			$letsgo = false;

			if(!is_null($userExist)){
				if($userExist->getActifUser() == 1){
					if($userExist->getStatutUser() == 2){
						if($userExist->getChaineIdChaine() == $_SESSION['authChaine']['id']){
							$flash->setFlash("Cet utilisateur fait déja partit de la chaine","normal timeout");
							$connexion->close();
							header('Location: ajouter-membre');
							exit();
						}else{
							$flash->setFlash("Impossible d'ajouter ce membre, celui-ci fait déjà partit d'une chaine","normal timeout");
							$connexion->close();
							header('Location: ajouter-membre');
							exit();
						}
					}else{
						$letsgo = true;
					}
				}else{
					$flash->setFlash("Impossible d'ajouter ce membre, celui-ci n'est plus actif.","normal timeout");
					$connexion->close();
					header('Location: ajouter-membre');
					exit();
				}
				
			}else{
				$flash->setFlash("Impossible d'ajouter ce membre, celui-ci ne possède pas de compte sur Piment-Créa","normal timeout");
				$connexion->close();
				header('Location: ajouter-membre');
				exit();
			}

			if($letsgo){
				$date 		= new DateTime();
				$date->setTimestamp(strtotime("+15 minutes"));
				$date_tok 	= $date->format('Y-m-d H:i:s');
				$token 		= time().rand(1000000,9000000);
				$token 		= $token.'--'.$_SESSION['authChaine']['id'];

				$userExist->setTokenInvitationUser($token);
				$userExist->setDateTokenInvitationUser($date_tok);

				if($managerUser->updateTokenChaineUser($userExist)){
					$automailer = new AutoMailer(
						$userExist->getEmailUser(),
						"Invitation à la chaine ".$_SESSION['authChaine']['nom']." sur Piment-Créa",
						"
						<div style='background-color:rgb(255,255,255);width:100%;padding:50px 0px;display:flex;'>
							<img style='margin:auto;height:auto;width:20%;min-width:100px;max-width:200px;' src=\"https://instinct-crea.fr/templates/front/img/logo.jpg\" 
							alt=\"Logotype Piment-Créa\">
						</div>
						<div style='background-color:rgb(243,242,249);padding:50px 0;border-radius:10px;'>
							<h1 style='text-align:center;color:rgb(33,36,77);margin-bottom:50px;'>
								Invitation à participer sur la chaine <span style='font-weight:bold;'>".$_SESSION['authChaine']['nom']."</span>
							</h1>
							<p style='margin-bottom:5px;text-align:center;'>
								Vous avez été invité à être membre d'une chaine.
							</p>
							<p style='margin-top:0;margin-bottom:50px;text-align:center;'>
								Pour finaliser votre addésion, veuillez cliquer sur ce lien :
							</p>
							<p style='display:flex;'>
								<a style='text-decoration: none;color:rgb(255,255,255);margin:auto;padding:10px 20px;border-radius:3px; background-color:rgb(230,50,38);'
								href=\"https://instinct-crea.fr/addesion-".$token."\" 
								title=\"Addérer à la chaine ".$_SESSION['authChaine']['nom']."\">
									Rejoindre la chaine
								</a>
							</p>
						</div>
						"
					);
					if($automailer->sendMail()){
						$flash->setFlash("Un mail d'activation a été envoyé. Le destinataire dispose de 15 minutes pour confirmer l'addésion. Il est possible que ce mail soit dans les spams ou messages indésirables.","good");
						$connexion->close();
						header('Location: vue-chaine/'.$_SESSION['authChaine']['nom']);
						exit();
					}else{
						$flash->setFlash("Erreur#1 : Problème lors de l'envoi du mail d'addésion. 
						Veuillez contacter le webmaster.","nogood timeout");
						$connexion->close();
						header('Location: ajouter-membre');
						exit();
					}
				}else{
					$flash->setFlash("Erreur#2 : Problème lors de l'envoi du mail d'addésion. 
					Veuillez contacter le webmaster.","nogood timeout");
					$connexion->close();
					header('Location: ajouter-membre');
					exit();
				}

				

			}
			
		}


		return $val_retour;
	}

}

?>