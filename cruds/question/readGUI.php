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

    //Obtém a página atual
    $current = intval(isset($_GET["pag"]) ? $_GET["pag"] : 1);
    var_dump($current);

    //Total de itens por página
    $end = 5;

    //Início da exibicação
    $start = ($end * $current) - $end;

    $array = selectQuestions($id_discipline, $start, $end, true);
    //var_dump($array);
    $totalRows = count($aux = selectQuestions($id_discipline, 0, 0, false));
    //var_dump($totalRows);

    $totalPages = ceil($totalRows / $end);
    //var_dump($totalPages);

   

    ?>
</head>

<body>
    <!--Inclui a navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
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


            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="readGUI.php?pag=<?php echo $current >= 1 ? 1 : $current - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) {
                    $style = "";

                    if ($current == $i) {
                        $style = "active";
                    }
                ?>
                    <li><a class="page-link <?php echo $style; ?>" href="readGUI.php?pag=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li class="page-item">
                    <a class="page-link" href="readGUI.php?pag=<?php echo $current < $totalPages ? $current + 1 : $totalPages; ?>" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>

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