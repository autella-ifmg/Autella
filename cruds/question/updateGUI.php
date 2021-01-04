<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Editar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor/ckeditor.js"></script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/discipline.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/question.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/subject.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';

    $id_role = $_SESSION["userData"]["id_role"];
    //var_dump($id_role);

    $filter[0] = null;
    $filter[1] = null;
    $filter[2] = null;
    $filter[3] = null;
    $filter[4] = 1;

    $questions = selectQuestions(false, 0, 0, $filter);
    //var_dump($questions);

    $question_id_update = $_GET["question_id_update"];
    //var_dump($question_id_update);

    for ($i = 0; $i < count($questions); $i++) {
        if ($questions[$i][0] == $question_id_update) {
            $questionForUpdate = $questions[$i];
        }
    }
    //var_dump($questionForUpdate);
    ?>
</head>

<body>
    <h1 class="text-center mt-3 mb-1">Autella <span class="d-none d-sm-inline">| Editar dados da questão</span></h1>

    <hr>

    <section class="d-flex justify-content-center mt-4">
        <div class="d-flex flex-column">
            <form id="questionForm" action="updateSQL.php" method="post">
                <input name="id" type="hidden" value="<?php echo $questionForUpdate[0]; ?>">

                <div class="d-flex flex-row justify-content-between mb-2">
                    <!--Select - disciplina-->
                    <div id="disciplineSelection_container" class="w-25 mt-1 mr-3" hidden>
                        <label for="disciplines">Disciplina:</label>
                        <select name="disciplines" id="disciplines" class="form-control" onchange="updateSelects()">
                            <?php selectDisciplineNamesToDropdowns(2); ?>
                        </select>
                    </div>
                    <!--Select - matérias-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="subjects">Matéria:</label>
                        <select name="subjects" id="subjects" class="form-control" required>
                            <!--updateSelects()-->
                        </select>
                    </div>
                    <!--Select - dificuldade-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="dificulty">Dificuldade:</label>
                        <select name="dificulty" id="dificulty" class="form-control" required>
                            <option id="d1" value="1">Fácil</option>
                            <option id="d2" value="2">Média</option>
                            <option id="d3" value="3">Difícil</option>
                        </select>
                    </div>
                    <!--Select - alternativa correta-->
                    <div class="w-25 mt-1">
                        <label for="correctAnswer">Alternativa correta:</label>
                        <select name="correctAnswer" id="correctAnswer" class="form-control" required>
                            <option id="optionA" value="A">A</option>
                            <option id="optionB" value="B">B</option>
                            <option id="optionC" value="C">C</option>
                            <option id="optionD" value="D">D</option>
                            <option id="optionE" value="E">E</option>
                        </select>
                    </div>
                </div>

                <hr>

                <!--Enunciado da questão-->
                <div class="mb-3">
                    <div name="toolbar" id="toolbar-container"></div>
                    <div name="editor" id="editor" style="min-width: 65rem; max-width: 65rem; min-height: 20rem; max-height: 20rem; border: 1px solid gray;"><?php echo $questionForUpdate["enunciate"]; ?></div>
                </div>

                <hr>

                <!--Botões-->
                <div class="d-flex flex-row justify-content-around mb-5">
                    <a href="readGUI.php" type="button" class="w-25 btn btn-danger mr-2">Cancelar</a>
                    <button name="submit" id="submit" type="submit" class="w-25 btn btn-success">Editar</button>
                </div>
            </form>
        </div>
    </section>

    <!--Importação das funções .js utilizadas nessa página-->
    <script src="../../utilities/jsFunctions/question/question.js"></script>
    <script src="../../utilities/jsFunctions/question/filter.js"></script>

    <script>
        <?php
        //Variável global com o id_discipline da questão selecionada.
        $js_var = json_encode($questionForUpdate[8]);
        echo "disciplineSelected = " . $js_var . ";\n";

        //Variável global com o nome da matéria da questão selecionada.
        $js_var = json_encode($questionForUpdate["name"]);
        echo "subjectSelected = " . $js_var . ";\n";

        //Array global com todas as matérias registradas.
        $php_array = selectSubjects();
        $js_array = json_encode($php_array);
        echo "subjects = " . $js_array . ";\n";

        //Variável global com a dificuldade da questão selecionada.
        $js_var = json_encode($questionForUpdate["dificulty"]);
        echo "dificultySelected = " . $js_var . ";\n";

        //Variável global com a alternativa correta da questão selecionada.
        $js_var = json_encode($questionForUpdate["correctAnswer"]);
        echo "correctAnswerSelected = " . $js_var . ";\n";

        //Variável global com o id_role atual.
        $js_var = json_encode($id_role);
        echo "id_role = Number(" . $js_var . ");\n";

        //Variável global que informa a função da página atual.
        echo "page_action = 3;";
        ?>

        //Quando o documento estiver carregado, executa o método verifyRole().
        document.addEventListener("DOMContentLoaded", verifyRole(), false);

        //Quando o documento estiver carregado, executa o método updateSelects().
        document.addEventListener("DOMContentLoaded", updateSelects(), false);

        //Quando o documento estiver carregado, executa o método submitEnunciate().
        document.addEventListener("DOMContentLoaded", submitEnunciate(), false);
    </script>

    <!--CKEditor-->
    <script>
        DecoupledEditor
            .create(document.querySelector('#editor'), {
                placeholder: 'Insira o enunciado da questão...'
            })
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