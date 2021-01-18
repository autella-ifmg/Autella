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
    <?php require_once "readSQL.php"; ?>
</head>

<body>
    <!--Navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <!--Estrutura para selecionar filtros-->
            <?php require_once '../../views/filtersSystem/choosingFilters.php'; ?>

            <!--Filtros aplicados-->
            <?php require_once '../../views/filtersSystem/appliedFilters.php'; ?>

            <!--Botões-->
            <div class="d-flex justify-content-center mb-3">
                <a id="unarchive" type="button" class="btn btn-info w-25">Visualizar questões habilitadas</a>
            </div>

            <!--Blocos de questões-->
            <div> <?php questionBlocks($questions, $id_role); ?> </div>

            <!--Paginação-->
            <?php require_once '../../views/pagination.php'; ?>
        </div>
    </section>

    <!--Modal genérico-->
    <?php require_once '../../views/genericModal.php'; ?>

    <!--Toast genérico-->
    <?php require_once '../../views/genericToast.php'; ?>

    <!--Importação das funções .js utilizadas nessa página-->
    <script src="../../utilities/jsFunctions/question/verifications.js"></script>
    <script src="../../utilities/jsFunctions/question/filter.js"></script>
    <script src="../../utilities/jsFunctions/question/selects.js"></script>
    <script src="../../utilities/jsFunctions/question/forIcons.js"></script>
    <script src="../../utilities/jsFunctions/question/easterEgg.js"></script>

    <script>
        //Sequência de instanciação de variáveis globais oriundas do php que são utilizadas por funções '.js'.
        <?php
        //Array global com as questões que estão sendo exibidas.
        $js_var = json_encode($questions);
        echo "questions = " . $js_var . ";\n";

        //Variável global com o id_role do usuário atual.
        $js_var = json_encode($id_role);
        echo "id_role = Number(" . $js_var . ");\n";

        //Variável global com o id_discipline do usuário atual.
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

        //Array global que armazena temporariamente o(s) filtro(s) escolhido(s).
        echo "appliedFilters = [[], [], [], []];\n";

        //Array global que coleta da url informações sobre o(s) filtro(s) escolhido(s).
        echo gatheringInfoForFiltersSystem();

        //Variável global que informa a função da página atual.
        echo "page_action = 0;\n";
        ?>

        //Quando o documento estiver carregado, executa o método verifyPageAction().
        document.addEventListener("DOMContentLoaded", verifyPageAction(), false);

        //Quando o documento estiver carregado, executa o método verifyRole().
        document.addEventListener("DOMContentLoaded", verifyRole(), false);

        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);

        //Quando o documento estiver carregado, executa o método updateDropdownHeader().
        document.addEventListener("DOMContentLoaded", updateDropdownHeader(), false);

        //Quando o documento estiver carregado, executa o método blockFilterSelects().
        document.addEventListener("DOMContentLoaded", blockFilterSelects(), false);
    </script>

    <!--CKEditor-->
    <script>
        <?php imports($questions); ?>
    </script>
</body>

</html>