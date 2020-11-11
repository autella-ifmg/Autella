<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../../utilities/dbConnect.php';

    $email = mysqli_escape_string($connection, $_POST['inputEmail']);
    $name = mysqli_escape_string($connection, $_POST['inputName']);
    $password = mysqli_escape_string($connection, $_POST['inputPassword']);
    $id_discipline = mysqli_escape_string($connection, $_POST['inputDisciplineId']);
    $id_role = mysqli_escape_string($connection, $_POST['inputRoleId']);
    $id_institution = mysqli_escape_string($connection, $_POST['inputInstitutionId']);

    $image = 'C:\wamp64\www\autella.com\images\userDefault.jpg';
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);


    $sql = "SELECT id FROM professor WHERE email='$email';";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $message = "Email já está cadastrado no sistema!";
    } else {
        $sql = "INSERT INTO professor (email, name, password, picture, id_discipline, id_role, id_institution) VALUES 
                ('$email', '$name', '$password', '$image', '$id_discipline', '$id_role', '$id_institution');";

        if ($connection->query($sql) === TRUE) {
            $message = "Conta criada com sucesso!";
        } else {
            $message = "Erro na criação da conta!";
            //$message = "Error: " . $sql . "<br>" . $connection->error;
        }
    }
    $connection->close();


    array_push($_SESSION['debug'], $message);
    header('Location: ../../index.php');
}
