<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

if (!isset($_SESSION['userData'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/403.php';
    die();
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT professor.name, professor.email, field.name, discipline.name, professor.picture , role.name FROM discipline 
    JOIN field ON discipline.id_field = field.id 
    JOIN professor ON professor.id_discipline = discipline.id 
    JOIN role ON professor.id_role = role.id 
    AND professor.id = '$id';";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['otherProfileData'] = $array;

        $otherProfileImage = $array[4];
        $otherProfileName = $array[0];
        $otherProfileEmail = $array[1];
        $otherProfileField = $array[2];
        $otherProfileDiscipline = $array[3];
        $otherProfileRole = $array[5];
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
        die();
    }

    $connection->close();
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
    die();
}
