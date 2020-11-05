<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';

if (isset($_POST['inputSubmit'])) {
    require_once '../../utilities/dbConnect.php';

    $full_name = mysqli_escape_string($connection, $_POST['inputFullName']);
    $abbreviation = mysqli_escape_string($connection, $_POST['inputAbbreviation']);
    $phone = mysqli_escape_string($connection, $_POST['inputPhone']);
    $number = mysqli_escape_string($connection, $_POST['inputNumber']);
    $street = mysqli_escape_string($connection, $_POST['inputStreet']);
    $neighborhood = mysqli_escape_string($connection, $_POST['inputNeighborhood']);
    $city = mysqli_escape_string($connection, $_POST['inputCity']);
    $state = mysqli_escape_string($connection, $_POST['inputState']);

    // $image = '/autella.com/images/userDefault.jpg';
    $image = 'C:\wamp64\www\autella.com\images\institutionDefault.jpg';
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);


    $sql = "INSERT INTO institution (full_name, abbreviation, phone, number, street, neighborhood, city, state, picture) VALUES 
                ('$full_name', '$abbreviation', '$phone', '$number', '$street', '$neighborhood', '$city', '$state', '$image');";

    if ($connection->query($sql) === TRUE) {
        $message = "Instituição criada com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
    echo $message;
    array_push($_SESSION['debug'], $message);

    header('Location: ../../index.php');
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
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    ?>
</head>

<body class="h-100 w-100 row align-items-center justify-content-center">
    <div class="col-12 ml-4
                col-sm-10
                col-lg-8
                col-xl-6">
        <h1 class="text-center mb-3 mb-sm-5">Autella <span class="d-none d-sm-inline">| Cadastrar instituição</span></h1>

        <form method="post" novalidate class="needs-validation row">
            <div class="form-group col-12 ">
                <label>Nome completo:</label>
                <input type="text" class="form-control" id="" name="inputFullName" required>
            </div>
            <div class="form-group col-12 col-md-6 ">
                <label>Abreviação:</label>
                <input type="text" class="form-control" id="" name="inputAbbreviation" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Telefone:</label>
                <input type="text" class="form-control" id="" name="inputPhone" required>
            </div>

            <div class="form-group col-12">
                <label>Rua:</label>
                <input type="text" class="form-control" id="" name="inputStreet" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Número:</label>
                <input type="text" class="form-control" id="" name="inputNumber" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="" name="inputNeighborhood" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Cidade:</label>
                <input type="text" class="form-control" id="" name="inputCity" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Estado:</label>
                <input type="text" class="form-control" id="" name="inputState" required>
            </div>



            <div class="d-flex justify-content-between pt-4 pt-sm-0 w-100 mx-3">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="inputSubmit" value="Cadastrar instituição">
            </div>
        </form>
    </div>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>