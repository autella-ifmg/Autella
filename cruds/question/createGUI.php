<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once "createJS.php";

    //Obtém o id do cargo correspondente ao usuário que está logado no momento.
    $id_role = $_SESSION["userData"]["id_role"];
    //var_dump($id_role);

    //Obtém o id da disciplina correspondente ao usuário que está logado no momento.
    $id_discipline = $_SESSION["userData"]["id_discipline"];
    //var_dump($id_discipline);
    ?>
</head>

<body>
    <!--Inclui a navbar-->
    <?php require_once '../../views/navbar.php'; ?>
    <!--Formulário-->
    <form id="questionsForm" action="createSQL.php" method="post" class="needs-validation"">
        <!--Seção principal-->
        <section class=" d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <!--Selects-->
            <div class="d-flex flex-row mb-2">
                <!--Select da disciplina-->
                <div id="container_selectDisciplines" class="w-25 mr-3" hidden>
                    <label id="labelDisciplines" for="disciplines" class="mt-1 mr-2">Disciplina:</label>
                    <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                        <?php disciplineNames($id_discipline, 0); ?>
                    </select>
                </div>
                <!--Select das matérias-->
                <div class="w-25 mr-3">
                    <label for="subjects" class="mt-1 mr-2">Matéria:</label>
                    <select name="subjects" id="subjects" class="form-control" autofocus required>
                        <!--updateSubjects-->
                    </select>
                </div>
                <!--Select da dificuldade-->
                <div class="w-25 mr-3">
                    <label for="dificulty" class="mt-1 mr-2">Dificuldade:</label>
                    <select name="dificulty" id="dificulty" class="form-control" required>
                        <option value="1">Fácil</option>
                        <option value="2">Média</option>
                        <option value="3">Difícil</option>
                    </select>
                </div>
                <!--Select do número de alternativas-->
                <div class="w-25 mr-3">
                    <label for="alternativesQuant" class="mt-1 mr-2">Nº de alternativas:</label>
                    <select name="alternativesQuant" id="alternativesQuant" class="form-control" onchange="updateCorrectAnswerSelect_AlternativesField()" required>
                        <option value=>Escolha...</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                    </select>
                </div>
                <!--Select da alternativa correta-->
                <div class="w-25">
                    <label for="correctAnswer" class="mt-1 mr-2">Alternativa correta:</label>
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
                <!--Barra de ferramentas-->
                <div name="toolbar" id="toolbar-container"></div>
                <!--Campo de texto-->
                <div name="editor" id="editor" style="min-width: 65rem; max-width: 65rem;  min-height: 20rem; max-height: 20rem; border: 1px solid gray;" required></div>
            </div>

            <!--Enunciados das alternativas-->
            <div class="d-flex justify-content-center">
                <div id="alternatives_container" class="d-flex flex-column mt-3"></div>
            </div>

            <!--Seção dos botões-->
            <div class="d-flex flex-row justify-content-center mb-5">
                <!--Botão para cancelar-->
                <a href="readGUI.php" type="button" class="w-25 btn btn-danger mr-2">Cancelar</a>
                <!--Botão para adicionar-->
                <button name="submit" id="submit" type="submit" class="w-25 btn btn-success">Adicionar</button>
            </div>
        </div>
        </section>
    </form>

    <script>
        //Função para inserir as matérias no selectSubjects.
        function updateSubjects() {
            var selectDiscipline = document.getElementById("disciplines");
            selectDiscipline = selectDiscipline.value;

            var selectSubjects = document.getElementById("subjects");
            selectSubjects.innerHTML = "";

            <?php
            $php_array = selectSubjects();
            $js_array = json_encode($php_array);
            $js_var = json_encode($id_discipline);
            echo "var subjects = " . $js_array . ";\n
                var id_discipline = " . $js_var . ";\n";
            ?>

            for (let i = 0; i < subjects.length; i++) {
                if (subjects[i][1] == selectDiscipline) {
                    let option = document.createElement("option");
                    option.setAttribute("value", `${subjects[i][0]}`);
                    option.setAttribute("label", `${subjects[i][2]}`);
                    selectSubjects.appendChild(option);
                } else if (selectDiscipline == 0) {
                    if (subjects[i][1] == id_discipline) {
                        let option = document.createElement("option");
                        option.setAttribute("value", `${subjects[i][0]}`);
                        option.setAttribute("label", `${subjects[i][2]}`);
                        selectSubjects.appendChild(option);
                    }
                }
            }
        }
        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);
        
        <?php
        updateCorrectAnswerSelect_AlternativesField();

        invisibleInput();
        ?>

        <?php
        if ($id_role == 1) {
            echo 'var div = document.getElementById("container_selectDisciplines");         div.removeAttribute("hidden");';
        }
        ?>
    </script>

    <!--Importações do Bootstrap-->
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