<?php  
spl_autoload_register(
	function ($class){
		// NS(namespace) : ORM\Serie\Entity
		// Chemin valide : ORM/Serie/Entity
		$class = strtr($class, "\\",DIRECTORY_SEPARATOR);
		require_once($class.".php");
	}
);
?>