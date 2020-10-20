<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class TextArea extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;


		$widget = isset($this->label)?"<label for=\"$id\" class=\"dpNone\">".$this->label."</label>":NULL;

		$widget .= $this->errorMessage;

		$widget .= "<textarea";

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->css)?" class=\"".$this->css."\"":NULL;
		$widget .= isset($this->placeholder)
		?" placeholder=\"".$this->placeholder."\"":NULL;
			
		$widget .= ">";

		$widget .= isset($this->value)?$this->value:NULL;

		$widget .= "</textarea>";



		return $widget;
	}

}

?>