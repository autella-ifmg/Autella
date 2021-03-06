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
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    ?>
</head>

<body class="h-100 w-100 row align-items-center justify-content-center">
    <div class="col-12 ml-4 col-sm-10 col-lg-8 col-xl-6">
        <h1 class="text-center mb-3 mb-sm-5">Autella <span class="d-none d-sm-inline">| Cadastrar instituição</span></h1>

        <form action="createSQL.php" method="post" novalidate class="needs-validation row">
            <div class="form-group col-12 ">
                <label>Nome completo</label>
                <input required type="text" class="form-control" name="fullName">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>Abreviação</label>
                <input required type="text" class="form-control" name="abbreviation">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>Telefone</label>
                <input required type="text" class="form-control" name="phone">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>Email institucional</label>
                <input required type="text" class="form-control" name="email">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>CEP</label>
                <input required type="text" class="form-control" name="cep">
            </div>

            <div class="form-group col-12">
                <label>Rua/Avenida</label>
                <input required type="text" class="form-control" name="street">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>Número</label>
                <input required type="text" class="form-control" name="number">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>Bairro</label>
                <input required type="text" class="form-control" name="neighborhood">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>Cidade</label>
                <input required type="text" class="form-control" name="city">
            </div>

            <div class="form-group col-12 col-md-6">
                <label>Estado</label>
                <input required type="text" class="form-control" name="state">
            </div>

            <div class="d-flex justify-content-between pt-4 pt-sm-0 w-100 mx-3">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="submit" value="Cadastrar instituição">
            </div>
        </form>
    </div>
</body>

</html>