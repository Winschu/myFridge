<?php
header('Content-type: application/json; charset=utf-8');

$con = "host=vps2.white-it.net port=5432 dbname=myfridge user=mbandowski password=TI/%ERebo8ifg8ib6";
$pgCon = pg_connect($con);
$returnValue = [];
$result = pg_query($pgCon, "SELECT * FROM article");
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