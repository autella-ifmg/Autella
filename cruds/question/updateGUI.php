<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Alterar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';
    //require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php'; class="needs-validation"
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';

    $id_role = $_SESSION["userData"]["id_role"];

    $filter[0] = null;
    $filter[1] = null;
    $filter[2] = null;
    $filter[3] = null;
    $filter[4] = 1;

    $array = selectQuestions(false, 0, 0, $filter);
    //var_dump($array);
    $questionNumber = $_GET["questionNumber"] - 1;
    //echo $questionNumber;
    $arrayUpdate = $array[$questionNumber];
    //var_dump($arrayUpdate);
    ?>
</head>

<body>
    <h1 class="text-center mt-3 mb-1">Autella <span class="d-none d-sm-inline">| Alterar dados da questão</span></h1>

    <hr>
    
    <section class="d-flex justify-content-center mt-4">
        <div class="d-flex flex-column">
            <form id="questionForm" action="updateSQL.php" method="post">
                <input name="id" type="hidden" value="<?php echo $arrayUpdate[0]; ?>">
                <div class="d-flex flex-row mb-2">
                    <!--Select disciplina-->
                    <div id="selectDiscipline_container" class="w-25 mt-1 mr-3" hidden>
                        <label for="disciplines">Disciplina:</label>
                        <select name="disciplines" id="disciplines" class="form-control" onchange="updateSelects()">
                            <?php disciplineNames(2); ?>
                        </select>
                    </div>
                    <!--Select matérias-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="subjects">Matéria:</label>
                        <select name="subjects" id="subjects" class="form-control" required>
                            <!--updateSelects()-->
                        </select>
                    </div>
                    <!--Select dificuldade-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="dificulty">Dificuldade:</label>
                        <select name="dificulty" id="dificulty" class="form-control" required>
                            <option id="d1" value="1">Fácil</option>
                            <option id="d2" value="2">Média</option>
                            <option id="d3" value="3">Difícil</option>
                        </select>
                    </div>
                    <!--Select alternativa correta-->
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
                    <div name="editor" id="editor" style="max-width: 65rem; min-height: 20rem; max-height: 20rem; border: 1px solid gray;"><?php echo $arrayUpdate["enunciate"]; ?></div>
                </div>

                <hr>

                <!--Botões-->
                <div class="d-flex flex-row justify-content-around mb-5">
                    <a href="readGUI.php" type="button" class="w-25 btn btn-danger mr-2">Cancelar</a>
                    <button name="submit" id="submit" type="submit" class="w-25 btn btn-success">Alterar</button>
                </div>
            </form>
        </div>
    </section>


    <script>
        //Função para inserir as matérias no selectSubject.
        function updateSelects() {
            <?php
            $disciplineSelected = json_encode($arrayUpdate[8]);
            $subjectSelected = json_encode($arrayUpdate["name"]);
            $dificultySelected = json_encode($arrayUpdate["dificulty"]);
            $correctAnswerSelected = json_encode($arrayUpdate["correctAnswer"]);

            echo "
            var disciplineSelected = " . $disciplineSelected . ";\n
            var subjectSelected = " . $subjectSelected . ";\n
            var dificultySelected = " . $dificultySelected . ";\n
            var correctAnswerSelected = " . $correctAnswerSelected . ";
            ";
            ?>

            //Discipline
            var disciplineOption = document.getElementById(disciplineSelected);
            disciplineOption.setAttribute("selected", "selected");

            var selectDiscipline = document.getElementById("disciplines");
            selectDiscipline = selectDiscipline.value;

            //Subject
            var selectSubjects = document.getElementById("subjects");
            selectSubjects.innerHTML = "";

            <?php
            $php_array = selectSubjects();
            $js_array = json_encode($php_array);
            echo "var subjects = " . $js_array . ";\n";
            ?>

            for (let i = 0; i < subjects.length; i++) {
                if (subjects[i][1] == selectDiscipline) {
                    let option = document.createElement("option");
                    option.setAttribute("value", `${subjects[i][0]}`);
                    option.setAttribute("label", `${subjects[i][2]}`);

                    if (subjects[i][2] == subjectSelected) {
                        option.setAttribute("selected", "selected");
                    }

                    selectSubjects.appendChild(option);
                }
            }

            //Dificulty
            var dificultyOption = document.getElementById(`d${dificultySelected}`);
            dificultyOption.setAttribute("selected", "selected");

            //Correct Answer
            var correctAnswerOption = document.getElementById(`option${correctAnswerSelected}`);
            correctAnswerOption.setAttribute("selected", "selected");
        }
        //Quando o documento estiver carregado, executa o método updateSelects().
        document.addEventListener("DOMContentLoaded", updateSelects(), false);

        //Função para realizar a conexão CKEditor - MySQL.-
        document.querySelector("#submit").addEventListener("click", () => {
            var editorData = document.querySelector("#editor").children;

            var string = "";
            for (let i = 0; i < editorData.length; i++) {
                string += editorData[i].outerHTML;
                string += "\n";
            }
            var invisibleInput = document.createElement("input");
            invisibleInput.setAttribute("name", "enunciate");
            invisibleInput.setAttribute("id", "enunciate");
            invisibleInput.setAttribute("type", "text");
            invisibleInput.setAttribute("value", `${string}`);
            invisibleInput.setAttribute("style", "display: none");

            var form = document.getElementById("#questionForm");
            questionForm.appendChild(invisibleInput);
        });

        //Verifica se um coordenador que está logado.
        <?php
        if ($id_role == 1) {
            echo '
        var div = document.getElementById("selectDiscipline_container");
    
        div.removeAttribute("hidden");
        ';
        }
        ?>
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