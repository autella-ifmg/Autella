<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';

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



    $sql = "UPDATE institution SET full_name='$full_name', abbreviation='$abbreviation', 
            phone='$phone', email='$email', cep='$cep', number='$number', street='$street', neighborhood='$neighborhood', 
            city='$city', state='$state'  WHERE id=" . $_SESSION['userInstitutionData']['id'];

    if ($connection->query($sql) === TRUE) {
        $message = "Instituição alterada com sucesso!";
    } else {
        $message = "Erro ao alterar a instituição!";
        // $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    array_push($_SESSION['debug'], $message);

    // Atualizar dados da instituição
    $sql = 'SELECT * FROM institution WHERE id=' . $_SESSION['userData']['id_institution'];
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['userInstitutionData'] = $array;
        $message = "Instituição encontrada!";
    } else {
        $message = "Instituição não encontrada!";
        //$message = "Error: " . $sql . $connection->error;
    }

    array_push($_SESSION['debug'], $message);

    $connection->close();
    header('Location: ../../index.php');
}
