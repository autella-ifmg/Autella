<?php
$id_role = $_SESSION["userData"]["id_role"];
//var_dump($id_role);
$id_discipline = $_SESSION["userData"]["id_discipline"];
//var_dump($id_discipline);

//Função que remove conteúdos indejados dos inputs.
function secure($input)
{
    global $connection;

    $aux = mysqli_escape_string($connection, $input);

    $aux = htmlspecialchars($aux);

    return $aux;
}

if (isset($_POST["submit"])) {
    require_once "../../utilities/dbConnect.php";

    date_default_timezone_set("America/Sao_Paulo");
    $date = date("Y-m-d");
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
    $enunciate .= "<br>" . $answersEnunciate;

    $sql = "INSERT INTO question (date, id_user, id_subject, dificulty, enunciate, correctAnswer) VALUES ('$date', '$id_user', '$id_subject', '$dificulty', '$enunciate', '$correctAnswer');";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Questão criada com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao criar questão!");
    }

    $connection->close();

    header('Location: createGUI.php');
}