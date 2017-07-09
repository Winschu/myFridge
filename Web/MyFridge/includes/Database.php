<?php

class Database {

	private $con;

	function __construct () {
		$this->con = pg_connect(
			"host=" . DBHOST . " port=" . DBPORT . " dbname=" . DBDATABASE
			. " user=" . DBUSER . " password=" . DBPASS
		);
	}

	public function checkLogin (string $user, string $pass) {
		$sql = <<<SQL
SELECT password_hash
FROM user_data
WHERE user_name LIKE $1
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute($this->con, "", array($user)))) {
			throw new Exception(pg_last_error());
		}
		if (!($res = pg_fetch_assoc($dbres))) {
			return false;
		}

		return hash("sha256", $pass) == $res["password_hash"];
	}

	public function newUser (string $user, string $pass, string $email) {
		$hash = hash("sha256", $pass);
		$sql = <<<SQL
INSERT INTO user_data (user_name, email, password_hash)
VALUES ($1, $2, $3)
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute(
			$this->con, "", array($user, $email, $hash)
		))
		) {
			throw new Exception(pg_last_error());
		}

		return pg_affected_rows($dbres);
	}

	public function changePassword (string $user, string $newPass) {
		$hash = hash("sha256", $newPass);
		$sql = <<<SQL
UPDATE user_data
SET password_hash = $1
WHERE user_name LIKE $2
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute($this->con, "", array($hash, $user)))) {
			throw new Exception(pg_last_error());
		}

		return pg_affected_rows($dbres);
	}

	public function getAllArticleGroup () {
		$sql = <<<SQL
SELECT name
FROM article_group
ORDER BY name ASC
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute($this->con, "", array()))) {
			throw new Exception(pg_last_error());
		}
		$return = array();
		while ($res = pg_fetch_object($dbres)) {
			$return[] = ["name" => $res->name];
		}

		return $return;
	}

	public function getAllArticles (string $term, int $start, int $limit) {
		$sql = <<<SQL
SELECT *
FROM article
WHERE name LIKE $1
ORDER BY name ASC
LIMIT $3
OFFSET $2
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute(
			$this->con, "", array($term, $start, $limit)
		))
		) {
			throw new Exception(pg_last_error());
		}
		$return = array();
		while ($data = pg_fetch_object($dbres)) {
			$return[] = [
				"name"         => $data->name,
				"groupName"    => $data->group_name,
				"barcode"      => $data->barcode,
				"highestPrice" => $data->highest_price,
				"producerName" => $data->producer_name,
				"size"         => $data->size,
				"sizeType"     => $data->size_type,
				"lastUpdate"   => $data->last_update
			];
		}

		return $return;
	}

	public function getAllArticlesByProducer (string $term) {
		$sql = <<<SQL
SELECT name, group_name, barcode, highest_price, size, size_type
FROM article
WHERE producer_name LIKE $1
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute($this->con, "", array($term)))) {
			throw new Exception(pg_last_error());
		}
		$return = array();
		while ($data = pg_fetch_object($dbres)) {
			$return[] = [
				"name"         => $data->name,
				"groupName"    => $data->group_name,
				"highestPrice" => $data->highest_price,
				"size"         => $data->size,
				"sizeType"     => $data->size_type
			];
		}

		return $return;
	}

	public function getAllArticlesByUser (string $term) {
		$sql = <<<SQL
SELECT best_before_date, current_price, article_list.barcode AS barcode, user_name
FROM article_list
JOIN article ON article.barcode = article_list.barcode
WHERE user_name LIKE $1
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute($this->con, "", array($term)))) {
			throw new Exception(pg_last_error());
		}
		$return = array();
		while ($data = pg_fetch_object($dbres)) {
			$return[] = [
				"name"         => $data->name,
				"groupName"    => $data->group_name,
				"highestPrice" => $data->highest_price,
				"size"         => $data->size,
				"sizeType"     => $data->size_type
			];
		}

		return $return;
	}

	public function getAllProducer () {
		$sql = <<<SQL
SELECT name
FROM producer
ORDER BY name ASC
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute($this->con, "", array()))) {
			throw new Exception(pg_last_error());
		}
		$return = array();
		while ($data = pg_fetch_object($dbres)) {
			$return[] = [
				"name" => $data->name
			];
		}

		return $return;
	}

	public function getSpecificUser (string $term) {
		$sql = <<<SQL
SELECT user_name, email, size_in_meter, weight_in_kg, age_in_years
FROM user_data
JOIN user_bio_data
ON user_data.user_name = user_bio_data.name
WHERE user_name LIKE $1
SQL;

		if (!(pg_prepare($this->con, "", $sql))) {
			throw new Exception(pg_last_error());
		}
		if (!($dbres = pg_execute($this->con, "", array($term)))) {
			throw new Exception(pg_last_error());
		}
		$return = array();
		while ($data = pg_fetch_object($dbres)) {
			$return[] = [
				"username" => $data->user_name,
				"email"    => $data->email,
				"size"     => $data->size_in_meter,
				"weight"   => $data->weight_in_kg,
				"age"      => $data->age_in_years
			];
		}

		return $return;
	}

}