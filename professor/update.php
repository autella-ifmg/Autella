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


    if ($oldPassword == $_SESSION['userData']['senha']) {
        if ($newPassword == "") {
            $newPassword = $oldPassword;
        }
        $sql = "UPDATE professor SET email='$email', nome='$name', senha='$newPassword', imagem='$image' WHERE id=" . $_SESSION['userData']['id'];
        //echo $sql;

        if ($connection->query($sql) === TRUE) {
            $message = "Dados alterados!";
        } else {
            $message = "Erro: " . $sql . "<br>" . $connection->error;
        }
        $connection->close();

        $_SESSION['message'] = $message;

        header("Location: ../utilities/logout.php");
        //header("Location: ../index.php");
    } else {
        echo "Senha atual incorreta!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auttela | Editar conta</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $_SESSION['userData']['nome'] ?>">
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