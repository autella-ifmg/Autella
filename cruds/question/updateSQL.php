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

if(isset($_POST['question'])) {
    require_once "../../utilities/dbConnect.php";

    if($_POST["question"]["status"] == 0) {
        $status = 1;
    } else {
        $status = 0;
    }

    $id_question = $_POST["question"][0];
    
    $sql = "UPDATE question SET status = '$status' WHERE id = '$id_question'";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Questão arquivada com sucesso!");
        $result = "Questão arquivada com sucesso!";
    } else {
        //array_push($_SESSION['debug'], "Erro ao arquivar questão!");
       $result = "Erro ao arquivar questão!";
    }

    $connection->close();

    echo $result;
} 