<?php
header('Content-type: application/json; charset=utf-8');

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

$pgCon = pg_connect($dbCon->getDBString());
$returnValue = [];
$result = pg_query($pgCon, "SELECT name FROM producer ORDER BY name ASC");
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    exit;
}
while ($data = pg_fetch_object($result)) {
    $returnValue[] = [
        "name" => $data->name
    ];
}

print json_encode($returnValue);