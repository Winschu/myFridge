<?php
header('Content-type: application/json; charset=utf-8');

require_once("../dbCredentials.php");

$dbCon = new dbCredentials();

$userName = $_POST["userName"];

$pgCon = pg_connect($dbCon->getDBString());
$returnValue = [];
$result = pg_query($pgCon, "
SELECT user_name, email, size_in_meter, weight_in_kg, age_in_years
FROM user_data
JOIN user_bio_data
ON user_data.user_name = user_bio_data.name
WHERE user_name = '$userName'
");
if (!$result) {
    echo "Ein Fehler ist aufgetreten.\n";
    exit;
}
while ($data = pg_fetch_object($result)) {
    $returnValue[] = [
        "username" => $data->user_name,
        "email" => $data->email,
        "size" => $data->size_in_meter,
        "weight" => $data->weight_in_kg,
        "age" => $data->age_in_years
    ];
}

print json_encode($returnValue);