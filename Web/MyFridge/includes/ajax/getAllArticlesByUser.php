<?php
header('Content-type: application/json; charset=utf-8');

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

global $userName;

if(isset($_POST["name"])) {
    $userName = $_POST["name"];
}
else{
    print "Benutzername ist nicht gegeben!";
}


$pgCon = pg_connect($dbCon->getDBString());
$returnValue = [];
$result = pg_query($pgCon, "
SELECT *
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
        "producerName" => $data->producer_name,
        "barcode" => $data->barcode,
        "size" => $data->size,
        "sizeType" => $data->size_type,
        "date" => $data->best_before_date,
        "count" => $data->count,
        "price" => $data->current_price
    ];
}

print json_encode($returnValue);