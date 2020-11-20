<?php
//Inicia a sessão.
session_start();

//Função que remove conteúdos indejados dos inputs.
function securityCheck($input)
{
    global $connection;

    $aux = mysqli_escape_string($connection, $input);

    $aux = htmlspecialchars($aux);

    return $aux;
}

if (isset($_POST["inputSubmit"])) {
    //Inclui a conexão com o banco de dados.
    require_once "../../utilities/dbConnect.php";

    date_default_timezone_set("America/Sao_Paulo");
    $date = date("Y-m-d H:i:s");
    $id_user = $_SESSION["userData"]["id"];

    if ($_SESSION["userData"]["id_role"] == 0) {
    $id_discipline = securityCheck($_POST["disciplines"]);
    } else {
        $id_discipline = $_SESSION["userData"]["id_discipline"];
    }

    $id_subject = securityCheck($_POST["subjects"]);
    $dificulty = securityCheck($_POST["dificulty"]);
    $enunciate = $_POST["enunciate"];
    $correctAnswer = securityCheck($_POST["correctAnswer"]);

    //Obtém cada uma das alternativas e agrega elas no enunciado da questão.
    $alternativesQuant = securityCheck($_POST["alternativesQuant"]);
    $answersEnunciate = "";
    $letter = ["A", "B", "C", "D", "E"];

    for ($i = 0; $i < $alternativesQuant; $i++) {
        $answersEnunciate .= "<br>" . "$letter[$i]) " . securityCheck($_POST["question$i"]);

        $aux = strcmp("$correctAnswer", "$letter[$i]");
        if ($aux == 0) {
            $correctAnswerEnunciate = securityCheck($_POST["question$i"]);
        }
    }
    $enunciate .= "<br>" . $answersEnunciate;

    $sql = "INSERT INTO question (date, id_user, id_discipline, id_subject, dificulty, enunciate, correctAnswer, correctAnswerEnunciate) VALUES ('$date', '$id_user', '$id_discipline', '$id_subject', '$dificulty', '$enunciate', '$correctAnswer', '$correctAnswerEnunciate');";

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
