<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $password = $_POST['inputPassword'];

    $sql = "INSERT INTO professor (email, name, password) VALUES 
    ('$email', '$name', '$password');";

    if ($connection->query($sql) === TRUE) {
        $message = "Conta criada com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['message'] = $message;

    header("Location: ../index.php");
}
?>