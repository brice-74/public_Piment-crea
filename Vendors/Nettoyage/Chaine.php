<?php
namespace Vendors\Nettoyage;

class Chaine {

	function clear($chaine,$marquage=FALSE){
		//Conversion en caractères non accentués
		//setlocale(LC_CTYPE, 'cs_CZ');
		$chaine = iconv("UTF-8", "ASCII//TRANSLIT", $chaine);

		//Rempacement des espaces par des tirets
		$chaine = str_replace(' ', '-', $chaine);
		
		$chaine = preg_replace("/.php/",'',$chaine);

		//On ne garde que A-Za-z0-9-._
		//Précisément le ^ DANS [^] = les caractères à préserver, les autres supprimés
		$chaine = preg_replace("/[^A-Za-z0-9-._]/",'',$chaine);

		//Passage en minuscules
		$chaine = strtolower($chaine);

		//supprimer les multi ---
		$chaine = preg_replace("/(-)+/", "-", $chaine);

		//Si marquage demandé
		if($marquage){
			$chaine = uniqid()."-".$chaine;
		}

		return $chaine;
	}
}
?>