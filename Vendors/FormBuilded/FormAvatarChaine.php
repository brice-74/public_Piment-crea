<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\ButtonSubmit;

use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadMaxSizeValidator;
use Vendors\Validator\UploadTypeValidator;

use OCFram\HTTPRequest;


class FormAvatarChaine extends Form {

	function buildForm(){
		$http = new HTTPRequest();

		$this->add(new InputFile([
			"label" 		=> "Choisir un avatar",
			"name" 			=> "avatar_chaine",
			"css" 			=> "champ",
			"validators" 	=> [
				new UploadCodeValidator(
					"Upload impossible",
					$http->getDataFiles("avatar_chaine","error")
				),
				new UploadTypeValidator(
					"Veuillez choisir un format jpg ou png",
					$http->getDataFiles("avatar_chaine","type"),
					["image/jpeg","image/png"]
				),
				new UploadMaxSizeValidator(
					"Sélectionnez un fichier inférieur à 2 Mo",
					$http->getDataFiles("avatar_chaine","size")
				)
			]
		]));


		$this->add(new ButtonSubmit([
			"name" 			=> "go2",
			"css" 			=> "btnV",
			"value" 		=> "Charger le fichier",
			"contenu_btn"	=> "<p class=\"txt14\">Charger</p>"
		]));


		return $this;
	}
}

?>