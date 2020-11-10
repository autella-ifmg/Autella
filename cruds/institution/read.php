<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['userData'])) {
    header("Location: ../../views/403.php");
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM institution WHERE id=" . $id;
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['otherInstitutionData'] = $array;
    } else {
        header("Location: ../../views/404.php");
        die();
    }

    $connection->close();
} else {
    header("Location: ../../views/404.php");
    die();
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
        <h1 class="text-center mt-5 mb-3 mb-sm-5">Autella <span class="d-none d-sm-inline">| Visualizar dados da instituição</span></h1>

        <div novalidate class="needs-validation row">
            <div class="form-group col-12 ">
                <label>Nome completo:</label>
                <input readonly type="text" class="form-control"  name="inputFullName" value="<?php echo $_SESSION['otherInstitutionData']['full_name'] ?>" required>
            </div>
            <div class="form-group col-12 col-md-6 ">
                <label>Abreviação:</label>
                <input readonly type="text" class="form-control"  name="inputAbbreviation" value="<?php echo $_SESSION['otherInstitutionData']['abbreviation'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Telefone:</label>
                <input readonly type="text" class="form-control"  name="inputPhone" value="<?php echo $_SESSION['otherInstitutionData']['phone'] ?>" required>
            </div>

            <div class="form-group col-12">
                <label>Rua:</label>
                <input readonly type="text" class="form-control"  name="inputStreet" value="<?php echo $_SESSION['otherInstitutionData']['street'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Número:</label>
                <input readonly type="text" class="form-control"  name="inputNumber" value="<?php echo $_SESSION['otherInstitutionData']['number'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Bairro:</label>
                <input readonly type="text" class="form-control"  name="inputNeighborhood" value="<?php echo $_SESSION['otherInstitutionData']['neighborhood'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Cidade:</label>
                <input readonly type="text" class="form-control"  name="inputCity" value="<?php echo $_SESSION['otherInstitutionData']['city'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Estado:</label>
                <input readonly type="text" class="form-control"  name="inputState" value="<?php echo $_SESSION['otherInstitutionData']['state'] ?>" required>
            </div>

            <div class="w-100 px-3 mb-5" style="min-height: 40rem; max-height: 100rem; position:relative">
                <img id="institutionPicture" class="w-100 h-100" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['otherInstitutionData']['picture']); ?>" />
            </div>


            <div class="d-flex justify-content-around pt-4 pt-sm-0 w-100 mx-3 mb-5">
                <a class="btn btn-danger btn-lg" href="../../index.php">Voltar</a>

                <?php if ($_GET['id'] == $_SESSION['userData']['id_institution'] && $_SESSION['userData']['id_role'] == 0) {
                    echo '<a class="btn btn-success btn-lg" href="update.php" >Alterar dados</a>';
                }
                ?>
            </div>
            </div>
    </div>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>

<?php unset($_SESSION['otherInstitutionData']) ?>