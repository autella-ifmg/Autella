<?php
//$servername = "200.18.128.52";
//$username = "autella";
//$password = "autella2020";
//$dbname = "laura_erica";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laura_erica_local";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    $message = "Connection failed: " . $connection->connect_error;
} else {
    $message = "Connected successfully";
}

session_start();
$_SESSION['message'] = $message;
