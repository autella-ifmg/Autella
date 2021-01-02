<?php
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/security.php';

    $email = secure($_POST['email']);
    $name = secure($_POST['name']);
    $password = secure($_POST['password']);
    $id_discipline = secure($_POST['disciplineId']);
    $id_role = secure($_POST['roleId']);
    $id_institution = secure($_POST['institutionId']);





    // Impedir criação de mais de um coordenador por instituição
    $sql = "SELECT * FROM db_autella_local.user WHERE id_role='1' AND id_institution=$id_institution";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0 && $id_role == '1') {
        array_push($_SESSION['debug'], "Instituição já possui um coordenador!");
    } else {


        // Criar conta
        $sql = "UPDATE user SET email='$email', name='$name', password='$password', id_discipline='$id_discipline', 
            id_role='$id_role', id_institution='$id_institution' WHERE id=" . $_GET['id'];

        if ($connection->query($sql) === TRUE) {
            array_push($_SESSION['debug'], "Conta alheia alterada com sucesso!");
        } else {
            array_push($_SESSION['debug'], "Erro na alteração da conta alheia!");
        }
    }

    $connection->close();

    if (strpos($_SERVER['HTTP_REFERER'], 'http://autella.com/controlPanel/userUpdateGUI.php') !== false) {
        header('Location: allUsersReadGUI.php');    
    } else {
        header('Location: ..'); 
    }
    
}
