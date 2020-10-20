<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputText extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;


		$widget = isset($this->label)?"<label class=\"dpNone\" for=\"$id\">".$this->label."</label>":NULL;

		$widget .= $this->errorMessage;

		$widget .= "<input type=\"text\"";

		$widget .= isset($this->placeholder)
		?" placeholder=\"".$this->placeholder."\"":NULL;
		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->css)?" class=\"".$this->css."\"":NULL;
		$widget .= isset($this->value)?" value=\"".$this->value."\"":NULL;

		$widget .= ">";


		return $widget;
	}

}

?>