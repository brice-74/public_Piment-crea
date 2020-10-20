<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;

use ORM\Tuto\Entity\Tuto;

use OCFram\HTTPRequest;

use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadMaxSizeValidator;
use Vendors\Validator\UploadTypeValidator;


class FormImageTuto extends Form {

	function buildForm($tuto){
		$http = new HTTPRequest();
		$visu = $tuto->getVisuelTuto();
		if(!is_null($visu)){
			$cssUpload = 'complete';
		}else{
			$cssUpload = '';
		}

		$this->add(new InputFile([
			"label" 		=> "Choisir&nbsp;un&nbsp;visuel",
			"name" 			=> "visuel_tuto",
			"css" 			=> "champ",
			"cssUpload"		=> $cssUpload
		]));
		
		return $this;

	}
}
?>