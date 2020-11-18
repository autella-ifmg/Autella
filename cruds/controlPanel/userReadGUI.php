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
            <table class="table">
                <thead class="thead-dark">
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Área</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Ações</th>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" style="vertical-align: middle;">1241</th>
                        <td style="vertical-align: middle;">Lawrence</td>
                        <td style="vertical-align: middle;">lawrence@gmail.com</td>
                        <td style="vertical-align: middle;">Ciências humanas</td>
                        <td style="vertical-align: middle;">Geografia</td>
                        <td style="vertical-align: middle;"><img data-toggle="dropdown" class="rounded-circle d-inline-block" style="width: 64px; height: 64px" src="/images/users/2.jpeg?1605727946"></td>
                        <td class="d-flex flex-row justify-content-around">
                            <a class="mt-3" href=""><img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/eye.svg" alt=""></a>
                            <a class="mt-3" href=""><img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil.svg" alt=""></a>
                            <a class="mt-3" href=""><img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle.svg" alt=""></a>
                        </td>
                    </tr>
                    
                </tbody>

            </table>
        </div>
    </main>




    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>