<?php
if (isset($_POST["id_institution"])) {
    session_start();

    $id_institution = $_POST["id_institution"];

    $_SESSION["userData"][6] = $id_institution;
    $_SESSION["userData"]["id_institution"] = $id_institution;

    //array_push($_SESSION['debug'], "Instituição selecionada!");
}
