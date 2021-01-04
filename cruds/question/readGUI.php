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
    <?php require_once "readSQL.php"; ?>
</head>

<body>
    <!--Navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <!--Toast genérico-->
    <?php require_once '../../views/genericToast.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row mb-3">
                <!--Ícone do sistema de filtragem-->
                <div class="w-auto mt-1 ml-1 mr-4">
                    <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/filter-circle-fill.svg" alt="Sistema de Filtragem" height="75" data-toggle="tooltip" data-placement="top" title="Sistema de Filtragem">
                </div>

                <!--Estrutura para selecionar filtros-->
                <?php require_once '../../views/filtrationSystem/choosingFilters.php'; ?>
            </div>

            <!--Filtros aplicados-->
            <?php require_once '../../views/filtrationSystem/appliedFilters.php'; ?>

            <!--Botões-->
            <div class="d-flex flex-row justify-content-between mb-3">
                <a href="../../views/home.php" type="button" class="btn btn-primary w-25 mr-5">Voltar</a>
                <a id="archive" type="button" class="btn btn-info w-25 mr-5" onclick="redirection()">Visualizar questões arquivadas</a>
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
    <script src="../../utilities/jsFunctions/question/question.js"></script>
    <script src="../../utilities/jsFunctions/question/filter.js"></script>

    <script>
        <?php
        //Sequência de instanciação de variáveis globais que são utilizadas por funções .js

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

        //Array global com todas as disciplinas registradas.
        $php_array = selectDisciplines();
        $js_array = json_encode($php_array);
        echo "disciplines = " . $js_array . ";\n";

        //Variável global que informa se há ou não questões sendo exibidas.
        if (empty($questions)) {
            echo "arrayIsEmpty = true;\n";
        } else {
            echo "arrayIsEmpty = false;\n";
        }

        //Arrat global que armazena o(s) filtro(s) escolhido(s).
        echo "appliedFilters = [[], [], [], []];\n";
        echo infosToBlockSelects();

        //Variável global que informa a função da página atual.
        echo "action_pag = 1;\n";

        //Variável global que irá armazenar a última ação do usuário.
        echo "action_per = 0;\n";
        ?>

        url = "";

      

        function redirection() {
            if (action_pag == 0) {
                var unarchive_btn = document.getElementById("unarchive");
                unarchive_btn.setAttribute("href", "http://autella.com/cruds/question/readGUI.php?");
            } else {
                var archive_btn = document.getElementById("archive");
                archive_btn.setAttribute("href", "http://autella.com/cruds/question/archiveGUI.php?filter=true&status=0");
            }
        }

        //Quando o documento estiver carregado, executa o método verifyRole().
        document.addEventListener("DOMContentLoaded", verifyRole(), false);

        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);

        //Quando o documento estiver carregado, executa o método updateDropdownHeader().
        document.addEventListener("DOMContentLoaded", updateDropdownHeader(), false);

        //Quando o documento estiver carregado, executa o método blockFilterSelects().
        document.addEventListener("DOMContentLoaded", blockFilterSelects(), false);

        <?php
        if (isset($_GET['action_per'])) {
            //Variável global que informa se alguma questão foi criada/editada e armazena o resultado da respectiva ação.
            $php_var = empty($_SESSION['debug']) ? "" : $_SESSION['debug'][count($_SESSION['debug']) - 1];
            $js_var = json_encode($php_var, JSON_UNESCAPED_UNICODE);
            echo "result = " . $js_var . ";\n";

            //Variável global que informa qual foi a última ação (criação/edição) do usuário.
            $php_var =  $_GET['action_per'];
            $js_var = json_encode($php_var);
            echo "action_per = Number(" . $js_var . ");\n";

            //Quando o documento estiver carregado, executa o método genericToastCEQ().
            $js_var = 'document.addEventListener("DOMContentLoaded", genericToastCEQ(), false);';
            echo $js_var . "\n";
        }
        ?>
    </script>

    <!--CKEditor-->
    <script>
        <?php imports($questions); ?>
    </script>
</body>

</html>