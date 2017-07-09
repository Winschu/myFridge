<?php

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

$articleName = $_POST["name"];
$articleGroup = $_POST["articleGroup"];
$articleProducer = $_POST["producer"];
$articleBarcode = $_POST["barcode"];
$articleSize = $_POST["size"];
$articleSizeType = $_POST["sizeType"];
$articlePrice = $_POST["price"];

$pgCon = pg_connect($dbCon->getDBString());
$returnValue = [];
$result = pg_query($pgCon,
    "INSERT INTO article
(name, 
group_name, 
barcode, 
producer_name, 
size, 
size_type,
highest_price
) 
VALUES 
(
'$articleName', 
'$articleGroup', 
'$articleBarcode',
'$articleProducer',
'$articleSize',
'$articleSizeType',
'$articlePrice'
)"
);
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    print false;
    exit;
}
else{
    print true;
}