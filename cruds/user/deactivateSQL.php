<?php
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/security.php';

    $oldPassword = secure($_POST['oldPassword']);

    if ($oldPassword == $_SESSION['userData']['password']) {
        date_default_timezone_set('America/Sao_Paulo');

        $sql = "UPDATE user SET status='2' WHERE id=" . $_SESSION['userData']['id'];

        if ($connection->query($sql) === TRUE) {
            // array_push($_SESSION['debug'], "Conta desativada com sucesso!");

            // Logout
            require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/logout.php';
        } else {
            array_push($_SESSION['debug'], "Erro ao desativar conta!");
        }
    } else {
        array_push($_SESSION['debug'], "Senha atual incorreta!");
    }

    $connection->close();

    header("Location: ../../index.php");
}
