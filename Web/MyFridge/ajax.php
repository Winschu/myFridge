<?php
session_start();

header("Content-type:text/plain; charset=UTF-8");

include "config.php";
include "includes\Database.php";

$db = new Database();

$return = array(
	"action" => "unknown",
	"success" => false
);

$action = @$_GET["action"] ?: "";

switch ($action) {
case "login":
		$return["action"] = $action;
		$result = $db->checkLogin(
			@$_POST["user"] ?: "",
			@$_POST["pass"] ?: ""
		);
		if($result) {
			$return["success"] = $result;
			$_SESSION["user"] = $_POST["user"];
		}
}

echo json_encode($return);