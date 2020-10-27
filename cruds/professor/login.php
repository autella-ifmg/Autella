<?php
if (isset($_POST['inputSubmit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

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
        } else {
            $message = "Senha incorreta!";
            //$message = "Erro: " . $sql . "<br>" . $connection->error;
        }
    } else {
        $message = "Email não cadastrado!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['message'] = $message;
    header('Location: ../../index.php');
}
