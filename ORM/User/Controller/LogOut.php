<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use Vendors\Flash\Flash;


class LogOut extends Controller {	
	
	function getResult(){
		$flash = new Flash();

		$flash->setFlash("Vous êtes déconnecté de votre profil ".$_SESSION["auth"]["nom"]." ".$_SESSION["auth"]["prenom"] , "good timeout");

		unset($_SESSION["auth"]);
		if(isset($_SESSION["authChaine"])){
			unset($_SESSION["authChaine"]);
		}
		if(isset($_SESSION["page"])){
			unset($_SESSION["page"]);
		}
		
		/*session_unset();
		session_destroy();*/
		
		header("Location: index");
		exit();
	}
	
}
?>