<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';

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

    $picture = $_FILES['inputImage']['tmp_name'];
    $picture = file_get_contents($picture);
    $picture = mysqli_escape_string($connection, $picture);

    if ($picture == "") {
        array_push($_SESSION['debug'], "Imagem da instituição vazia!");
        $picture = mysqli_escape_string($connection, $_SESSION['userInstitutionData']['picture']);
    }


    $sql = "UPDATE institution SET full_name='$full_name', abbreviation='$abbreviation', 
            phone='$phone', number='$number', street='$street', neighborhood='$neighborhood', 
            city='$city', state='$state', picture='$picture' WHERE id=" . $_SESSION['userInstitutionData']['id'];

    if ($connection->query($sql) === TRUE) {
        $message = "Instituição alterada com sucesso!";
    } else {
        $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    array_push($_SESSION['debug'], $message);

    $sql = 'SELECT * FROM institution WHERE id=' . $_SESSION['userData']['id_institution'];
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['userInstitutionData'] = $array;
        $message = "Instituição encontrada!";
    } else {
        $message = "Instituição não encontrada!";
        $message = "Error: " . $sql . $connection->error;
    }
    array_push($_SESSION['debug'], $message);

    $connection->close();
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
        <h1 class="text-center mb-3 mt-5 mb-sm-5">Autella <span class="d-none d-sm-inline">| Alterar dados da instituição</span></h1>

        <form method="POST" novalidate class="needs-validation row" enctype="multipart/form-data">
            <div class="form-group col-12 ">
                <label>Nome completo:</label>
                <input type="text" class="form-control"  name="inputFullName" value="<?php echo $_SESSION['userInstitutionData']['full_name'] ?>" required>
            </div>
            <div class="form-group col-12 col-md-6 ">
                <label>Abreviação:</label>
                <input type="text" class="form-control"  name="inputAbbreviation" value="<?php echo $_SESSION['userInstitutionData']['abbreviation'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Telefone:</label>
                <input type="text" class="form-control"  name="inputPhone" value="<?php echo $_SESSION['userInstitutionData']['phone'] ?>" required>
            </div>

            <div class="form-group col-12">
                <label>Rua:</label>
                <input type="text" class="form-control"  name="inputStreet" value="<?php echo $_SESSION['userInstitutionData']['street'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Número:</label>
                <input type="text" class="form-control"  name="inputNumber" value="<?php echo $_SESSION['userInstitutionData']['number'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Bairro:</label>
                <input type="text" class="form-control"  name="inputNeighborhood" value="<?php echo $_SESSION['userInstitutionData']['neighborhood'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Cidade:</label>
                <input type="text" class="form-control"  name="inputCity" value="<?php echo $_SESSION['userInstitutionData']['city'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Estado:</label>
                <input type="text" class="form-control"  name="inputState" value="<?php echo $_SESSION['userInstitutionData']['state'] ?>" required>
            </div>

            <div class="w-100 px-3 mb-5" style="min-height: 10rem; max-height: 30rem; position:relative">
                <img id="institutionPicture" class="w-100 h-100" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['userInstitutionData']['picture']); ?>" />
                <label class="position-absolute m-0 p-0 mr-3 border" style="bottom:0; right:0" for="inputImage"><img class="p-2" style="width:64px; background-color: white;" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/upload.svg" alt=""></label>
                <input class="d-none" type="file" id="inputImage" name="inputImage" accept="image/*">
            </div>



            <div class="d-flex justify-content-between pt-4 pt-sm-0 w-100 mx-3 mb-5">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="inputSubmit" value="Alterar dados">
            </div>
        </form>
    </div>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#institutionPicture').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputImage").change(function() {
            readURL(this);
        });
    </script>
</body>

</html>