<?php
namespace Vendors\File;
use Vendors\Nettoyage\Chaine;


class Uploader {

	private $file;
	private $name;
	private $tmp_name;
	private $destination;

	function __construct($fichier,$destination){
		$this->file 		= $fichier;
		$this->name 		= $fichier["name"];
		$this->tmp_name 	= $fichier["tmp_name"];
		$this->destination 	= $destination;
	}


	function upload(){
		$nettoyage_chaine 	= new Chaine();
		$this->name = $nettoyage_chaine->clear($this->name,TRUE);

		if(is_uploaded_file($this->tmp_name)){

			if(
				move_uploaded_file(
					$this->tmp_name,
					$this->destination.$this->name
				)
			){
				return $this->name;
			}else{
				return NULL;
			}
		}
	}

	function copyMin(){
		list($largeur,$hauteur,$typefile,$attr) = 
		getimagesize($this->destination.$this->name);

		$new_largeur = 600;
		$new_hauteur = ($new_largeur * $hauteur) / $largeur;

		$crea = imagecreatetruecolor($new_largeur,$new_hauteur);

		if($typefile == 2){
			$copie = imagecreatefromjpeg($this->destination.$this->name);
			$erase = "imagejpeg";
		}else if($typefile == 3){
			$copie = imagecreatefrompng($this->destination.$this->name);
			$erase = "imagepng";
		}else {
			$copie = imagecreatefromjpeg($this->destination.$this->name);
			$erase = "imagejpeg";
		}

		if(imagecopyresampled(
			$crea,
			$copie,
			0,0,0,0,
			$new_largeur,
			$new_hauteur,
			$largeur,
			$hauteur
		)){
			if($typefile == 3){
				imagepng($crea, $this->destination.'min-'.$this->name);
			}else{
				imagejpeg($crea, $this->destination.'min-'.$this->name);
			}
			imagedestroy($copie);
		}
	}

	function imageSizing($new_largeur){
		//Le redimensionnement ne se fait pas durant l'upload
		//car on peut avoir envie d'uploader un PDF par ex.
		//ce qui ne suppose pas de redimensionnement
		//On travaille donc sur l'image qui a été move_uploaded_file()

		list($largeur,$hauteur,$typefile,$attr) = 
		getimagesize($this->destination.$this->name);

		if($largeur > $new_largeur){
			$new_hauteur = ($new_largeur * $hauteur) / $largeur;

			//Créons un fichier vide à la bonne taille
			$crea = imagecreatetruecolor($new_largeur,$new_hauteur);

			//Pour ne pas endommager l'image d'origine au cas où le
			//redimensionnement planterait
			//Je vais travailler sur une copie de l'originale
			if($typefile == 2){
				$copie = imagecreatefromjpeg($this->destination.$this->name);
				$erase = "imagejpeg";
			}else if($typefile == 3){
				$copie = imagecreatefrompng($this->destination.$this->name);
				$erase = "imagepng";
			}else {
				$copie = imagecreatefromjpeg($this->destination.$this->name);
				$erase = "imagejpeg";
			}


			//Rééchantillonage de copie dans crea
			if(imagecopyresampled(
				$crea,
				$copie,
				0,0,0,0,
				$new_largeur,
				$new_hauteur,
				$largeur,
				$hauteur
			)){
				//J'écrase l'original par crea
				if($erase($crea,$this->destination.$this->name)){
					//Et je détruis la copie temporaire
					imagedestroy($copie);
				}
			}
		}
	}



}
?>