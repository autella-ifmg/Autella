<?php
$host = "200.18.128.52";
$username = "autella";
$password = "autella2020";
$dbname = "laura_erica";

//$host = "localhost";
//$username = "root";
//$password = "";
//$dbname = "db_autella_local";

$connection = new mysqli($host, $username, $password, $dbname);

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['debug'])) {
    $_SESSION['debug'] = [];
}

// DEBUG
if ($connection->connect_error) {
    array_push($_SESSION['debug'], "Connection failure: $connection->connect_error");
} else {
    //array_push($_SESSION['debug'], 'Connection successful!');
}