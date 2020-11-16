<?php require_once 'readSQL.php'; ?>

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
        <h1 class="text-center mt-5 mb-3 mb-sm-5">Autella <span class="d-none d-sm-inline">| Visualizar dados da instituição</span></h1>

        <div class="row">
            <div class="form-group col-12 ">
                <label>Nome completo</label>
                <input readonly type="text" class="form-control" name="inputFullName" value="<?php echo $array['full_name'] ?>">
            </div>
            <div class="form-group col-12 col-md-6 ">
                <label>Abreviação</label>
                <input readonly type="text" class="form-control" name="inputAbbreviation" value="<?php echo $array['abbreviation'] ?>" >
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Telefone</label>
                <input readonly type="text" class="form-control" name="inputPhone" value="<?php echo $array['phone'] ?>" >
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Email institucional</label>
                <input readonly type="text" class="form-control"  name="inputEmail" value="<?php echo $array['email'] ?>" required>
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>CEP</label>
                <input readonly type="text" class="form-control"  name="inputCep" value="<?php echo $array['cep'] ?>" required>
            </div>

            <div class="form-group col-12">
                <label>Rua</label>
                <input readonly type="text" class="form-control" name="inputStreet" value="<?php echo $array['street'] ?>" >
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Número</label>
                <input readonly type="text" class="form-control" name="inputNumber" value="<?php echo $array['number'] ?>" >
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Bairro</label>
                <input readonly type="text" class="form-control" name="inputNeighborhood" value="<?php echo $array['neighborhood'] ?>" >
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Cidade</label>
                <input readonly type="text" class="form-control" name="inputCity" value="<?php echo $array['city'] ?>" >
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Estado</label>
                <input readonly type="text" class="form-control" name="inputState" value="<?php echo $array['state'] ?>" >
            </div>

            <div class="w-100 px-3 mb-5" style="position:relative">
                <img id="institutionPicture" style="max-width:100%; height: auto" src="../../images/institutions/<?php echo $array['id']; ?>.jpeg" />
            </div>


            <div class="d-flex justify-content-around pt-4 pt-sm-0 w-100 mx-3 mb-5">
                <a class="btn btn-danger btn-lg" href="../../index.php">Voltar</a>

                <?php if ($_GET['id'] == $_SESSION['userData']['id_institution'] && $_SESSION['userData']['id_role'] == 0) {
                    echo '<a class="btn btn-success btn-lg" href="updateGUI.php" >Alterar dados</a>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>