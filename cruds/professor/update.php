<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autella.com/utilities/dbConnect.php';
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
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Editar Conta</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $_SESSION['userData']['name'] ?>">
        </div>

        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $_SESSION['userData']['email']; ?>">
        </div>

        <div class="form-group">
            <label for="inputOldPassword">Senha atual</label>
            <input type="password" class="form-control" id="inputOldPassword" name="inputOldPassword">
        </div>

        <div class="form-group">
            <label for="inputNewPassword">Nova Senha</label>
            <input type="password" class="form-control" id="inputNewPassword" name="inputNewPassword">
        </div>

        <div class="form-group">
            <label for="inputImage">Imagem de perfil</label>
            <input type="file" class="form-control" id="inputImage" name="inputImage">
        </div>

        <input type="submit" class="btn btn-primary" name="inputSubmit" value="Alterar dados">
    </form>
</body>

</html>