<?php

class Database
{

    private $con;

    function __construct()
    {
        $this->con = pg_connect(
            "host=" . DBHOST . " port=" . DBPORT . " dbname=" . DBDATABASE
            . " user=" . DBUSER . " password=" . DBPASS
        );
    }

    public function checkLogin(string $user, string $pass)
    {
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

    public function newUser(string $user, string $pass, string $email)
    {
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

        $sql = <<<SQL
INSERT INTO user_bio_data (size_in_meter, weight_in_kg, name, age_in_years)
VALUES (0, 0, $1, 0)
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute(
            $this->con, "", array($user)
        ))
        ) {
            throw new Exception(pg_last_error());
        }

        return pg_affected_rows($dbres);
    }

    public function changePassword(string $user, string $newPass)
    {
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

    public function getAllArticleGroup()
    {
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

    public function getAllArticles(string $term, int $start, int $limit)
    {
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
                "name" => $data->name,
                "groupName" => $data->group_name,
                "barcode" => $data->barcode,
                "highestPrice" => $data->highest_price,
                "producerName" => $data->producer_name,
                "size" => $data->size,
                "sizeType" => $data->size_type,
                "lastUpdate" => $data->last_update
            ];
        }

        return $return;
    }

    public function getAllArticlesByProducer(string $term)
    {
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
                "name" => $data->name,
                "groupName" => $data->group_name,
                "highestPrice" => $data->highest_price,
                "size" => $data->size,
                "sizeType" => $data->size_type
            ];
        }

        return $return;
    }

    public function getAllArticlesByUser(string $name)
    {
        $sql = <<<SQL
SELECT best_before_date, current_price, article_list.barcode AS barcode, user_name
FROM article_list
JOIN article ON article.barcode = article_list.barcode
WHERE user_name LIKE $1
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute($this->con, "", array($name)))) {
            throw new Exception(pg_last_error());
        }
        $return = array();
        while ($data = pg_fetch_object($dbres)) {
            $return[] = [
                "name" => $data->name,
                "groupName" => $data->group_name,
                "highestPrice" => $data->highest_price,
                "size" => $data->size,
                "sizeType" => $data->size_type
            ];
        }

        return $return;
    }

    public function getAllProducer()
    {
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

    public function getSpecificUser(string $term)
    {
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
                "email" => $data->email,
                "size" => $data->size_in_meter,
                "weight" => $data->weight_in_kg,
                "age" => $data->age_in_years
            ];
        }

        return $return;
    }

    public function changeUserData(string $user, float $size, float $weigth, int $age)
    {
        $sql = <<<SQL
UPDATE user_bio_data
SET size_in_meter = $2, weight_in_kg = $3, age_in_years = $4
WHERE name LIKE $1
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute($this->con, "", array($user, $size, $weigth, $age)))) {
            throw new Exception(pg_last_error());
        }

        return pg_affected_rows($dbres);
    }

    public function changeUserEmail(string $user, string $email)
    {
        $sql = <<<SQL
UPDATE user_data
SET email = $2
WHERE user_name LIKE $1
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute($this->con, "", array($user, $email)))) {
            throw new Exception(pg_last_error());
        }

        return pg_affected_rows($dbres);
    }

    public function changeArticleInventory(string $user, int $count, int $barcode)
    {
        $sql = <<<SQL
UPDATE article_list
SET count = $2
WHERE user_name = $1 AND barcode = $3
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute($this->con, "", array($user, $count, $barcode)))) {
            throw new Exception(pg_last_error());
        }

        return pg_affected_rows($dbres);
    }

    public function insertNewArticle(string $name, string $articleGroup, string $producer, int $barcode, int $size, string $sizeType, float $price)
    {
        $sql = <<<SQL
INSERT INTO article (name, group_name, producer_name, barcode, size, size_type, highest_price)
VALUES ($1, $2, $3, $4, $5, $6, $7)
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute(
            $this->con, "", array($name, $articleGroup, $producer, $barcode, $size, $sizeType, $price)
        ))
        ) {
            throw new Exception(pg_last_error());
        }

        return pg_affected_rows($dbres);
    }

    public function insertArticleInventory(string $user, string $date, float $price, int $count, int $barcode)
    {
        $sql = <<<SQL
INSERT INTO article_list (user_name, best_before_date, current_price, count, barcode)
VALUES ($1, $2, $3, $4, $5)
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute(
            $this->con, "", array($user, $date, $price, $count, $barcode)
        ))
        ) {
            throw new Exception(pg_last_error());
        }

        return pg_affected_rows($dbres);
    }

    public function deleteArticleInventory(string $user, int $barcode)
    {
        $sql = <<<SQL
DELETE FROM article_list WHERE user_name = $1 AND barcode = $2 
SQL;

        if (!(pg_prepare($this->con, "", $sql))) {
            throw new Exception(pg_last_error());
        }
        if (!($dbres = pg_execute(
            $this->con, "", array($user, $barcode)
        ))
        ) {
            throw new Exception(pg_last_error());
        }

        return pg_affected_rows($dbres);
    }
}