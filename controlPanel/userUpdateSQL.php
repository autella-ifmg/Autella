<?php
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    function secure($data)
    {
        global $connection;
        $data = mysqli_escape_string($connection, $data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = secure($_POST['email']);
    $name = secure($_POST['name']);
    $oldPassword = secure($_POST['oldPassword']);
    $newPassword = secure($_POST['password']);

    if ($newPassword == "") {
        $newPassword = $oldPassword;
    }

    if ($oldPassword == $_SESSION['userData']['password']) {

        // Impedir criação de contas com emails iguais
        $sql = "SELECT id FROM user WHERE email='$email';";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            array_push($_SESSION['debug'], "Email já está cadastrado no sistema!");
        } else {



            $sql = "UPDATE user SET email='$email', name='$name', password='$newPassword' 
                    WHERE id=" . $_SESSION['userData']['id'];

            if ($connection->query($sql) === TRUE) {
                array_push($_SESSION['debug'], "Dados alterados!");
            } else {
                array_push($_SESSION['debug'], "Ocorreu um erro na alteração dos dados!");
            }


            // Login para atualizar dados
            $sql = "SELECT * FROM user WHERE email='$email' AND password='$newPassword'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) != 0) {
                $array = mysqli_fetch_array($result);
                $_SESSION['userData'] = $array;
                array_push($_SESSION['debug'], "Login bem sucedido!");
            } else {
                array_push($_SESSION['debug'], "Senha incorreta!");
            }

            // $sql = 'SELECT * FROM institution WHERE id=' . $_SESSION['userData']['id_institution'];
            // $result = mysqli_query($connection, $sql);

            // if (mysqli_num_rows($result) != 0) {
            //     $array = mysqli_fetch_array($result);
            //     $_SESSION['userInstitutionData'] = $array;
            //     array_push($_SESSION['debug'], "Instituição encontrada!");
            // } else {
            //     array_push($_SESSION['debug'], "Instituição não encontrada!");
            // }
        }
    } else {
        array_push($_SESSION['debug'], "Senha atual incorreta!");
    }

    $connection->close();

    header("Location: ../../index.php");
}
