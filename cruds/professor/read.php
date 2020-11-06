<?php
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

    $sql = "SELECT professor.name, professor.email, field.name, discipline.name, professor.picture , role.name FROM db_autella_local.discipline JOIN db_autella_local.field ON discipline.id_field = field.id JOIN db_autella_local.professor ON professor.id_discipline = discipline.id JOIN role ON professor.id_role = role.id AND professor.id = '$id';";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['otherProfileData'] = $array;
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
    ?>
</head>

<body class="w-100">
    <div class="container w-100">
        <h1 class="text-center" style="margin: 8% 0">Autella | Visualizar conta</h1>

        <div class="row justify-content-around">
            <div class="col-12 col-sm-10 col-md-5" style="max-height: 30rem">
                <img class="w-100 h-100" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['otherProfileData'][4]); ?>" />
            </div>

            <div class="col-12 col-sm-10 col-md-5 mt-3">
                <div class="form-group">
                    <label>Nome</label>
                    <input readonly type="text" class="form-control" value="<?php echo $_SESSION['otherProfileData'][0] ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input readonly type="email" class="form-control" value="<?php echo $_SESSION['otherProfileData'][1]; ?>">
                </div>

                <div class="form-group">
                    <label>Área</label>
                    <input readonly type="email" class="form-control" value="<?php echo $_SESSION['otherProfileData'][2]; ?>">
                </div>

                <div class="form-group">
                    <label>Disciplina</label>
                    <input readonly type="email" class="form-control" value="<?php echo $_SESSION['otherProfileData'][3]; ?>">
                </div>

                <div class="form-group">
                    <label>Cargo</label>
                    <input readonly type="email" class="form-control" value="<?php echo $_SESSION['otherProfileData'][5]; ?>">
                </div>


                <div class="row justify-content-around">
                    <a class="btn btn-danger col-4" href="../../index.php">Voltar</a>

                    <?php if ($_GET['id'] == $_SESSION['userData']['id']) {
                        echo '<a class="btn btn-success col-4" href="update.php">Alterar conta</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>
<?php unset($_SESSION['otherProfileData']); ?>