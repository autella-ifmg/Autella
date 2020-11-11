<?php
require_once '../../utilities/dbConnect.php';
if (isset($_POST['inputSubmit'])) {
    $email = mysqli_escape_string($connection, $_POST['inputEmail']);
    $name = mysqli_escape_string($connection, $_POST['inputName']);
    $oldPassword = mysqli_escape_string($connection, $_POST['inputOldPassword']);
    $newPassword = mysqli_escape_string($connection, $_POST['inputNewPassword']);

    $image = $_FILES['inputImage']['tmp_name'];
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);

    if ($image == "") {
        $image = mysqli_escape_string($connection, $_SESSION['userData']['picture']);
    }
    if ($newPassword == "") {
        $newPassword = $oldPassword;
    }

    if ($oldPassword == $_SESSION['userData']['password']) {
        $sql = "UPDATE professor SET email='$email', name='$name', password='$newPassword', picture='$image' 
                WHERE id=" . $_SESSION['userData']['id'];

        if ($connection->query($sql) === TRUE) {
            $message = "Dados alterados!";
        } else {
            $message = "Ocorreu um erro na alteração dos dados!";
            //$message = "Error: " . $sql . "<br>" . $connection->error;
        }

        // Login (a ser substituído)
        $sql = "SELECT * FROM professor WHERE email='$email' AND password='$newPassword'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) != 0) {
            $array = mysqli_fetch_array($result);
            $_SESSION['userData'] = $array;
        } else {
            $message = "Senha incorreta!";
            //$message = "Erro: " . $sql . "<br>" . $connection->error;
        }
        array_push($_SESSION['debug'], $message);

        $sql = 'SELECT * FROM institution WHERE id=' . $_SESSION['userData']['id_institution'];

        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            $array = mysqli_fetch_array($result);
            $_SESSION['userInstitutionData'] = $array;
            $message = "Instituição encontrada!";
        } else {
            $message = "Instituição não encontrada!";
            //$message = "Error: " . $sql . "<br>" . $connection->error;
        }
        array_push($_SESSION['debug'], $message);
    } else {
        $message = "Senha atual incorreta!";
    }

    $connection->close();
    array_push($_SESSION['debug'], $message);

    header("Location: ../../index.php");
}
