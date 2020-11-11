<?php require_once 'readSQL.php' ?>

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
                <img class="w-100 h-100" src="data:image/jpeg;base64,<?php echo base64_encode($otherProfileImage); ?>" />
            </div>

            <div class="col-12 col-sm-10 col-md-5 mt-3">
                <label>Nome</label>
                <input readonly type="text" class="form-control mb-3" value="<?php echo $otherProfileName ?>">

                <label>Email</label>
                <input readonly type="email" class="form-control mb-3" value="<?php echo $otherProfileEmail; ?>">

                <label>Área</label>
                <input readonly type="email" class="form-control mb-3" value="<?php echo $otherProfileField; ?>">

                <label>Disciplina</label>
                <input readonly type="email" class="form-control mb-3" value="<?php echo $otherProfileDiscipline; ?>">

                <label>Cargo</label>
                <input readonly type="email" class="form-control mb-3" value="<?php echo $otherProfileRole; ?>">

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