<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputFile extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;

		$widget = isset($this->label)?"<label for=\"$id\" class=\"a-link bold mb0 pt40 m0Auto\">".$this->label."</label>":NULL;
		$widget .= "<span class=\"uploadIcone ";
		$widget .= isset($this->cssUpload)?$this->cssUpload:'';
		$widget .= "\"></span>";

		$widget .= "<input type=\"file\"";

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->css)?" class=\"dpNone ".$this->css."\"":NULL;

		$widget .= ">";

		$widget .= $this->errorMessage;


		return $widget;
	}

}

?>