<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../utilities/dbConnect.php';

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

    header("Location: ../index.php");
}
?>