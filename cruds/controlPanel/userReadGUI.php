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

<body class="h-100 w-100">
    <header>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/navbar.php';
        ?>
    </header>

    <main class="h-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-column d-inline-block">
            <a class="navbar-brand" href="/index.php">Autella</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/cruds/questao/createGUI.php">Criar questão</a>
                    </li>
                    <li>
                        <a class="nav-link" href="/cruds/provaSimples/create.php">Prova Simples</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container d-inline-block">
            <p>Conteúdo</p>
        </div>
    </main>




    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>