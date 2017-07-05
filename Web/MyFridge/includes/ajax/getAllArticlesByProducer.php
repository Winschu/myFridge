<?php
header('Content-type: application/json; charset=utf-8');

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

$producerName = $_POST["producerName"];

$pgCon = pg_connect($dbCon->getDBString());
$returnValue = [];
$result = pg_query($pgCon, "
SELECT name, group_name, barcode, highest_price, size, size_type
FROM article
WHERE producer_name = '$producerName'
");
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    exit;
}
while ($data = pg_fetch_object($result)) {
    $returnValue[] = [
        "articleName" => $data->name,
        "articleGroup" => $data->group_name,
        "articleHighestPrice" => $data->highest_price,
        "articleSize" => $data->size,
        "articleSizeType" => $data->size_type
    ];
}

print json_encode($returnValue);