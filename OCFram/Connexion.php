<?php
namespace OCFram;
use MySQLi;

class Connexion extends MySQLi{
	private $host		= "db348327-pimentcrea.sql-pro.online.net";
	private $login		= "db116649";
	private $pass		= "2f!D.CQYt!dGD2P";
	private $bdd		= "db348327_pimentcrea";
	private $mysqli;

	function __construct(){
		$this->mysqli = @parent::__construct(
			$this->host,
			$this->login,
			$this->pass,
			$this->bdd
		);
		
		if($this->connect_errno){var_dump($this->connect_errno);
			die("service indisponible");
		}else{
			$this->set_charset("utf8");
		}
	}
}
?>