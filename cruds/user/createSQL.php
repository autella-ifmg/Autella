<?php
if (isset($_POST['submit'])) {
    require_once '../../utilities/dbConnect.php';

    function secure($data)
    {
        global $connection;
        $data = mysqli_escape_string($connection, $data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = secure($_POST['email']);
    $name = secure($_POST['name']);
    $password = secure($_POST['password']);
    $id_discipline = secure($_POST['disciplineId']);
    $id_role = secure($_POST['roleId']);
    $id_institution = secure($_POST['institutionId']);


    // Impedir criação de contas com emails iguais
    $sql = "SELECT id FROM user WHERE email='$email';";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        array_push($_SESSION['debug'], "Email já está cadastrado no sistema!");
    } else {



        // Impedir criação de mais de um coordenador por instituição
        $sql = "SELECT * FROM db_autella_local.user WHERE id_role='1' AND id_institution=$id_institution";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            array_push($_SESSION['debug'], "Instituição já possui um coordenador!");
        } else {


            
            // Criar conta
            $sql = "INSERT INTO user (email, name, password, id_discipline, id_role, id_institution) 
                    VALUES 
                    ('$email', '$name', '$password', '$id_discipline', '$id_role', '$id_institution');";
            if ($connection->query($sql) === TRUE) {
                array_push($_SESSION['debug'], "Conta criada com sucesso!");
                
                // Adicionar imagem de perfil padrão
                $newUserId = $connection->insert_id;
                $path = "../../images/userDefault.jpeg";
                $data = file_get_contents($path);
                $image_name = '../../images/users/' . $newUserId . '.jpeg';
                file_put_contents($image_name, $data);
            } else {
                array_push($_SESSION['debug'], "Erro na criação da conta!");
            }
        }
    }
    $connection->close();

    header('Location: ../../index.php');
}
