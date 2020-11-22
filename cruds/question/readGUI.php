<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <?php
    //Inicia a sessão.
    session_start();

    require_once "../../utilities/dbSelect.php";
    require_once "readSQL.php";
    //Obtém o cargo do usuário que está logado no momento.
    $id_role = $_SESSION["userData"]["id_role"];
    //Obtém o id da disciplina correspondente ao usuário que está logado no momento.
    $id_discipline = $_SESSION["userData"]["id_discipline"];
    //var_dump($id_discipline);

    //Total de itens por página
    $totalItems = 5;
    //Obtém a página atual
    $current = intval($_GET["pag"]) * $totalItems;;
    //var_dump($current);

    $array = selectQuestions($id_discipline, $current, $totalItems, true);
    //var_dump($array);
    $totalRows = count($aux = selectQuestions($id_discipline, 0, 0, false));
    //var_dump($totalRows);

    $totalPages = ceil($totalRows / $totalItems);
    //var_dump($totalPages);
    ?>
</head>

<body>
    <!--Inclui a navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <form method="post">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-around mt-3 mb-3">
                    <!--Botão para voltar-->
                    <a href="../../views/home.php" type="button" class="btn btn-primary w-25  mr-5">Voltar</a>

                    <!--Select das disciplinas-->
                    <div id="container_selectDisciplines" class="w-25 ml-5 mr-5" hidden>

                        <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                            <?php
                            disciplineNames();
                            ?>
                        </select>
                    </div>

                    <!--Botão para criar questões-->
                    <a href="createGUI.php" type="button" class="btn btn-primary w-25 ml-5">Criar questão</a>

                </div>

                <?php data($array, $id_discipline, $id_role); ?>
            </div>
        </form>
    </section>

    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="readGUI.php?pag=0" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Anterior</span>
            </a>
        </li>
        <?php for ($i = 0; $i < $totalPages; $i++) {
            $style = "";

            if ($current == $i) {
                $style = "active";
            }
        ?>
            <li><a class="page-link <?php echo $style; ?>" href="readGUI.php?pag=<?php echo $i; ?>"><?php echo $i + 1; ?></a></li>
        <?php } ?>
        <li class="page-item">
            <a class="page-link" href="readGUI.php?pag=<?php echo $totalPages - 1; ?>" aria-label="Próximo">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Próximo</span>
            </a>
        </li>
    </ul>


    <script>
        <?php selectControl($id_role); ?>
    </script>

    <!--Importações do Bootstrap-->
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <script>
        <?php imports($array, $id_discipline); ?>
    </script>
</body>

</html>