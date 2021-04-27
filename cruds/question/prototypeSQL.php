<?php

if (isset($_POST["id_discipline"])) {

    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $id_discipline = $_POST["id_discipline"];

    $sql = "select name from subject where id_discipline = '$id_discipline'";
    $result = mysqli_query($connection, $sql);
    $php_array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($php_array, $row);
        }

        $js_array = json_encode($php_array, JSON_UNESCAPED_UNICODE);

        echo $js_array;
    } else {
        echo 'try again!';
    }

    $connection->close();

    //echo 'hi! ' . $_POST["id_discipline"];
}
