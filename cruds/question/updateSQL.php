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

    header('Location: readGUI.php?action_performed=2');
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

if (isset($_POST['easter_egg'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $id_user = $_SESSION["userData"]["id"];
    $counter = [];

    $sql = "SELECT counter FROM easter_egg WHERE id_user = '$id_user'";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO easter_egg (`counter`, `id_user`) VALUES ('1', '$id_user')";
    } else {
        $counter = mysqli_fetch_row($result);
        $counter[0] += 1;
        //var_dump($counter);
      
        $sql = "UPDATE easter_egg SET counter = '$counter[0]' WHERE id_user = '$id_user'";
    }

    $message = "É normal imaginar que esse ícone é um botão...";

    if (!$connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Erro no easter egg!");
    }

    $connection->close();

    echo $message;
}

//Controle de gabaritos.
if (isset($_POST["data"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $array = $_POST["data"];

    $location = $array[0];
    $status_list_answers = $array[1];
    $id_test = $array[2];

    date_default_timezone_set("America/Sao_Paulo");
    $release_date = date("Y-m-d");

    $sql = "UPDATE " . $location . " SET status_list_answers = '$status_list_answers', list_release_date = '$release_date' WHERE id = '$id_test'";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Gabarito disponível!");
    } else {
        //array_push($_SESSION['debug'], "Gabarito indisponível!");
    }

    $connection->close();
}
