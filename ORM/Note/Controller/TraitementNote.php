<?php
namespace ORM\Note\Controller;
use OCFram\Controller;
use OCFram\Connexion;

use ORM\Note\Model\ManagerNote;
use ORM\Note\Entity\Note;
use ORM\Tuto\Model\ManagerTuto;
use ORM\Tuto\Entity\Tuto;

use Vendors\Flash\Flash;
use OCFram\HTTPRequest;

use DateTime;


class TraitementNote extends Controller {

	function getResult(){
		$result = [];
		$flash		= new Flash();
		$http 		= new HTTPRequest();

		$id_tuto		= $http->getDataPost("tuto");
		$val_note	= $http->getDataPost("note");

		$cx				= new Connexion();
		$manager_note 	= new ManagerNote($cx);
		$manager_tuto 	= new ManagerTuto($cx);

		$date 	= new DateTime();
		$date 	= $date->format('Y-m-d H:i:s');

		if((!is_numeric($val_note))||($val_note > 10)){
			$flash->setFlash("Erreur#3 : Impossible de noter le tutoriel, veuillez contacter le webmaster","nogood timeout");
			$result['flash'] = $flash->getFlash();
		}else{
			if(isset($_SESSION['auth'])){
				$tuto = $manager_tuto->selectTutoPostById($id_tuto);

				if(!is_null($tuto)){
					$note = $manager_note->issetNote($tuto->getIdTuto(),$_SESSION["auth"]["id"]);

					if(is_null($note)){
						$note = new Note(array(
							"post_note" 	=> $val_note,
							"date_note" 	=> $date,
							"user_id_user"	=> $_SESSION["auth"]["id"],
							"tuto_id_tuto"	=> $tuto->getIdTuto()
						));

						if($manager_note->insertNote($note)){
							$result['val_note'] = $note->getPostNote();
							$tableau = $manager_note->countAndSumNoteByTuto($tuto->getIdTuto());
							$moy = $tableau['sumNote'] / $tableau['countNote'];
							$result["moy"] = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;

						}else{
							$flash->setFlash("Erreur#2 : Impossible de noter le tutoriel, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}

					}else{
						$note->setDateNote($date);
						$note->setPostNote($val_note);

						if($manager_note->updateNote($note)){
							$result['val_note'] = $note->getPostNote();
							$tableau = $manager_note->countAndSumNoteByTuto($tuto->getIdTuto());
							$moy = $tableau['sumNote'] / $tableau['countNote'];
							$result["moy"] = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;
						}else{
							$flash->setFlash("Erreur#4 : Impossible de noter le tutoriel, veuillez contacter le webmaster","nogood timeout");
							$result['flash'] = $flash->getFlash();
						}
					}

				}else{
					$flash->setFlash("Erreur#1 : Impossible de noter le tutoriel, veuillez contacter le webmaster","nogood timeout");
					$result['flash'] = $flash->getFlash();
				}

			}else{
				$flash->setFlash("Veuillez créer un compte pour laisser une note","normal timeout");
				$result['flash'] = $flash->getFlash();
			}
		}

		$cx->close();
		echo json_encode($result);
	}
}
?>