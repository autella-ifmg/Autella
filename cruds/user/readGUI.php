<!DOCTYPE html>
<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/cruds/user/readSQL.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/security.php';

    // if account desactivated, allow only for account owner, coordinator and system manager
    // if id_role == 5 (system manager), dont show too
    securePage(1, $_GET['id']);
    ?>
</head>

<body class="w-100">
    <div class="container w-100">
        <h1 class="text-center mb-3 mb-sm-5 mt-5">Autella <span class="d-none d-sm-inline">| Visualizar conta</span></h1>

        <div class="row justify-content-around">
            <div class="col-12 col-sm-10 col-md-5" style="max-height: 30rem">
                <img class="w-100" src="<?php echo $otherProfileImage ?>" />
            </div>

            <div class="col-12 col-sm-10 col-md-5 mt-3">
                <div class="form-group">
                    <label>Nome</label>
                    <input readonly type="text" class="form-control" value="<?php echo $otherProfileName ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input readonly type="email" class="form-control" value="<?php echo $otherProfileEmail; ?>">
                </div>

                <div class="form-group">
                    <label>Área</label>
                    <input readonly type="email" class="form-control" value="<?php echo $otherProfileField; ?>">
                </div>

                <div class="form-group">
                    <label>Disciplina</label>
                    <input readonly type="email" class="form-control" value="<?php echo $otherProfileDiscipline; ?>">
                </div>

                <div class="form-group">
                    <label>Cargo</label>
                    <input readonly type="email" class="form-control" value="<?php echo $otherProfileRole; ?>">
                </div>

                <div class="row justify-content-around">
                    <a class="btn btn-danger col-4" href="javascript:history.back()">Voltar</a>

                    <?php if ($_GET['id'] == $_SESSION['userData']['id']) {
                        echo '<a class="btn btn-success col-4" href="updateGUI.php">Alterar conta</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>