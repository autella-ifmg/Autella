<?php
if (isset($_POST["submit"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $id = $_POST["id"];
    $id_subject = $_POST["subjects"];
    $dificulty = $_POST["dificulty"];
    $enunciate = addslashes($_POST["enunciate"]);
    $correctAnswer = $_POST["correctAnswer"];

    $sql = "UPDATE question SET id_subject = '$id_subject', dificulty = '$dificulty', enunciate = '$enunciate', correctAnswer = '$correctAnswer' WHERE id = '$id'";

    if ($connection->query($sql) === TRUE) {
        array_push($_SESSION['debug'], "Questão editada com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao editar questão!");
    }

    $connection->close();

    header('Location: readGUI.php?action_per=2');
}

if (isset($_POST['question_archive_unarchive'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $id_question = $_POST["question_archive_unarchive"][0];

    $date_archive_unarchive = "0000-00-00";

    if ($_POST["question_archive_unarchive"]["status"] == 0) {
        $status = 1;
        $success = "Questão desarquivada com sucesso!";
        $error = "Erro ao desarquivar questão!";
    } else {
        date_default_timezone_set("America/Sao_Paulo");
        $date_archive_unarchive = date("Y-m-d");
        $status = 0;
        $success = "Questão arquivada com sucesso!";
        $error = "Erro ao arquivar questão!";
    }

    $sql = "UPDATE question SET secondary_date = '$date_archive_unarchive', status = '$status' WHERE id = '$id_question'";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Questão arquivada com sucesso!");
        $result = $success;
    } else {
        //array_push($_SESSION['debug'], "Erro ao arquivar questão!");
        $result = $error;
    }

    $connection->close();

    echo $result;
}

if (isset($_POST['question_delete'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $id_question = $_POST["question_delete"][0];

    date_default_timezone_set("America/Sao_Paulo");
    $date_exclusion = date("Y-m-d");
    $status = -1;
    $success = "Questão excluída com sucesso!";
    $error = "Erro ao excluir questão!";

    $sql = "UPDATE question SET secondary_date = '$date_exclusion', status = '$status' WHERE id = '$id_question'";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Questão arquivada com sucesso!");
        $result = $success;
    } else {
        //array_push($_SESSION['debug'], "Erro ao arquivar questão!");
        $result = $error;
    }

    $connection->close();

    echo $result;
}
