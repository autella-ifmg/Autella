<?php

function selectSubjects()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT * FROM subject ORDER BY name;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Matérias selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar matérias!");
    }

    return $array;
}

function selectSubjectName($subject_id)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT name FROM subject WHERE id = " . $subject_id;

    $result = mysqli_query($connection, $sql);

    $connection->close();

    return mysqli_fetch_array($result)[0];
}
