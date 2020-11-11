<?php
if(!isset($_SESSION)){
    session_start();
}

if (isset($_POST['inputSubmit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $email = mysqli_real_escape_string($connection, $_POST['inputEmail']);
    $password = mysqli_real_escape_string($connection, $_POST['inputPassword']);

    // See if email exists in database
    $sql = "SELECT * FROM professor WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        // Check if email and password match
        $sql = "SELECT * FROM professor WHERE email='$email' AND password='$password'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) != 0) {
            $array = mysqli_fetch_array($result);
            $_SESSION['userData'] = $array;
            $message = "Login bem sucedido!";
        } else {
            $message = "Senha incorreta!";
            //$message = "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {
        $message = "Email não existe no sistema!";
        //$message = "Error: " . $sql . "<br>" . $connection->error;
    }
    array_push($_SESSION['debug'], $message);

    $sql = 'SELECT * FROM institution WHERE id=' . $_SESSION['userData']['id_institution'];
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['userInstitutionData'] = $array;
        $message = "Instituição encontrada!";
    } else {
        $message = "Instituição não encontrada!";
        //$message = "Error: " . $sql . $connection->error;
    }
    array_push($_SESSION['debug'], $message);

    $connection->close();
    header('Location: ../index.php');
}
