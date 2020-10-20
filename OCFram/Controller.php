<?php
namespace OCFram;
use Vendors\Nettoyage\Chaine;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;


 class Controller {
 	
 	protected $layout;
 	protected $title;
 	protected $view;
 	protected $description;

 	//GETTERS
 	function getLayout(){
 		return $this->layout;
 	}
 	function getTitle(){
 		return $this->title;
 	}
 	function getView(){
 		return $this->view;
 	}
 	function getDescription(){
 		return $this->description;
 	}
 	//SETTERS
 	function setLayout($nom_template){
 		$this->layout = "templates/".$nom_template."/layout.php";
 	}
 	function setTitle($val){
 		$this->title = $val;
 	}
 	function setView(Array $file){
		$this->view = $file;
 	}
 	function setDescription($desc){
 		$this->description = $desc;
 	}
 	// method personnalisé
 	function getClass(){
 		$nettoyage = new Chaine();
 		$last = substr($this->view["vueMain"],strrpos($this->view["vueMain"],'/')+1);
 		return $nettoyage->clear($last);
 	}
 	// traitement barre de recherche
 	function getSearch($formSearch){
 		if(($formSearch->isSubmit("goSearch"))&&($formSearch->isValid())){
 			$http 		= new HTTPRequest();
			$flash 		= new Flash();
 		}
 	}
 	
 }
?>