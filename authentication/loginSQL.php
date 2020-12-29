<?php
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    function secure($data)
    {
        global $connection;
        $data = mysqli_escape_string($connection, $data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = secure($_POST['email']);
    $password = secure($_POST['password']);


    // See if email exists in database
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {




        // Check if email and password match
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) != 0) {
            $array = mysqli_fetch_array($result);
            $_SESSION['userData'] = $array;
            // array_push($_SESSION['debug'], "Login bem sucedido!");
        } else {
            array_push($_SESSION['debug'], "Senha incorreta!");
        }
    } else {
        array_push($_SESSION['debug'], "Email não existe no sistema!");
    }

    // Carregar dados da instituição
    $sql = 'SELECT * FROM institution WHERE id=' . $_SESSION['userData']['id_institution'];
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['userInstitutionData'] = $array;
        // array_push($_SESSION['debug'], "Instituição encontrada!");
    } else {
        array_push($_SESSION['debug'], "Instituição não encontrada!");
    }

    $connection->close();
    header('Location: ..');
}
