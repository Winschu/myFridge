<?php
header('Content-type: application/json; charset=utf-8');

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

$startPos = $_POST["startPos"];
$rowCount = $_POST["rowCount"];

$pgCon = pg_connect($dbCon->getDBString());
$returnValue = [];
$result = pg_query($pgCon, "SELECT * FROM article ORDER BY name ASC LIMIT $rowCount");
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    exit;
}
while ($data = pg_fetch_object($result)) {
    $returnValue[] = [
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

print json_encode($returnValue);