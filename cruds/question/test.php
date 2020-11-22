<?php
function selectQuestionsTest($id_discipline, $start, $end, $limit)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    if ($limit) {
        $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, discipline.id, discipline.name, subject.name FROM question
            JOIN user ON question.id_user = user.id
            JOIN discipline ON discipline.id = " . $id_discipline . "
            JOIN subject ON question.id_subject = subject.id AND subject.id_discipline = " . $id_discipline . "
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] . " LIMIT " . $start . ", " . $end;
    } else {
        $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, discipline.id, discipline.name, subject.name FROM question
            JOIN user ON question.id_user = user.id
            JOIN discipline ON discipline.id = " . $id_discipline . "
            JOIN subject ON question.id_subject = subject.id AND subject.id_discipline = " . $id_discipline . "
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"];
    }
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

//$array = selectQuestions(2);
//var_dump($array);
//echo $array[0]["name"];
//var_dump($_SESSION["userData"]);

//" JOIN subject ON question.id_subject = subject.id AND subject.id_discipline = " . $id_discipline .
//subject.id_discipline, subject.name
// JOIN institution.id ON user.id_institution = institution.id
//AND subject.id_discipline = " . $id_discipline .
//question.id_subject = subject.id 
//JOIN user ON question.id_user = user.id

