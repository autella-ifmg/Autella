<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questões</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor/build/ckeditor.js"></script>
    <?php
    require_once "readSQL.php";
    require_once "../../libraries/ckeditor/CKEditorImport.php";
    ?>
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
            <div class="d-flex flex-row justify-content-between mb-3">
                <a id="button_back" href="../../views/home.php" type="button" class="btn btn-primary w-25 mr-5">Voltar</a>
                <a id="archive" type="button" class="btn btn-info w-25 mr-5">Visualizar questões arquivadas</a>
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

    <!--Toast genérico-->
    <?php require_once '../../views/genericToast.php'; ?>

    <!--Importação das funções .js utilizadas nessa página-->
    <script src="../../utilities/jsFunctions/question/verifications.js"></script>
    <script src="../../utilities/jsFunctions/question/filtersSystem.js"></script>
    <script src="../../utilities/jsFunctions/question/selects.js"></script>
    <script src="../../utilities/jsFunctions/question/forIcons.js"></script>
    <script src="../../utilities/jsFunctions/question/easterEgg.js"></script>

    <script>
        //Sequência de instanciação de variáveis globais oriundas do php que são utilizadas por funções '.js'.
        <?php
        //Array global com as questões que estão sendo exibidas.
        $js_var = json_encode($questions);
        echo "questions = " . $js_var . ";\n";

        //Variável global com o id_role do usário atual.
        $js_var = json_encode($id_role);
        echo "id_role = Number(" . $js_var . ");\n";

        if ($id_role != 5) {
            //Variável global com o id_institution do usário atual.
            $js_var = json_encode($id_institution);
            echo "id_institution = Number(" . $js_var . ");\n";
        } else {
            //Variável global com o id_institution do usário atual.
            $js_var = json_encode($questions[0][6]);
            echo "id_institution = Number(" . $js_var . ");\n";
        }

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

        //Array global que armazena temporariamente o(s) filtro(s) escolhido(s).
        echo "appliedFilters = [[], [], [], []];\n";

        //Array global que armazena informações sobre o(s) filtro(s) escolhido(s).
        echo gatheringInfoForFiltersSystem();

        //Variável global que informa a função da página atual.
        echo "page_action = 1;\n";

        //Variável global que irá armazenar a última ação do usuário.
        echo "action_performed = 0;\n";
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

        <?php
        if (isset($_GET['action_performed'])) {
            //Variável global que informa se alguma questão foi criada/editada e armazena o resultado da respectiva ação.
            $php_var = empty($_SESSION['debug']) ? "" : $_SESSION['debug'][count($_SESSION['debug']) - 1];
            $js_var = json_encode($php_var, JSON_UNESCAPED_UNICODE);
            echo "result = " . $js_var . ";\n";

            //Variável global que informa qual foi a última ação (criação/edição) do usuário.
            $php_var =  $_GET['action_performed'];
            $js_var = json_encode($php_var);
            echo "action_performed = Number(" . $js_var . ");\n";

            //Quando o documento estiver carregado, executa o método toastForCreationAndEditing().
            $js_var = 'document.addEventListener("DOMContentLoaded", toastForCreationAndEditing(), false);';
            echo $js_var . "\n";
        }
        ?>
    </script>

    <!--CKEditor-->
    <?php forRead($questions); ?>
</body>

</html>