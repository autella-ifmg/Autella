<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/discipline.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/subject.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';

$id_role = $_SESSION["userData"]["id_role"];
//var_dump($id_role); 

if (isset($_POST["submit"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    date_default_timezone_set("America/Sao_Paulo");
    $creation_date = date("Y-m-d");
    $id_user = $_SESSION["userData"]["id"];
    $id_subject = $_POST["subjects"];
    $dificulty = $_POST["dificulty"];
    $enunciate = addslashes($_POST["enunciate"]);
    $correctAnswer = $_POST["correctAnswer"];
    $status = 1;

    $sql = "INSERT INTO question (creation_date, id_user, id_subject, dificulty, enunciate, correctAnswer, status) VALUES ('$creation_date', '$id_user', '$id_subject', '$dificulty', '$enunciate', '$correctAnswer', '$status');";

    if ($connection->query($sql) === TRUE) {
        array_push($_SESSION['debug'], "Questão criada com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao criar questão!");
    }

    $connection->close();

    header('Location: readGUI.php?');
    $_SESSION["action_performed"] = 1;
}
