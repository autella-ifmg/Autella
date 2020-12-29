<?php
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/security.php';


    $full_name = secure($_POST['fullName']);
    $abbreviation = secure($_POST['abbreviation']);
    $phone = secure($_POST['phone']);
    $email = secure($_POST['email']);
    $cep = secure($_POST['cep']);
    $number = secure($_POST['number']);
    $street = secure($_POST['street']);
    $neighborhood = secure($_POST['neighborhood']);
    $city = secure($_POST['city']);
    $state = secure($_POST['state']);


    $sql = "INSERT INTO institution 
            (full_name, abbreviation, phone, email, cep, number, street, neighborhood, city, state) 
            VALUES 
            ('$full_name', '$abbreviation', '$phone', '$email', '$cep', '$number', '$street', '$neighborhood', '$city', '$state');";

    if ($connection->query($sql) === TRUE) {
        // array_push($_SESSION['debug'], "Instituição criada com sucesso!");
        $newInstitutionId = $connection->insert_id;

        // Adicionar imagem padrão
        $path = "../../images/institutions/institutionDefault.jpeg";
        $data = file_get_contents($path);
        $image_name = '../../images/institutions/' . $newInstitutionId . '.jpeg';
        file_put_contents($image_name, $data);
    } else {
        array_push($_SESSION['debug'], "Erro na criação da instituição!");
    }
    $connection->close();


    header('Location: ../..');
}
