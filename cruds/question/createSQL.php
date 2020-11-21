<?php
//Inicia a sessão.
session_start();

//Função que remove conteúdos indejados dos inputs.
function secure($input)
{
    global $connection;

    $aux = mysqli_escape_string($connection, $input);

    $aux = htmlspecialchars($aux);

    return $aux;
}

if (isset($_POST["submit"])) {
    //Inclui a conexão com o banco de dados.
    require_once "../../utilities/dbConnect.php";

    date_default_timezone_set("America/Sao_Paulo");
    $date = date("Y-m-d H:i:s");
    $id_user = $_SESSION["userData"]["id"];

    $id_subject = secure($_POST["subjects"]);
    $dificulty = secure($_POST["dificulty"]);
    $enunciate = $_POST["enunciate"];
    $correctAnswer = secure($_POST["correctAnswer"]);

    //Obtém cada uma das alternativas e agrega elas no enunciado da questão.
    $alternativesQuant = secure($_POST["alternativesQuant"]);
    $answersEnunciate = "";
    $letter = ["A", "B", "C", "D", "E"];

    for ($i = 0; $i < $alternativesQuant; $i++) {
        $answersEnunciate .= "<br>" . "$letter[$i]) " . secure($_POST["question$i"]);
    }
    //$enunciate .= "<br>" . $answersEnunciate;

    $sql = "INSERT INTO question (date, id_user, id_subject, dificulty, enunciate, correctAnswer) VALUES ('$date', '$id_user', '$id_subject', '$dificulty', '$enunciate', '$correctAnswer');";

    if ($connection->query($sql) === TRUE) {
        $message = "Questão criada com sucesso!";
    } else {
        $message = "Erro ao criar questão!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
    //echo $message;
    array_push($_SESSION['debug'], $message);

    header('Location: createGUI.php');

    /*
    var_dump($_POST);
    echo $date . "<br>";
    echo $id_subject . "<br>";
    echo $dificulty . "<br>";
    echo $id_user . "<br>";
    echo $enunciate . "<br>";
    echo $correctAnswer . "<br>";
    */
    //echo $alternativesQuant . "<br>";
    //echo $answersEnunciate;
}
