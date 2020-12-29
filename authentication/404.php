<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php'; ?>
</head>

<body class="h-100 w-100">
    <div class="jumbotron">
        <h1 class="display-4">Erro 404: Página inexistente!</h1>
        <p class="lead">Opa! Você tentou acessar uma página inválida ou inexistente!</p>
        <hr class="my-4">
        <p>Caso você queira voltar para a página anterior, clique no botão abaixo</p>
        <a class="btn btn-primary btn-lg" href="javascript:history.back()" role="button">Voltar</a>
    </div>
</body>

</html>