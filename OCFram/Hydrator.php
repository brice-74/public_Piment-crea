<?php
namespace OCFram;
trait Hydrator {
	function hydrate(Array $array){
		foreach($array as $key => $value){
			$this->$key = $value;
		}
	}
}
?>