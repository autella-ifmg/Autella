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
        <a class="btn btn-success my-3" href="../cruds/institution/createGUI.php">Cadastrar instituição</a>
        <div class="d-inline-block border" style="width: 95%">
            <h3 class="text-center col-12 mt-3">Instituições</h3>
            <table class="table col-12">
                <thead class="thead-dark">
                    <th scope="col">Ver</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Conta ativa</th>
                    <!-- <th scope="col">Editar</th> -->
                </thead>

                <tbody>
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
                    institutionsToRows();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function changeInstitutionStatus(id){
            window.location.href = "../cruds/institution/activateDeactivateSQL.php?id=" + id;
        }
    </script>
</body>

</html>