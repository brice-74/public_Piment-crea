<?php
namespace OCFram;

class HTTPRequest {

	function getUri() {
		return htmlspecialchars(strip_tags($_SERVER["REQUEST_URI"]));
	}

	function getDataPost($nom,$security=3){
		if($security === 3){
			return isset($_POST[$nom]) 
			? htmlspecialchars(strip_tags(trim($_POST[$nom]))) : NULL;

		}else if($security === 2){
			return isset($_POST[$nom]) 
			? htmlspecialchars(trim($_POST[$nom])) : NULL;

		}else if($security === 1) {
			return isset($_POST[$nom]) 
			? trim($_POST[$nom]) : NULL;
		}
	}

	function postExist($nom){
		return isset($_POST[$nom]);
	}

	function getMultiChoiceData($pattern,$cellule){
		$values = [];
		foreach ($_POST as $cle => $value) {
			if(preg_match($cellule,$cle)){
				foreach ($_POST[$cle] as $key => $value) {
					$values[] = preg_replace("/^[a-z]+-/", "", $value);
				}
			}
		}
		return $values;
	}

	function getDataGet($nom){
		return isset($_GET[$nom]) 
		? htmlspecialchars(strip_tags(trim($_GET[$nom]))) : NULL;
	}

	function getDataFiles($nom,$key=NULL){
		if(is_null($key)){
			return isset($_FILES[$nom])?$_FILES[$nom]:NULL;
		}else{
			return isset($_FILES[$nom][$key])?$_FILES[$nom][$key]:NULL;
		}
	}

}
?>