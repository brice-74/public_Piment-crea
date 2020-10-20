<?php
namespace Vendors\Flash;

class Flash {

	function setFlash($message,$class){
		$_SESSION["flash"] = [$message,$class];
	}

	function getFlash(){
		if(isset($_SESSION["flash"])){
			$flash = $_SESSION["flash"];
			unset($_SESSION["flash"]);
			return "<div class=\"feedback ".$flash[1]."\"><p>".$flash[0]."</p></div>";
		}
	}
}
?>