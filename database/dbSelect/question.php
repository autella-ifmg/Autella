<?php

function selectQuestions($limit, $start, $end, $filter)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql_limit = "";

    if ($limit) {
        $sql_limit = " LIMIT $start, $end;";
    }

    if (empty($filter)) {
        $id_institution = $_SESSION["userData"]["id_institution"];
        $id_discipline = "null";
        $id_subject = "question.id_subject";
        $dificulty = "";
        $creation_date = "";
        $status = " AND question.status = 1";
    } else {
        $id_institution = $filter[0];
        $id_discipline = $filter[1] == null ? "null" : $filter[1];
        $id_subject = $filter[2] == null ? "question.id_subject" : $filter[2];
        $dificulty = $filter[3] == null ? "" : " AND question.dificulty = $filter[3]";
        $creation_date = $filter[4] == null ? "" : " AND question.creation_date = '$filter[4]'";
        $status = $filter[5] == null ? " AND question.status = 1" : " AND question.status = $filter[5]";
    }

    if ($id_discipline == "null") {
        $sql = "SELECT question.id, question.status, question.creation_date, question.dificulty, question.enunciate, question.correctAnswer, 
            user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
            JOIN user ON user.id = question.id_user 
            JOIN discipline 
            JOIN subject ON subject.id = question.id_subject 
            WHERE user.id_institution = " . $id_institution . "
            AND discipline.id = subject.id_discipline" . $status .
            $dificulty . $creation_date . "
            ORDER BY discipline.name, subject.name " . $sql_limit;
    } else {
        $sql = "SELECT question.id, question.status, question.creation_date, question.dificulty, question.enunciate, question.correctAnswer, 
        user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
        JOIN user ON user.id = question.id_user 
        JOIN discipline ON discipline.id = " . $id_discipline .
            " JOIN subject ON subject.id = " . $id_subject .
            " WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] .
            " AND discipline.id = subject.id_discipline AND subject.id = question.id_subject"
            . $status .
            $dificulty . $creation_date .
            " ORDER BY discipline.name, subject.name " . $sql_limit;
    }
    //echo $sql;
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Questões selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar questões!");
    }

    $connection->close();
    return $array;
}
