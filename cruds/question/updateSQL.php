<?php
if (!isset($_SESSION)) {
    session_start();
}

//Função que remove conteúdos indejados dos inputs.
function secure($input)
{
    //global $connection;

    $input = addslashes($input);

    //$input = mysqli_escape_string($connection, $input);

    //$input = htmlspecialchars($aux);

    return $input;
}

if (isset($_POST["submit"])) {
    require_once "../../utilities/dbConnect.php";

    $id = $_POST["id"];
    $id_subject = $_POST["subjects"];
    $dificulty = $_POST["dificulty"];
    $enunciate = secure($_POST["enunciate"]);
    $correctAnswer = $_POST["correctAnswer"];

    $sql = "UPDATE question SET id_subject = '$id_subject', dificulty = '$dificulty', enunciate = '$enunciate', correctAnswer = '$correctAnswer' WHERE id = '$id'";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Questão alterada com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao alterar questão!");
    }

    $connection->close();

    header('Location: readGUI.php');
}

if (isset($_POST['question_archive_unarchive'])) {
    require_once "../../utilities/dbConnect.php";

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
    require_once "../../utilities/dbConnect.php";

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
