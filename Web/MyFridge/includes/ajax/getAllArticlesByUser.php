<?php
header('Content-type: application/json; charset=utf-8');

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

$userName = $_POST["name"];

$pgCon = pg_connect($dbCon->getDBString());
$returnValue = [];
$result = pg_query($pgCon, "
SELECT best_before_date, current_price, article_list.barcode AS barcode, user_name
FROM article_list
JOIN article ON article.barcode = article_list.barcode
WHERE user_name = '$userName'
");
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    exit;
}
while ($data = pg_fetch_object($result)) {
    $returnValue[] = [
        "name" => $data->name,
        "groupName" => $data->group_name,
        "highestPrice" => $data->highest_price,
        "size" => $data->size,
        "sizeType" => $data->size_type
    ];
}

print json_encode($returnValue);