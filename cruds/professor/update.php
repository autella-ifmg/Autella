<?php
require_once '../../utilities/dbConnect.php';
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
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en" class="w-100 h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Editar Conta</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
</head>

<body class="w-100 h-100">
    <div class="container w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <h1>Autella | Editar conta</h1>

        <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-row w-75">
            <div class="w-100">
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
                    <label for="inputConfirmPassword">Confirmar nova senha</label>
                    <input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword">
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <a class="btn btn-danger" href="../../index.php">Cancelar</a>
                    <input type="submit" class="btn btn-primary" name="inputSubmit" value="Alterar dados">
                </div>
            </div>

            <div class="form-group mt-5 ml-5 d-flex flex-column">
                <img form-control" style="width: 256px; height: 256px" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['userData']['picture']); ?>" />
                <input class="ml-3 mt-3" type="file" id="inputImage" name="inputImage">
            </div>
        </form>
    </div>

    <a class="btn btn-danger m-3" style="position: absolute; bottom: 0; right:0; "href="">Desativar Conta</a>

    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>