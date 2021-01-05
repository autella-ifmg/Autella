<?php

function selectTestQuestions($id_test)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    //$id_discipline = $filter[0] == null ? "null" : $filter[0];
    //$id_subject = $filter[1] == null ? "question.id_subject" : $filter[1];

    $sql = "SELECT id_question from question_test WHERE id_tests = " . $id_test;
    //echo $sql;
    $result = mysqli_query($connection, $sql);
    $arrayIDS = [];
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arrayIDS, $row);
        }
    }
    
    $array = [];
    for ($i = 0; $i < count($arrayIDS); $i++) {
        $sql = "SELECT id_subject from question WHERE id = " . $arrayIDS[$i][0];
        $result = mysqli_query($connection, $sql);
        $arraySubject = [];
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($arraySubject, $row);
            }
        }

        $sql = "SELECT id_discipline from subject WHERE id = " . $arraySubject[0][0];
        $result = mysqli_query($connection, $sql);
        $arrayDiscipline = [];
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($arrayDiscipline, $row);
            }
        }


        $sql = "SELECT question.id, question.status, question.creation_date, question.dificulty, question.enunciate, question.correctAnswer, 
        user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
        JOIN user ON user.id = question.id_user 
        JOIN discipline ON discipline.id = " . $arrayDiscipline[0][0] .
            " JOIN subject ON subject.id = " . $arraySubject[0][0] .
            " WHERE question.id = " . $arrayIDS[$i][0];
        " ORDER BY discipline.name";
        //echo $sql;
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($array, $row);
            }
        }
    }
    //echo $sql;


    $connection->close();
    return $array;
}

function selectTestNames($question_id)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT tests.id, tests.name FROM question_test
            JOIN tests ON tests.id = question_test.id_tests
            WHERE question_test.id_question = " . $question_id;
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Nome das provas selecionados com sucesso!");
    } 
    
    $connection->close();

    return $array;
}
