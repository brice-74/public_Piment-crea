<?php
namespace ORM\Signal\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Visuel\Model\ManagerVisuel;
use ORM\Signal\Model\ManagerSignal;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Chaine\Entity\Chaine;
use ORM\Tuto\Entity\Tuto;
use ORM\Commentaire\Entity\Commentaire;
use ORM\Signal\Entity\Signal;
use ORM\Visuel\Entity\Visuel;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use DateTime;

class TraitementSignal extends Controller {

	function getResult(){
		$flash		= new Flash();
		$http 		= new HTTPRequest();
		$datas	= $http->getDataPost("datas");
		$comment	= $http->getDataPost("comment",1);

		$cx			= new Connexion();

		if(isset($_SESSION["auth"])){
			if(!empty($comment)){
				$id 		= preg_replace('/^[-a-z]+/', '', $datas);
				$subject = preg_replace('/[-0-9]+$/', '', $datas);

				$managerSignal 	= new ManagerSignal($cx);

				$date 	= new DateTime();
				$date 	= $date->format('Y-m-d H:i:s');

				if($subject == 'visuel'){
					$managerVisu 	= new ManagerVisuel($cx);
					$visu = $managerVisu->selectVisuelById($id);

					if(!is_null($visu)){
						$signal = new Signal(array(
							'commentaire_signal' 			=> $comment,
							'actif_signal' 					=> 1,
							'date_signal' 						=> $date,
							'user_id_user' 					=> intval($_SESSION['auth']['id']),
							'chaine_id_chaine'				=> 'NULL',
							'commentaire_id_commentaire' 	=> 'NULL',
							'visuel_id_visuel' 				=> intval($visu->getIdVisuel()),
							'tuto_id_tuto' 					=> 'NULL'
						)); 
						if($managerSignal->insertSignal($signal)){
							$flash->setFlash("Visuel signalé, merci pour votre aide","good timeout");
							$result['flash'] = $flash->getFlash();
							$result['success'] = 'success';
						}else{
							$flash->setFlash("Erreur#3 : Impossible de signaler le visuel, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}else{
						$flash->setFlash("Erreur#2 : Impossible de signaler le visuel, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}

				}else if($subject == 'tuto'){
					$managerTuto 	= new ManagerTuto($cx);
					$tuto = $managerTuto->selectTutoPostById($id);

					if(!is_null($tuto)){
						$signal = new Signal(array(
							'commentaire_signal' 			=> $comment,
							'actif_signal' 					=> 1,
							'date_signal' 						=> $date,
							'user_id_user' 					=> intval($_SESSION['auth']['id']),
							'chaine_id_chaine'				=> 'NULL',
							'commentaire_id_commentaire' 	=> 'NULL',
							'visuel_id_visuel' 				=> 'NULL',
							'tuto_id_tuto' 					=> intval($tuto->getIdTuto())
						));
						if($managerSignal->insertSignal($signal)){
							$flash->setFlash("Tutoriel signalé, merci pour votre aide","good timeout");
							$result['flash'] = $flash->getFlash();
							$result['success'] = 'success';
						}else{
							$flash->setFlash("Erreur#3 : Impossible de signaler le tutoriel, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}else{
						$flash->setFlash("Erreur#2 : Impossible de signaler le tutoriel, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}

				}else if($subject == 'commentaire'){
					$managerCom 	= new ManagerCommentaire($cx);
					$com = $managerCom->selectComById($id);

					if(!is_null($com)){
						$signal = new Signal(array(
							'commentaire_signal' 			=> $comment,
							'actif_signal' 					=> 1,
							'date_signal' 						=> $date,
							'user_id_user' 					=> intval($_SESSION['auth']['id']),
							'chaine_id_chaine'				=> 'NULL',
							'commentaire_id_commentaire' 	=> intval($com->getIdCommentaire()),
							'visuel_id_visuel' 				=> 'NULL',
							'tuto_id_tuto' 					=> 'NULL'
						)); 
						if($managerSignal->insertSignal($signal)){
							$flash->setFlash("Commentaire signalé, merci pour votre aide","good timeout");
							$result['flash'] = $flash->getFlash();
							$result['success'] = 'success';
						}else{
							$flash->setFlash("Erreur#3 : Impossible de signaler le commentaire, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}else{
						$flash->setFlash("Erreur#2 : Impossible de signaler le commentaire, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}

				}else if($subject == 'chaine'){
					$managerChaine 	= new ManagerChaine($cx);
					$chaine = $managerChaine->selectChaineById($id);

					if(!is_null($chaine)){
						$signal = new Signal(array(
							'commentaire_signal' 			=> $comment,
							'actif_signal' 					=> 1,
							'date_signal' 						=> $date,
							'user_id_user' 					=> intval($_SESSION['auth']['id']),
							'chaine_id_chaine'				=> intval($chaine->getIdChaine()),
							'commentaire_id_commentaire' 	=> 'NULL',
							'visuel_id_visuel' 				=> 'NULL',
							'tuto_id_tuto' 					=> 'NULL'
						)); 
						if($managerSignal->insertSignal($signal)){
							$flash->setFlash("Chaine signalé, merci pour votre aide","good timeout");
							$result['flash'] = $flash->getFlash();
							$result['success'] = 'success';
						}else{
							$flash->setFlash("Erreur#3 : Impossible de signaler le chaine, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}else{
						$flash->setFlash("Erreur#2 : Impossible de signaler le chaine, veuillez contacter le webmaster","nogood timeout");
						$result['flash'] = $flash->getFlash();
					}

				}else{
					$flash->setFlash("Erreur#1 : Impossible de signaler le contenu, veuillez contacter le webmaster","nogood timeout");
					$result['flash'] = $flash->getFlash();
				}
			}else{
				$flash->setFlash("Votre expliquation de signalement est vide","normal timeout");
				$result['flash'] = $flash->getFlash();
			}
			
		}else{
			$flash->setFlash("Créez un compte pour signaler un contenu indésirable","normal timeout");
			$result['flash'] = $flash->getFlash();
		}

		echo json_encode($result);
		$cx->close();
	}
}
?>