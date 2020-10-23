<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar questão</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div id="toolbar-container"></div>
        <div id="editor" style="height: 20rem; background-color: rgb(250, 250, 250)">
            <p>Uma locadora possui disponíveis 120 veículos da categoria que um cliente pretende locar.
                Desses, 20% são da cor branca, 40% são da cor cinza, 16 veículos são da cor vermelha e o restante, de outras cores.
                O cliente não gosta da cor vermelha e ficaria contente com qualquer outra cor, mas o sistema de controle
                disponibiliza os veículos sem levar em conta a escolha da cor pelo cliente. Disponibilizando aleatoriamente,
                qual é a probabilidade de o cliente ficar contente com a cor do veículo?
            </p>
            <p>(A) 16/120</p>
            <p>B 32/120</p>
            <p>C 72/120</p>
            <p>D 101/120</p>
            <p>E 104/120</p>
        </div>
    </div>

    <script src="../bootstrap/jquery-3.5.1.js"></script>
    <script src="../bootstrap/bootstrap.bundle.js"></script>
    <script src="../ckeditor5/ckeditor.js"></script>

    <script>
        DecoupledEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>