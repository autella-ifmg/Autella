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
        $connection->close();

        $_SESSION['message'] = $message;

        header("Location: ../utilities/logout.php");
    } else {
        echo "Senha atual incorreta!";
    }
}
?>