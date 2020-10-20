<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;

use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\ButtonSubmit;

use Vendors\Validator\VideValidator;

class FormSearch extends Form {

	function buildForm(){
		$this->add(new InputText([
			"label" 		=> "Votre recherche :",
			"name" 			=> "search",
			"css" 			=> "field",
			"placeholder"	=> "Rechercher une chaine ou un tutoriel",
		]));


		$this->add(new ButtonSubmit([
			"name" 			=> "goSearch",
			"value" 		=> "recherche",
			"contenu_btn"	=> "
			<div>
				<svg version=\"1.1\" viewBox=\"0 0 25 25\" xml:space=\"preserve\">
					<path class=\"st0\" d=\"M21.2,19.8l-4.4-4.4c0.9-1.2,1.5-2.7,1.5-4.4c0-4-3.3-7.3-7.3-7.3s-7.3,3.3-7.3,7.3s3.3,7.3,7.3,7.3
					c1.6,0,3.1-0.5,4.3-1.4l4.5,4.5c0.1,0.1,0.3,0.3,0.8,0.3c0.4,0,0.6-0.2,0.8-0.3c0.2-0.2,0.3-0.5,0.3-0.8
					C21.5,20.2,21.4,20,21.2,19.8z M11,5.8c2.9,0,5.2,2.3,5.2,5.2s-2.3,5.2-5.2,5.2c-2.9,0-5.2-2.3-5.2-5.2S8.1,5.8,11,5.8z\"/>
				</svg>
			</div>",
		]));

		return $this;

	}

}

?>