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
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/navbar.php'; ?>
    </header>

    <main class="d-flex flex-column align-items-center flex-grow-1">
        <nav class="navbar navbar-light w-100">
            <ul class="d-flex flex-row w-100 pl-0 text-center justify-content-around">
                <a class="nav-link" href="">Usuários</a>
                <a class="nav-link" href="">Questões</a>
                <a class="nav-link" href="">Provas simples</a>
                <a class="nav-link" href="">Provas globais</a>
            </ul>
        </nav>

        <div class="d-inline-block border" style="width: 95%">
            <h3 class="text-center col-12">Usuários</h3>
            <table class="table col-12">
                <thead class="thead-dark">
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Área</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Ações</th>
                </thead>

                <tbody>
                    <?php usersToRows($_SESSION['userData']['id_institution']); ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>