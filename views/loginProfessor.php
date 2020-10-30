<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <title>Autella | Login</title>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    ?>
</head>

<body class="h-100 w-100">
    <div class="container h-100 d-flex align-items-center">
        <div class="row justify-content-around w-100">

            <div class="col-12 mb-5 ml-5
                        col-md-7
                        col-lg-6 mb-lg-0 ml-lg-0
                        col-xl-5">
                <h1 class="text-success display-4 font-weight-bold">Autella</h1>
                <h3>Crie provas e questões para a sala de aula com Autella</h3>
            </div>

            <div class="col-12 ml-4 pl-3
                        col-md-8
                        col-lg-6 ml-lg-0 pl-lg-0
                        col-xl-5">

                <div class="card p-3">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="inputEmail">
                        </div>

                        <div class="form-group">
                            <label for="inputSenha">Senha</label>
                            <input type="password" class="form-control" name="inputPassword">
                        </div>

                        <input type="submit" class="btn btn-success w-100" name="inputSubmit" value="Entrar">
                    </form>

                    <a class="text-center my-3">Esqueceu a senha?</a>
                    <hr class="my-0">
                    <div class="w-100 text-center mt-4">
                        <a class="btn btn-success w-50" href="../cruds/professor/create.php">Criar nova conta</a>
                    </div>
                </div>

                <a class="mt-3 d-block text-center" href="loginCoordenador.php">Você é um coordenador? Clique aqui!</a>
            </div>

        </div>
    </div>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>


<?php
if (isset($_POST['inputSubmit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    // See if email exists in database
    $sql = "SELECT * FROM professor WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        // Check if email and password match
        $sql = "SELECT * FROM professor WHERE email='$email' AND password='$password'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) != 0) {
            $array = mysqli_fetch_array($result);
            $_SESSION['userData'] = $array;
            $message = "Login successful!";
        } else {
            $message = "Incorrect password!";
            //$message = "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {
        $message = "Email do not exists in our database!";
        //$message = "Error: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    array_push($_SESSION['debug'], $message);
    header('Location: ../index.php');
}
?>