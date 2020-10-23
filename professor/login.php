<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $sql = "SELECT * FROM professor WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['userData'] = $array;
        //$message = "Olá " . $array['nome'];
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['message'] = $message;

    header("Location: ../index.php");
}
?>