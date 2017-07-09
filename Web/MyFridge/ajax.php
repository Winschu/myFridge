<?php
header("Content-type: application/json; charset=UTF-8");

require_once("config.php");
require_once("includes\Database.php");

$db = new Database();

$return = array(
    "action" => "unknown",
    "success" => false
);

$action = @$_GET["action"] ?: "";

switch ($action) {
    case "login":
        $return["action"] = $action;
        try {
            $result = $db->checkLogin(
                @$_POST["user"] ?: "",
                @$_POST["pass"] ?: ""
            );
            if ($result) {
                $return["success"] = $result;
                $_SESSION["user"] = $_POST["user"];
            }
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "logout":
        $return["action"] = $action;
        session_destroy();
		$return["success"] = true;
        break;
    case "register":
        $return["action"] = $action;
        try {
            $result = $db->newUser(
                @$_POST["user"] ?: "",
                @$_POST["pass"] ?: "",
                @$_POST["email"] ?: ""
            );
            if ($result) {
                $return["success"] = $result;
            }
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "sessionState":
        $return["action"] = $action;
        if (isset($_SESSION["user"])) {
            $return["success"] = true;
        }
        break;
    case "getAllArticleGroup":
        $return["action"] = $action;
        try {
            $return["data"] = $db->getAllArticleGroup();
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "getAllArticles":
        $return["action"] = $action;
        try {
            $return["data"] = $db->getAllArticles(
                @$_POST["searchTerm"] ? "%" . $_POST["searchTerm"] . "%" : "%",
                @$_POST["startPos"] ?: 0,
                @$_POST["rowCount"] ?: 30
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "getAllArticlesByProducer":
        $return["action"] = $action;
        try {
            $return["data"] = $db->getAllArticlesByProducer(
                @$_POST["producerName"] ?: "%"
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "getAllArticlesByUser":
        $return["action"] = $action;
        try {
            $return["data"] = $db->getAllArticlesByUser(
                @$_POST["name"] ?: "%"
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "getAllProducer":
        $return["action"] = $action;
        try {
            $return["data"] = $db->getAllProducer();
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "getSpecificUser":
        $return["action"] = $action;
        try {
            $return["data"] = $db->getSpecificUser(
                @$_POST["term"] ?: "%"
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "changeUserData":
        $return["action"] = $action;
        try {
            $return["data"] = $db->changeUserData(
                @$_POST["user"] ?: "",
                @$_POST["size"] ?: 0,
                @$_POST["weigth"] ?: 0,
                @$_POST["age"] ?: 0
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "changeUserEmail":
        $return["action"] = $action;
        try {
            $return["data"] = $db->changeUserEmail(
                @$_POST["user"] ?: "",
                @$_POST["email"] ?: ""
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "changeArticleInventory":
        $return["action"] = $action;
        try {
            $return["data"] = $db->changeArticleInventory(
                @$_POST["user"] ?: "",
                @$_POST["count"] ?: "",
                    @$_POST["barcode"] ?: ""
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "insertNewArticle":
        $return["action"] = $action;
        try {
            $return["data"] = $db->insertNewArticle(
                @$_POST["name"] ?: "",
                @$_POST["articleGroup"] ?: "",
                @$_POST["producer"] ?: "",
                @$_POST["barcode"] ?: "",
                @$_POST["size"] ?: 0,
                @$_POST["sizeType"] ?: "",
                @$_POST["price"] ?: 0
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "InsertArticleInventory":
        $return["action"] = $action;
        try {
            $return["data"] = $db->insertArticleInventory(
                @$_POST["name"] ?: "",
                @$_POST["date"] ?: "",
                @$_POST["price"] ?: 0,
                @$_POST["count"] ?: 0,
                @$_POST["barcode"] ?: 0
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
    case "deleteArticleInventory":
        $return["action"] = $action;
        try {
            $return["data"] = $db->deleteArticleInventory(
                @$_POST["user"] ?: "",
                @$_POST["barcode"] ?: 0
            );
            $return["success"] = true;
        } catch (Exception $e) {
            $return["errorMsg"] = $e->getMessage();
        }
        break;
}

echo json_encode($return);