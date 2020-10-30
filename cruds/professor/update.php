<?php
require_once '../../utilities/dbConnect.php';
if (isset($_POST['inputSubmit'])) {
    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $oldPassword = $_POST['inputOldPassword'];
    $newPassword = $_POST['inputNewPassword'];

    $picture = $_FILES['inputImage']['tmp_name'];
    $picture = file_get_contents($picture);
    $picture = mysqli_escape_string($connection, $picture);

    if ($picture == "") {
        $picture = mysqli_escape_string($connection, $_SESSION['userData']['picture']);
    }
    if ($newPassword == "") {
        $newPassword = $oldPassword;
    }

    if ($oldPassword == $_SESSION['userData']['password']) {
        $sql = "UPDATE professor SET email='$email', name='$name', password='$newPassword', picture='$picture' WHERE id=" . $_SESSION['userData']['id'];

        if ($connection->query($sql) === TRUE) {
            $message = "Dados alterados!";
        } else {
            $message = "Error: " . $sql . "<br>" . $connection->error;
        }

        // Login
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
    array_push($_SESSION['debug'], $message);

    header("Location: ../../index.php");
}
?>




<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <title>Autella</title>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    ?>
</head>

<body class="h-100 w-100">
    <div class="container w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <h1 class="mb-5">Autella | Editar conta</h1>

        <form action="" method="post" enctype="multipart/form-data" class="row w-75 justify-content-around align-items-center">

            <div class="form-group d-flex flex-column col-12 col-md-5 w-100 h-75 p-0">
                <img class="w-100 h-100" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['userData']['picture']); ?>" />
                <label class="position-absolute m-0 p-0 border" style="bottom:0; right:0" for="inputImage"><img class="p-2" style="width:64px; background-color: white;" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/upload.svg" alt=""></label>
                <input class="d-none" type="file" id="inputImage" name="inputImage">
            </div>

            <div class="col-12 col-md-6">
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
                    <label for="inputNewPassword">Nova senha</label>
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
        </form>

    </div>


    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>