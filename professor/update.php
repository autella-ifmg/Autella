<?php
require_once '../utilities/dbConnect.php';
if (isset($_POST['inputSubmit'])) {
    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $oldPassword = $_POST['inputOldPassword'];
    $newPassword = $_POST['inputNewPassword'];

    $image = $_FILES['inputImage']['tmp_name'];
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);

    if ($image == "") {
        $image = mysqli_escape_string($connection, $_SESSION['userData']['picture']);
    }

    if ($oldPassword == $_SESSION['userData']['password']) {
        if ($newPassword == "") {
            $newPassword = $oldPassword;
        }
        $sql = "UPDATE professor SET email='$email', name='$name', password='$newPassword', picture='$image' WHERE id=" . $_SESSION['userData']['id'];

        if ($connection->query($sql) === TRUE) {
            $message = "Dados alterados!";
        } else {
            $message = "Erro: " . $sql . "<br>" . $connection->error;
        }

        // Check if email and password match
        $sql = "SELECT * FROM professor WHERE email='$email' AND password='$newPassword'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) != 0) {
            $array = mysqli_fetch_array($result);
            $_SESSION['userData'] = $array;
        } else {
            $message = "Senha incorreta!";
            //$message = "Erro: " . $sql . "<br>" . $connection->error;
        }

        $connection->close();
    } else {
        $message = "Senha atual incorreta!";
    }
    $_SESSION['message'] = $message;
    header("Location: /autella.com/index.php");
}
