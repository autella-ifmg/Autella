<?php
//$host = "200.18.128.52";
//$username = "autella";
//$password = "autella2020";
//$dbname = "laura_erica";

$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_autella_local";

$connection = new mysqli($host, $username, $password, $dbname);

// DEBUG
if ($connection->connect_error) {
    $message = "Connection failure: $connection->connect_error";
} else {
    //$message = 'Connection successful!';
}


if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['debug'])) {
    $_SESSION['debug'] = [];
}
if (isset($message)) {
    array_push($_SESSION['debug'], $message);
}
