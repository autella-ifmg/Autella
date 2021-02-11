<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/security.php';


date_default_timezone_set('America/Sao_Paulo');

$sql = "UPDATE institution SET status=";

if (getInstitutionStatus($_GET['id']) == 1) {
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
    array_push($_SESSION['debug'], "Erro ao mudar status da instituição!");
}

$connection->close();

if ($_SERVER['HTTP_REFERER'] == "http://autella.com/cruds/institution/activateDeactivateGUI.php") {
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
