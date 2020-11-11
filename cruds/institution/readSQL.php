<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['userData'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/403.php';
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM institution WHERE id=" . $id;
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
        die();
    }

    $connection->close();
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
    die();
}
