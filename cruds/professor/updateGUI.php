<!DOCTYPE html>

<html class="w-100">

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

<body class="w-100">
    <div class="container w-100 align-items-center">
        <h1 class="text-center" style="margin: 8% 0">Autella | Alterar conta</h1>

        <form action="updateSQL.php" method="POST" enctype="multipart/form-data" class="row justify-content-around needs-validation" novalidate>
            <div class="col-12 col-sm-10 col-md-5" style="max-height: 30rem">
                <img id="userPicture" class="w-100 h-100" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['userData']['picture']); ?>" />
                <label class="position-absolute m-0 p-0 pr-3" style="bottom:0; right:0" for="inputImage"><img class="p-2" style="width:64px; background-color: white;" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/upload.svg" alt=""></label>
                <input class="d-none" type="file" id="inputImage" name="inputImage" accept="image/*">
            </div>

            <div class="col-12 col-sm-10 col-md-5 mt-3">
                <label>Nome</label>
                <input type="text" class="form-control mb-3" name="inputName" value="<?php echo $_SESSION['userData']['name'] ?>" required>

                <label>Email</label>
                <input type="email" class="form-control mb-3" name="inputEmail" value="<?php echo $_SESSION['userData']['email']; ?>" required>

                <label>Senha atual</label>
                <input type="password" class="form-control mb-3" name="inputOldPassword" required>

                <label>Nova senha</label>
                <input type="password" class="form-control mb-3" name="inputNewPassword">

                <label>Confirmar nova senha</label>
                <input type="password" class="form-control mb-3" name="inputConfirmPassword">

                <div class="d-flex flex-row justify-content-between">
                    <a class="btn btn-lg btn-danger" href="../../index.php">Cancelar</a>
                    <input type="submit" class="btn btn-lg btn-success" name="inputSubmit" value="Alterar">
                </div>
            </div>
        </form>
    </div>


    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>

    <!-- Preview da imagem -->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#userPicture').attr('src', e.target.result);
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