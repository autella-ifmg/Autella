<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../../utilities/dbConnect.php';

    $full_name = mysqli_escape_string($connection, $_POST['inputFullName']);
    $abbreviation = mysqli_escape_string($connection, $_POST['inputAbbreviation']);
    $phone = mysqli_escape_string($connection, $_POST['inputPhone']);
    $email = mysqli_escape_string($connection, $_POST['inputEmail']);
    $cep = mysqli_escape_string($connection, $_POST['inputCep']);
    $number = mysqli_escape_string($connection, $_POST['inputNumber']);
    $street = mysqli_escape_string($connection, $_POST['inputStreet']);
    $neighborhood = mysqli_escape_string($connection, $_POST['inputNeighborhood']);
    $city = mysqli_escape_string($connection, $_POST['inputCity']);
    $state = mysqli_escape_string($connection, $_POST['inputState']);

    // $image = 'C:\wamp64\www\autella.com\images\institutionDefault.jpg';
    // $image = file_get_contents($image);
    // $image = mysqli_escape_string($connection, $image);


    $sql = "INSERT INTO institution (full_name, abbreviation, phone, email, cep, number, street, neighborhood, city, state) VALUES 
                ('$full_name', '$abbreviation', '$phone', '$email', '$cep', '$number', '$street', '$neighborhood', '$city', '$state');";

    if ($connection->query($sql) === TRUE) {
        $message = "Instituição criada com sucesso!";
        $newInstitutionId = $connection->insert_id;

        // Adicionar imagem de perfil padrão
        $path = "../../images/institutionDefault.jpeg";
        $data = file_get_contents($path);
        $image_name = '../../images/institutions/' . $newInstitutionId . '.jpeg';
        file_put_contents($image_name, $data);
    } else {
        $message = "Erro na criação da instituição!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
    array_push($_SESSION['debug'], $message);

    header('Location: ../../index.php');
}
