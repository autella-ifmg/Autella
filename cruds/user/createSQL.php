<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../../utilities/dbConnect.php';

    $email = mysqli_escape_string($connection, $_POST['inputEmail']);
    $name = mysqli_escape_string($connection, $_POST['inputName']);
    $password = mysqli_escape_string($connection, $_POST['inputPassword']);
    $id_discipline = mysqli_escape_string($connection, $_POST['inputDisciplineId']);
    $id_role = mysqli_escape_string($connection, $_POST['inputRoleId']);
    $id_institution = mysqli_escape_string($connection, $_POST['inputInstitutionId']);

    // Impedir criação de contas com emails iguais
    $sql = "SELECT id FROM user WHERE email='$email';";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $message = "Email já está cadastrado no sistema!";
    } else {
        // Impedir criação de mais de um coordenador por instituição
        $sql = "SELECT * FROM db_autella_local.user WHERE id_role=0 AND id_institution=$id_institution";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            $message = "Instituição já possui um coordenador!";
        } else {
            $sql = "INSERT INTO user (email, name, password, id_discipline, id_role, id_institution) VALUES 
                    ('$email', '$name', '$password', '$id_discipline', '$id_role', '$id_institution');";
            if ($connection->query($sql) === TRUE) {
                $message = "Conta criada com sucesso!";
                $newUserId = $connection->insert_id;

                // Adicionar imagem de perfil padrão
                $path = "../../images/userDefault.jpg";
                $data = file_get_contents($path);
                $image_name = '../../images/users/' . $newUserId . '.jpeg';
                file_put_contents($image_name, $data);
            } else {
                $message = "Erro na criação da conta!";
                //$message = "Error: " . $sql . "<br>" . $connection->error;
            }
        }
    }
    $connection->close();


    array_push($_SESSION['debug'], $message);
    header('Location: ../../index.php');
}
