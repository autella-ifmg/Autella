<?php
session_start();

function selectQuestions($id_discipline)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, subject.id_discipline, subject.name FROM question
            JOIN user ON question.id_user = user.id
            JOIN subject ON question.id_subject = subject.id AND " . $id_discipline . " = subject.id_discipline
            WHERE " . $_SESSION["userData"]["id_institution"] . " = user.id_institution"; 
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

$array = selectQuestions(2);
var_dump($array);

var_dump($_SESSION["userData"]);

// JOIN institution.id ON user.id_institution = institution.id

//JOIN user ON question.id_user = user.id