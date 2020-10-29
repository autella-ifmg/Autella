
    <div class="container h-100 d-flex align-items-center">
        <div class="row justify-content-around w-100">

            <div class="col-0 col-md-5 d-none d-lg-block">
                <h1 class="text-success display-4 font-weight-bold">Autella</h1>
                <h3>Crie provas e questões para a sala de aula com Autella</h3>
            </div>

            <div class="d-flex flex-column col-12 col-md-8 col-lg-5 align-items-center">
                <div class="card p-3 w-100">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail">
                        </div>

                        <div class="form-group">
                            <label for="inputSenha">Senha</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword">
                        </div>
                        <input type="submit" class="btn btn-success w-100" name="inputSubmit" value="Entrar">
                    </form>
                    <a class="text-center my-3">Esqueceu a senha?</a>
                    <hr class="my-0">
                    <div class="w-100 text-center mt-4">
                        <a class="btn btn-success w-50" href="../cruds/professor/create.php">Criar nova conta</a>
                    </div>
                </div>
                <a class="mt-3" href="utilities/loginCoordenador.php">Você é um coordenador? Clique aqui!</a>
            </div>

        </div>
    </div>


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
        } else {
            $message = "Senha incorreta!";
            //$message = "Erro: " . $sql . "<br>" . $connection->error;
        }
    } else {
        $message = "Email não cadastrado!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['message'] = $message;
    header('Location: ../index.php');
}
?>