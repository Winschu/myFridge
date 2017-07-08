<?php
require_once("../../config.php");
require_once("../Database.php");

$db = new Database();

if (isset($_POST["name"]) && isset($_POST["pass"])) {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
}
else
{
    die;
}

if($db->checkLogin($name, $pass))
{
    print true;
}
else
{
    die;
}


