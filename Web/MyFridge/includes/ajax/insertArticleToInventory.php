<?php

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

global $articleUser, $articleBarcode, $articleCount, $articleDate, $articlePrice;

if(isset($_POST["user"]) && isset($_POST["barcode"])) {
    $articleUser = $_POST["user"];
    $articleBarcode = $_POST["barcode"];
    $articlePrice = $_POST["price"];
    $articleCount = $_POST["count"];
    $articleDate = $_POST["date"];
}
else
{
    print "User oder Barcode ist nicht gegeben";
}

$pgCon = pg_connect($dbCon->getDBString());
$result = pg_query($pgCon,
    "INSERT INTO article_list
(best_before_date,
current_price,
barcode,
user_name,
count
) 
VALUES 
(
'$articleDate', 
'$articlePrice', 
'$articleBarcode',
'$articleUser',
'$articleCount'
)"
);
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    exit;
}
else
{
    print true;
}