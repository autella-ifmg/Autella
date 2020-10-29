<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //$sql = "SELECT * FROM professor WHERE id='$id'";
    $sql = "SELECT professor.name, professor.email, field.name, discipline.name, professor.picture FROM db_autella_local.discipline JOIN db_autella_local.field ON discipline.id_field = field.id JOIN db_autella_local.professor ON professor.id_discipline = discipline.id AND professor.id = '" . $id . "';";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
        $_SESSION['otherProfileData'] = $array;
    } else {
        $message = "Senha incorreta!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en" class="w-100 h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Editar Conta</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
</head>

<body class="w-100 h-100">
    <div class="container w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <h1>Autella | Visualizar conta</h1>

        <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-row w-75">
            <div class="w-100">
                <div class="form-group">
                    <label>Nome</label>
                    <input readonly type="text" class="form-control" value="<?php echo $_SESSION['otherProfileData'][0] ?>">
                </div>

                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input readonly type="email" class="form-control" value="<?php echo $_SESSION['otherProfileData'][1]; ?>">
                </div>

                <div class="form-group">
                    <label for="inputEmail">Área</label>
                    <input readonly type="email" class="form-control" value="<?php echo $_SESSION['otherProfileData'][2];
                                                                                ?>">
                </div>

                <div class="form-group">
                    <label for="inputEmail">Disciplina</label>
                    <input readonly type="email" class="form-control" value="<?php echo $_SESSION['otherProfileData'][3];
                                                                                ?>">
                </div>


                <div class="d-flex flex-row justify-content-around">
                    <a class="btn btn-primary w-25" href="../../index.php">Voltar</a>
                </div>
            </div>

            <div class="form-group mt-3 ml-5 d-flex flex-column">
                <img form-control" style="width: 256px; height: 256px" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['otherProfileData'][4]); ?>" />
            </div>
        </form>
    </div>

    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>

<?php unset($_SESSION['otherProfileData']); ?>