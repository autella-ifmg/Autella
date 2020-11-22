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
    //var_dump($_SESSION);
    require_once "../../utilities/dbSelect.php";
    require_once "readSQL.php";
    //Obtém o cargo do usuário que está logado no momento.
    $id_role = $_SESSION["userData"]["id_role"];
    //Obtém o id da disciplina correspondente ao usuário que está logado no momento.
    $id_discipline = $_SESSION["userData"]["id_discipline"];
    //var_dump($id_discipline);
    
    $array = selectQuestions($id_discipline);
    //var_dump($array);
    //$rowsQuant = selectRowsQuantTableQuestion($id_discipline);
    //var_dump($rowsQuant);
    //Define o número de items por página.
    $itemsQuant = 5;

    //$current = intval($_GET["readGUI"]);

    //$pagsQuant = ceil($rowsQuant / $itemsQuant);

    //$sql = "SELECT * FROM question WHERE id_user = '$id_user' LIMIT $current, $itemsQuant;";
    //$result = mysqli_query($connection, $sql);
    //$array = [];

    //if (mysqli_num_rows($result) != 0) {
        //while ($row = mysqli_fetch_row($result)) {
            //array_push($array, $row);
        //}
        // array_push($_SESSION['debug'], "Disciplinas selecionadas com sucesso!");
    //}
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
                            disciplineNames($id_discipline, 0);
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

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <?php
            //for ($i = 0; $i < $pagsQuant; $i++) {
           // }

            ?>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

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