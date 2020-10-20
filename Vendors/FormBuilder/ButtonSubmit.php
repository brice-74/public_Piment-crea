<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class ButtonSubmit extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;

		$widget = "<button type=\"submit\"";

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->css)?" class=\"".$this->css."\"":NULL;
		$widget .= isset($this->value)?" value=\"".$this->value."\"":NULL;

		$widget .= ">";
		$widget .= isset($this->contenu_btn)? $this->contenu_btn:NULL;
		$widget .= "</button>";


		return $widget;
	}

}

?>