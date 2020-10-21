<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $password = $_POST['inputPassword'];

    $sql = "INSERT INTO professor (email, nome, senha) VALUES 
    ('$email', '$name', '$password');";

    if ($connection->query($sql) === TRUE) {
        $mensagem = "Conta criada com sucesso!";
    } else {
        $mensagem = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['mensagem'] = $mensagem;

    header("Location: ../index.php");
}
?>