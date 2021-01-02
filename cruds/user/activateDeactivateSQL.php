<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/security.php';

$oldPassword = secure($_POST['oldPassword']);

if ($oldPassword == $_SESSION['userData']['password'] || getAccountRole($_SESSION['userData']['id']) == 1 || getAccountRole($_SESSION['userData']['id']) == 5) {
    date_default_timezone_set('America/Sao_Paulo');

    $sql = "UPDATE user SET status=";
    
    if(getAccountStatus($_GET['id']) == 1){
        $sql .= 2;
    } else {
        $sql .= 1;
    }
    
    $sql .= " WHERE id=" . $_GET['id'];

    if ($connection->query($sql) === TRUE) {
        // array_push($_SESSION['debug'], "Conta ativada com sucesso!");

        // Logout
        //require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/logout.php';
    } else {
        array_push($_SESSION['debug'], "Erro ao ativar conta!");
    }
} else {
    array_push($_SESSION['debug'], "Senha atual incorreta!");
}

$connection->close();

header('Location: ' . $_SERVER['HTTP_REFERER']);
//header("Location: ../../index.php");

