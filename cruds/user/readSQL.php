<?php
if (isset($_GET['id'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';
    $id = $_GET['id'];

    $sql = "SELECT user.name, user.email, field.name, discipline.name, role.name, user.id 
    FROM discipline 
    JOIN field ON discipline.id_field = field.id 
    JOIN user ON user.id_discipline = discipline.id 
    JOIN role ON user.id_role = role.id 
    AND user.id = '$id';";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);

        $otherProfileName = $array[0];
        $otherProfileEmail = $array[1];
        $otherProfileField = $array[2];
        $otherProfileDiscipline = $array[3];
        $otherProfileRole = $array[4];
        $otherProfileId = $array[5];
        $otherProfileImage = '/images/users/' . $otherProfileId . '.jpeg?' . time();

        $connection->close();
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
        die();
    }
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
    die();
}
