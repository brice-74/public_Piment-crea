<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputRadio extends Field {

	function getWidget(){
		
		$id = (isset($this->id))?$this->id:$this->name;

		$widget = $this->errorMessage;

		$widget .= "<input type=\"radio\"";

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->css)?" class=\"".$this->css."\"":NULL;
		$widget .= isset($this->value)?" value=\"".$this->value."\"":NULL;
		$widget .= ($this->selected === TRUE)?" checked":NULL;

		$widget .= ">";

		$widget .= isset($this->label)?" <label for=\"$id\">".$this->label."</label>":NULL;

		
		return $widget;
	}

}

?>