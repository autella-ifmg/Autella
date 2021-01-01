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
                    <a id="filter" onclick="filter(1, 1)"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/filter-square-fill.svg" alt="Aplicar filtros" height="75" data-toggle="tooltip" data-placement="top" title="Aplicar filtros"> </a>
                </div>
                <!--Filtros-->
                <?php require_once '../../views/filters.php'; ?>
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
        action_pag = 1;

        action_per = 0;
        //Quando o documento estiver carregado, executa o método verifyRole().
        document.addEventListener("DOMContentLoaded", verifyRole(), false);

        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);

        //Quando o documento estiver carregado, executa o método genericToast_CEQ().
        //document.addEventListener("DOMContentLoaded", genericToastCEQ(), false);

        <?php
        if (isset($_GET['action_per'])) {
            //Variável global que informa se alguma questão foi criada/editada.
            $php_var = empty($_SESSION['debug']) ? "" : $_SESSION['debug'][count($_SESSION['debug']) - 1];
            $js_var = json_encode($php_var, JSON_UNESCAPED_UNICODE);
            echo "result = " . $js_var . ";\n";

            //Variável global que informa qual foi a última ação (criação/edição) do usuário.
            $php_var =  $_GET['action_per'];
            $js_var = json_encode($php_var);
            echo "action_per = Number(" . $js_var . ");\n";

            //Quando o documento estiver carregado, executa o método genericToastCEQ().
            $js_var = 'document.addEventListener("DOMContentLoaded", genericToastCEQ(), false);';
            echo $js_var."\n";
        }
        ?>

        //Gera os toasts referentes às ações de criar e editar questão.
        function genericToastCEQ() {
            if (action_per == 1) {
                $("#img_toast").attr({
                    src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/journal-x.svg",
                    alt: "Criar questão"
                });

                if (result == "Questão criada com sucesso!") {
                    $("#span_toast").text("Sucesso!");
                } else if (result == "Erro ao criar questão!") {
                    $("#span_toast").text("Erro!");
                }
            } else {
                $("#img_toast").attr({
                    src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg",
                    alt: "Editar questão"
                });

                if (result == "Questão editada com sucesso!") {
                    $("#span_toast").text("Sucesso!");
                } else if (result == "Erro ao editar questão!") {
                    $("#span_toast").text("Erro!");
                }
            }

            $("#result").html(result).fadeIn();
            $("#toast").toast("show");
            window.history.pushState({}, "Autella | Visualizar questões", "/cruds/question/readGUI.php?");
            //console.log(result);
        }
    </script>

    <!--CKEditor-->
    <script>
        <?php imports($questions); ?>
    </script>
</body>

</html>