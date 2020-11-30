<!DOCTYPE html>
<html class="w-100 h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once "createSQL.php";
    ?>
</head>

<body>
    <?php require_once '../../views/navbar.php'; ?>

    <form id="questionForm" action="createSQL.php" method="post" class="needs-validation">
        <section class="d-flex justify-content-center mt-4">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row mb-2">
                    <!--Select disciplina-->
                    <div id="selectDiscipline_container" class="w-25 mt-1 mr-3" hidden>
                        <label for="disciplines">Disciplina:</label>
                        <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                            <?php disciplineNames(0); ?>
                        </select>
                    </div>
                    <!--Select matérias-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="subjects">Matéria:</label>
                        <select name="subjects" id="subjects" class="form-control" autofocus required>
                            <!--updateSubjects()-->
                        </select>
                    </div>
                    <!--Select dificuldade-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="dificulty">Dificuldade:</label>
                        <select name="dificulty" id="dificulty" class="form-control" required>
                            <option value="1">Fácil</option>
                            <option value="2">Média</option>
                            <option value="3">Difícil</option>
                        </select>
                    </div>
                    <!--Select número de alternativas-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="alternativesQuant">Nº de alternativas:</label>
                        <select name="alternativesQuant" id="alternativesQuant" class="form-control" onchange="updateCorrectAnswerSelect_AlternativesField()" required>
                            <option value=>Escolha...</option>
                            <option value=4>4</option>
                            <option value=5>5</option>
                        </select>
                    </div>
                    <!--Select alternativa correta-->
                    <div class="w-25 mt-1">
                        <label for="correctAnswer">Alternativa correta:</label>
                        <select name="correctAnswer" id="correctAnswer" class="form-control" disabled required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option id="optionE" value="E">E</option>
                        </select>
                    </div>
                </div>

                <!--Enunciado da questão-->
                <div>
                    <div name="toolbar" id="toolbar-container"></div>
                    <div name="editor" id="editor" style="max-width: 65rem; min-height: 20rem; max-height: 20rem; border: 1px solid gray;"></div>
                </div>

                <!--Alternativas-->
                <div class="d-flex justify-content-center">
                    <div id="alternatives_container" class="d-flex flex-column mt-3"></div>
                </div>

                <!--Botões-->
                <div class="d-flex flex-row justify-content-center mb-5">
                    <a href="readGUI.php" type="button" class="w-25 btn btn-danger mr-2">Cancelar</a>
                    <button name="submit" id="submit" type="submit" class="w-25 btn btn-success">Adicionar</button>
                </div>
            </div>
        </section>
    </form>

    <!--Funções que unem .js e .php-->
    <script>
        //Função para inserir as matérias no selectSubject.
        function updateSubjects() {
            var selectDiscipline = document.getElementById("disciplines");
            selectDiscipline = selectDiscipline.value;

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
                    selectSubjects.appendChild(option);
                }
            }
        }
        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);

        //Função para atualizar o select correctAnswer e gerar o campo de texto das alternativas.
        function updateCorrectAnswerSelect_AlternativesField() {
            var alternativesQuant = document.getElementById("alternativesQuant");
            alternativesQuant = alternativesQuant.value;

            var selectCorrectAnswer = document.getElementById("correctAnswer");
            selectCorrectAnswer.removeAttribute("disabled");

            var optionE = document.getElementById("optionE");

            if (alternativesQuant == 4) {
                optionE.setAttribute("hidden", "true");
            } else if (alternativesQuant == 5) {
                optionE.removeAttribute("hidden");
            } else {
                selectCorrectAnswer.setAttribute("disabled", "true");
            }

            var alternatives_container = document.getElementById(
                "alternatives_container"
            );
            alternatives_container.innerHTML = "";

            alternatives = ["A", "B", "C", "D", "E"];

            for (let i = 0; i < alternativesQuant; i++) {
                let div = document.createElement("div");
                div.setAttribute("id", "div_container");
                div.setAttribute("class", "d-flex flex-row");
                alternatives_container.appendChild(div);
                let img = document.createElement("img");
                img.setAttribute("src", `../../images/alternatives/${alternatives[i]}.png`);
                img.setAttribute("alt", alternatives[i]);
                img.setAttribute("class", "bg-info rounded-circle mr-1 mb-3");
                div.appendChild(img);
                let textarea = document.createElement("textarea");
                textarea.setAttribute("name", `question${i}`);
                textarea.setAttribute("id", `question${i}`);
                textarea.setAttribute("cols", "120");
                textarea.setAttribute("rows", "3");
                textarea.setAttribute("class", "ml-1 mb-3 rounded");
                textarea.setAttribute("style", "resize: none;");
                textarea.setAttribute(
                    "placeholder",
                    "Insira o enunciado da alternativa..."
                );
                textarea.setAttribute("required", "true");
                div.appendChild(textarea);
            }
        }

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
            invisibleInput.setAttribute("value", string);
            invisibleInput.setAttribute("style", "display: none");
            var form = document.getElementById("#questionForm");
            questionForm.appendChild(invisibleInput);
        });

        //Verifica se um coordenador que está logado.
        <?php
        if ($id_role == 1) {
            echo '
                 var div = document.getElementById("selectDiscipline_container");
               
                 div.removeAttribute("hidden");';
        }
        ?>
    </script>

    <!--Importação das funções .js-->
    <script src="createJS.js"></script>

    <!--Importação do Bootstrap-->
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
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