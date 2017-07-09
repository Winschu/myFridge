<?php

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

global $articleUser, $articleBarcode;

if (isset($_POST["user"]) && isset($_POST["barcode"])) {
    $articleUser = $_POST["user"];
    $articleBarcode = $_POST["barcode"];
} else {
    print "User oder Barcode ist nicht gegeben";
}

$pgCon = pg_connect($dbCon->getDBString());
$result = pg_query($pgCon,
    "DELETE FROM article_list
    WHERE user_name = '$articleUser' AND barcode = '$articleBarcode')"
);
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    print false;
    exit;
} else {
    print true;
}