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
    <div class="col-12 ml-4    col-sm-10    col-lg-8    col-xl-6">
        <h1 class="text-center mb-3 mt-5 mb-sm-5">Autella <span class="d-none d-sm-inline">| Alterar dados da instituição</span></h1>

        <form action="updateSQL.php" method="POST" novalidate class="needs-validation row" enctype="multipart/form-data">
            <div class="form-group col-12 ">
                <label>Nome completo</label>
                <input type="text" class="form-control" name="inputFullName" value="<?php echo $_SESSION['userInstitutionData']['full_name'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Abreviação</label>
                <input type="text" class="form-control" name="inputAbbreviation" value="<?php echo $_SESSION['userInstitutionData']['abbreviation'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Telefone</label>
                <input type="text" class="form-control" name="inputPhone" value="<?php echo $_SESSION['userInstitutionData']['phone'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Email institucional</label>
                <input type="text" class="form-control" name="" value="" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>CEP</label>
                <input type="text" class="form-control" name="" value="" required>
            </div>

            <div class="form-group col-12">
                <label>Rua/Avenida</label>
                <input type="text" class="form-control" name="inputStreet" value="<?php echo $_SESSION['userInstitutionData']['street'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Número</label>
                <input type="text" class="form-control" name="inputNumber" value="<?php echo $_SESSION['userInstitutionData']['number'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Bairro</label>
                <input type="text" class="form-control" name="inputNeighborhood" value="<?php echo $_SESSION['userInstitutionData']['neighborhood'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Cidade</label>
                <input type="text" class="form-control" name="inputCity" value="<?php echo $_SESSION['userInstitutionData']['city'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Estado</label>
                <input type="text" class="form-control" name="inputState" value="<?php echo $_SESSION['userInstitutionData']['state'] ?>" required>
            </div>

            <div class="w-100 px-3 mb-5" style="position:relative">
                <img id="institutionPicture" style="width:100%; height:auto" src="../../images/institutions/<?php echo $_SESSION['userInstitutionData']['id']; ?>.jpeg" />
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
    <!-- Preview da imagem -->
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