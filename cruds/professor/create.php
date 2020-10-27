<?php
if (isset($_POST['inputSubmit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/autella.com/utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $password = $_POST['inputPassword'];

    // C:\wamp64\tmp\php9799.tmp
    // $image = '/autella.com/images/userDefault.jpg';
    $image = 'C:\wamp64\www\autella.com\images\userDefault.jpg';
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);

    $sql = "INSERT INTO professor (email, name, password, picture) VALUES 
    ('$email', '$name', '$password', '$image');";

    if ($connection->query($sql) === TRUE) {
        $message = "Conta criada com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['message'] = $message;

    require_once $_SERVER['DOCUMENT_ROOT'] . '/autella.com/utilities/logout.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar conta</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
</head>

<body>
    <form action="" method="post">
        <div class="form-group">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" id="inputName" name="inputName">
        </div>

        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail">
        </div>

        <div class="form-group">
            <label for="inputPassword">Senha</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword">
        </div>

        <input type="submit" class="btn btn-success" name="inputSubmit" value="Criar conta">
    </form>

    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>