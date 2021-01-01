<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questões arquivadas</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor/ckeditor.js"></script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/discipline.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/question.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/question_test.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/subject.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once "readSQL.php";
    ?>
</head>

<body>
    <?php require_once '../../views/navbar.php'; ?>

    <!--Toast genérico-->
    <?php require_once '../../views/genericToast.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row mb-3">
                <!--Botão filtrar-->
                <div class="w-auto mt-1 mr-3">
                    <a id="filter" onclick="filter(0, 0)"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/filter-square-fill.svg" alt="Aplicar filtros" height="75" data-toggle="tooltip" data-placement="top" title="Aplicar filtros"> </a>
                </div>
                <!--Filtros-->
                <?php require_once '../../views/filters.php'; ?>
            </div>

            <!--Botões-->
            <div class="d-flex flex-row justify-content-center mb-3">
                <a id="unarchive" type="button" class="btn btn-info w-25" onclick="filter(1, 1)">Visualizar questões habilitadas</a>
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
        $js_var = json_encode($questions);
        echo "questions = " . $js_var . ";\n";

        //Variável global com o id_role do usário atual.
        $js_var = json_encode($id_role);
        echo "id_role = Number(" . $js_var . ");\n";

        //Variável global com o id_discipline do usário atual.
        $js_var = json_encode($id_discipline);
        echo "id_discipline = Number(" . $js_var . ");\n";

        //Array global com todas as matérias registradas.
        $php_array = selectSubjects();
        $js_array = json_encode($php_array);
        echo "subjects = " . $js_array . ";\n";

        //Variável global que informa se há ou não questões sendo exibidas.
        if (empty($questions)) {
            echo "arrayIsEmpty = true;\n";
        } else {
            echo "arrayIsEmpty = false;\n";
        }
        ?>

        //Variável global que informa a função da página atual.
        action_pag = 0;

        //Quando o documento estiver carregado, executa o método verifyRole().
        document.addEventListener("DOMContentLoaded", verifyRole(), false);

        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);

        //Quando o documento estiver carregado, executa o método updateDropdownHeader().
        document.addEventListener("DOMContentLoaded", updateDropdownHeader(), false);

        function updateDropdownHeader() {
            if (action_pag == 0) {
                $("#dropdownHeader").html("Questão estava inclusa em:");
            } else if (action_pag == 1) {
                $("#dropdownHeader").html("Questão inclusa em:");
            }
        }
    </script>

    <!--CKEditor-->
    <script>
        <?php imports($questions); ?>
    </script>
</body>

</html>