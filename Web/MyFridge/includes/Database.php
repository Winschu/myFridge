<?php

class Database {

	private $con;

	function __construct () {
		$this->con = pg_connect("host=" . DBHOST . " port=" . DBPORT . " dbname=" . DBDATABASE . " user=" . DBUSER . " password=" . DBPASS);
	}

	public function checkLogin(string $user, string $pass) {
		if(!(pg_prepare($this->con,"", "SELECT password_hash FROM user_data WHERE user_name LIKE $1"))){
			throw new ErrorException(pg_last_error());
		}
		if(!($dbres = pg_execute($this->con, "", array($user)))) {
			throw new Exception(pg_last_error());
		}
		if(!($res = pg_fetch_assoc($dbres))){
			return false;
		}
		return hash("sha256", $pass) == $res["password_hash"];
	}
}