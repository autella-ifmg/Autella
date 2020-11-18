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

<body class="h-100 w-100 d-flex flex-column">
    <header>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/navbar.php';
        ?>
    </header>

    <main class="d-flex flex-row align-items-center flex-grow-1">
        <nav class="navbar navbar-light d-inline-block" style="width: 15%; height:90%">
            <ul class="d-flex flex-column h-100 pl-0 text-center">
                <a class="nav-link flex-grow-1 align-self-center" href="/cruds/controlPanel/userReadGUI.php">Usuários</a>
                <a class="nav-link flex-grow-1" href="/cruds/controlPanel/userReadGUI.php">Questões</a>
                <a class="nav-link flex-grow-1" href="/cruds/controlPanel/userReadGUI.php">Provas simples</a>
                <a class="nav-link flex-grow-1" href="/cruds/controlPanel/userReadGUI.php">Provas globais</a>
            </ul>
        </nav>


        <div class="d-inline-block border" style="width: 80%; height:90%">
            <h3 class="text-center col-12">Usuários</h3>
        </div>
    </main>




    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>