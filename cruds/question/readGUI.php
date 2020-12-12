<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questões</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor/ckeditor.js"></script>
    <?php
    require_once "../../utilities/dbSelect.php";
    require_once "readSQL.php";
    ?>
</head>

<body onload="verifyRole()">
    <?php require_once '../../views/navbar.php'; ?>

    <!--Toast genérico-->
    <?php require_once '../../views/genericToast.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <!--Filtros-->
        <div class="d-flex flex-column">
            <div class="d-flex flex-row mb-3">
                <!--Botão filtrar-->
                <div class="w-auto mt-1 mr-3">
                    <a id="filter" onclick="filter(1, 1)"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/filter-square-fill.svg" alt="Aplicar filtros" height="75" data-toggle="tooltip" data-placement="top" title="Aplicar filtros"> </a>
                </div>
                <!--Filtro - disciplina-->
                <div id="container_selectDiscipline" class="w-25 mt-1 mr-3" hidden>
                    <label for="disciplines">Disciplina:</label>
                    <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                        <?php disciplineNames(1); ?>
                    </select>
                </div>
                <!--Filtro - matéria-->
                <div name="container_select" class="w-25 mt-1 mr-3">
                    <label for="subjects">Matéria:</label>
                    <select name="subjects" id="subjects" class="form-control">
                        <!--updateSubjects()-->
                    </select>
                </div>
                <!--Filtro - dificuldade-->
                <div name="container_select" class="w-25 mt-1 mr-3">
                    <label for="dificulty">Dificuldade:</label>
                    <select name="dificulty" id="dificulty" class="form-control">
                        <option value="" selected>Escolha...</option>
                        <option value="1">Fácil</option>
                        <option value="2">Média</option>
                        <option value="3">Difícil</option>
                    </select>
                </div>
                <!--Filtro - data-->
                <div name="container_select" class="w-25 mt-1">
                    <label for="date">Data de criação:</label>
                    <input id="date" type="date" class="form-control">
                </div>
            </div>

            <!--Botões-->
            <div class="d-flex flex-row justify-content-between mb-3">
                <a href="../../views/home.php" type="button" class="btn btn-primary w-25 mr-5">Voltar</a>
                <a id="archive" type="button" class="btn btn-info w-25 mr-5" onclick="filter(0, 0)">Visualizar questões arquivadas</a>
                <a href="createGUI.php" type="button" class="btn btn-primary w-25">Criar questão</a>
            </div>

            <!--Blocos de questões-->
            <div> <?php questionBlocks($questions, $id_role); ?> </div>

            <!--Paginação-->
            <?php require_once '../../views/pagination.php'; ?>
        </div>
    </section>

    <!--Modal genérico-->
    <?php require_once '../../views/genericModal.php'; ?>

    <!--Importação das funções .js utilizadas nessa página-->
    <script src="../../utilities/functionsForQuestion.js"></script>

    <script>
        <?php
        //Array global com as questões que estão sendo exibidas.
        $php_array = json_encode($questions);
        echo "questions = " . $php_array . ";\n";

        //Variável global com o id_role atual.
        $php_var = json_encode($id_role);
        echo "id_role = Number(" . $php_var . ");\n";

        //Variável global com o id_discipline atual.
        $php_var = json_encode($id_discipline);
        echo "id_discipline = Number(" . $php_var . ");\n";

        //Array global com todas as matérias registradas.
        $php_array = selectSubjects();
        $js_array = json_encode($php_array);
        echo "subjects = " . $js_array . ";\n";

        //Variável global que informa se há ou não questõe sendo exibidas.
        if (empty($questions)) {
            echo "arrayIsEmpty = true;\n";
        } else {
            echo "arrayIsEmpty = false;\n";
        }
        ?>

        //Variável global que informa a função da página atual.
        action_pag = 1;

        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);
    </script>

    <!--CKEditor-->
    <script>
        <?php imports($questions); ?>
    </script>
</body>

</html>