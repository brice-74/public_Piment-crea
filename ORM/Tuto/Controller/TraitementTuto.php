<?php
namespace ORM\Tuto\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Tuto\Model\ManagerTuto;
use ORM\Theme\Model\ManagerTheme;
use ORM\Logiciel\Model\ManagerLogiciel;
use ORM\Language\Model\ManagerLanguage;

use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use OCFram\HTTPRequest;


class TraitementTuto extends Controller {

	function getResult(){
		$result = [];
		$flash		= new Flash();
		$http 		= new HTTPRequest();

		$titre	= $http->getDataPost("titre");
		$visuel	= $http->getDataFiles("file");
		$cat		= $http->getDataPost("cat");
		$id_tuto		= $http->getDataPost("id_tuto");

		$cx			= new Connexion();
		$manager_tuto 	= new ManagerTuto($cx);

		$tuto = $manager_tuto->selectTutoById($id_tuto);

		if(!is_null($tuto)){
			if(!is_null($titre)){
				$old_titre = $tuto->getTitreTuto();
				$tuto->setTitreTuto($titre);

				if($old_titre != $titre){
					if($manager_tuto->updateTitreTuto($tuto) == false){
						$flash->setFlash("Erreur : Impossible de changer l'intitulé, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}else{
						$result['good'] = 'good';
					}
				}else{
					$result['good'] = 'repeat';
				}
			
			}

			if(!is_null($visuel)){
				$destination = 'medias/chaine/id-'.$_SESSION["authChaine"]["id"].'/tuto-'.$id_tuto.'/';

				if(!is_dir($destination)){
					mkdir($destination, 0777,TRUE);
				}
				$uploader 	 = new Uploader($visuel,$destination);
				$visuel_tuto 	 = $uploader->upload();

				if(!is_null($visuel_tuto)){
					$uploader->copyMin();
					$uploader->imageSizing(2100);
					$tuto->setVisuelTuto($visuel_tuto);
					if($manager_tuto->updateVisuelTuto($tuto)){
						$result['visu'] = $visuel_tuto;
						$result['id_tuto'] = $tuto->getIdTuto();
						$result['id_chaine'] = $_SESSION['authChaine']['id'];
					}else{
						$flash->setFlash("Erreur#2 : Impossible de changer l'image, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}
				}else{
					$flash->setFlash("Erreur#1 : Impossible de changer l'image, veuillez contacter le webmaster","nogood timeout");
					$result['flash'] = $flash->getFlash();
				}
			}

			if(!is_null($cat)){
				$tab = explode(',', $cat);
				$error = 0;
				foreach ($tab as $val) {
					if((!preg_match('/^theme-[0-9]/', $val))||(!preg_match('/^logiciel-[0-9]/', $val))||(!preg_match('/^language-[0-9]/', $val))){
						$error++;
					}
				}
				if($error != 0){
					foreach ($tab as $val) {
						if(preg_match('/^theme-[0-9]+$/', $val)){
							$theme['remove'][] = preg_replace("/[a-zA-Z\W]+/","",$val);
						}else if(preg_match('/^theme-[0-9]+\/selected$/', $val)){
							$theme['add'][] = preg_replace("/[a-zA-Z\W]+/","",$val);
						}

						if(preg_match('/^logiciel-[0-9]+$/', $val)){
							$logiciel['remove'][] = preg_replace("/[a-zA-Z\W]+/","",$val);
						}else if(preg_match('/^logiciel-[0-9]+\/selected$/', $val)){
							$logiciel['add'][] = preg_replace("/[a-zA-Z\W]+/","",$val);
						}

						if(preg_match('/^language-[0-9]+$/', $val)){
							$language['remove'][] = preg_replace("/[a-zA-Z\W]+/","",$val);
						}else if(preg_match('/^language-[0-9]+\/selected$/', $val)){
							$language['add'][] = preg_replace("/[a-zA-Z\W]+/","",$val);
						}
					}

					$manager_theme 		= new ManagerTheme($cx);
					$manager_logiciel 	= new ManagerLogiciel($cx);
					$manager_language 	= new ManagerLanguage($cx);

					if(isset($theme)){
						if(isset($theme['remove'])){
							$error = 0;
							foreach ($theme['remove'] as $id) {
								if($manager_theme->issetTutoHasTheme($tuto->getIdTuto(),$id)){
									if($manager_theme->removeTutoHasTheme($tuto->getIdTuto(),$id) == false){
										$error++;
									}
								}
							}
							if($error > 0){
								if($error == 1){
									$flash->setFlash("Erreur#3 : Une erreur s'est produite, veuillez contacter le webmaster","nogood timeout");
								}else{
									$flash->setFlash("Erreur#3 : ".$error." erreurs se sont produites, veuillez contacter le webmaster","nogood timeout");
								}
								$result['flash'] = $flash->getFlash();
							}
						}
						if(isset($theme['add'])){
							$error = 0;
							foreach ($theme['add'] as $id) {
								if($manager_theme->issetTutoHasTheme($tuto->getIdTuto(),$id) == false){
									if($manager_theme->insertTutoHasTheme($tuto->getIdTuto(),$id) == false){
										$error++;
									}
								}
							}
							if($error > 0){
								if($error == 1){
									$flash->setFlash("Erreur#4 : Une erreur s'est produite, veuillez contacter le webmaster","nogood timeout");
								}else{
									$flash->setFlash("Erreur#4 : ".$error." erreurs se sont produites, veuillez contacter le webmaster","nogood timeout");
								}
								$result['flash'] = $flash->getFlash();
							}
						}
					}
					if(isset($logiciel)){
						if(isset($logiciel['remove'])){
							$error = 0;
							foreach ($logiciel['remove'] as $id) {
								if($manager_logiciel->issetTutoHasLogiciel($tuto->getIdTuto(),$id)){
									if($manager_logiciel->removeTutoHasLogiciel($tuto->getIdTuto(),$id) == false){
										$error++;
									}
								}
							}
							if($error > 0){
								if($error == 1){
									$flash->setFlash("Erreur#5 : Une erreur s'est produite, veuillez contacter le webmaster","nogood timeout");
								}else{
									$flash->setFlash("Erreur#5 : ".$error." erreurs se sont produites, veuillez contacter le webmaster","nogood timeout");
								}
								$result['flash'] = $flash->getFlash();
							}
						}
						if(isset($logiciel['add'])){
							$error = 0;
							foreach ($logiciel['add'] as $id) {
								if($manager_logiciel->issetTutoHasLogiciel($tuto->getIdTuto(),$id) == false){
									if($manager_logiciel->insertTutoHasLogiciel($tuto->getIdTuto(),$id) == false){
										$error++;
									}
								}
							}
							if($error > 0){
								if($error == 1){
									$flash->setFlash("Erreur#6 : Une erreur s'est produite, veuillez contacter le webmaster","nogood timeout");
								}else{
									$flash->setFlash("Erreur#6 : ".$error." erreurs se sont produites, veuillez contacter le webmaster","nogood timeout");
								}
								$result['flash'] = $flash->getFlash();
							}
						}
					}
					if(isset($language)){
						if(isset($language['remove'])){
							$error = 0;
							foreach ($language['remove'] as $id) {
								if($manager_language->issetTutoHasLanguage($tuto->getIdTuto(),$id)){
									if($manager_language->removeTutoHasLanguage($tuto->getIdTuto(),$id) == false){
										$error++;
									}
								}
							}
							if($error > 0){
								if($error == 1){
									$flash->setFlash("Erreur#7 : Une erreur s'est produite, veuillez contacter le webmaster","nogood timeout");
								}else{
									$flash->setFlash("Erreur#7 : ".$error." erreurs se sont produites, veuillez contacter le webmaster","nogood timeout");
								}
								$result['flash'] = $flash->getFlash();
							}
						}
						if(isset($language['add'])){
							$error = 0;
							foreach ($language['add'] as $id) {
								if($manager_language->issetTutoHasLanguage($tuto->getIdTuto(),$id) == false){
									if($manager_language->insertTutoHasLanguage($tuto->getIdTuto(),$id) == false){
										$error++;
									}
								}
							}
							if($error > 0){
								if($error == 1){
									$flash->setFlash("Erreur#8 : Une erreur s'est produite, veuillez contacter le webmaster","nogood timeout");
								}else{
									$flash->setFlash("Erreur#8 : ".$error." erreurs se sont produites, veuillez contacter le webmaster","nogood timeout");
								}
								$result['flash'] = $flash->getFlash();
							}
						}
					}
				}else{

				}
			}

		}else{
			$flash->setFlash("Erreur : Impossible de modifier le tutoriel, veuillez contacter le webmaster","nogood timeout");
			$result['flash'] = $flash->getFlash();
		}
		$cx->close();
		echo json_encode($result);
	}
}
?>