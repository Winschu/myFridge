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

	public function newUser(string $user, string $pass, string $email){
		$hash = hash("sha256", $pass);
		if(!(pg_prepare($this->con,"", "INSERT INTO user_data (user_name, email, password_hash) VALUES $1, $2, $3"))){
			throw new ErrorException(pg_last_error());
		}
		if(!($dbres = pg_execute($this->con, "", array($user, $email, $hash)))) {
			throw new Exception(pg_last_error());
		}
		return pg_affected_rows($dbres);
	}

	public function changePassword(string $user, string $newPass){
		$hash = hash("sha256", $newPass);
		if(!(pg_prepare($this->con,"", "UPDATE user_data SET password_hash = $1 WHERE user_name LIKE $2"))){
			throw new ErrorException(pg_last_error());
		}
		if(!($dbres = pg_execute($this->con, "", array($hash, $user)))) {
			throw new Exception(pg_last_error());
		}
		return pg_affected_rows($dbres);
	}


}