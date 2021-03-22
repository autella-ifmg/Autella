<?php
if (isset($_POST['id_institution'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $id_user = $_SESSION['userData']['id'];
    $id_institution = $_POST['id_institution'];

    $_SESSION['userData'][6] = $id_institution;
    $_SESSION['userData']["id_institution"] = $id_institution;

    $sql = "UPDATE user SET id_institution = '$id_institution' WHERE id = '$id_user'";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Nova instituição selecionada!");
    } else {
        //array_push($_SESSION['debug'], "Erro ao selecionar nova instituição selecionada!");
    }

    $connection->close();
}
