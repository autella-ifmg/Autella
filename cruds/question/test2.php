<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 2</title>
    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once "../../utilities/dbSelect.php";

    $id_discipline = $_SESSION["userData"]["id_discipline"];
    //var_dump($id_discipline);
    ?>
</head>

<body>
    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column ">
            <div class="d-flex flex-row ">
                <div class="p-2 w-25  border border-dark">Questão - 1</div>
                <div class="p-2 w-25 border border-dark border-left-0">Disciplina: Arte</div>
                <div class="p-2 flex-fill border border-dark border-left-0">Matéria: Modernismo</div>
                <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" height="25" /></div>
                <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg" height="25" /></div>
                <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg" height="25" /></div>
            </div>

            <div class="d-flex flex-row ">
                <div class="p-2 w-25 border border-dark border-top-0">Inclusa em: Prova de Artes</div>
                <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Criada em: 24/11/2020</div>
                <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Dificuldade: Fácil</div>
                <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Alternativa correta: B</div> 
            </div>

            <div name="toolbar0" id="toolbar-container0" class="border border-dark border-top-0 border-bottom-0" disabled></div>
            <div name="editor0" id="editor0" class="border border-dark border-top-0 mb-3" style="min-width: 64rem; max-width: 64rem; min-height: 20rem; max-height: 20rem;">
                <p>Dê-me um cigarro<br>Diz a gramática<br>Do professor e do aluno<br>E do mulato sabido<br>Mas o bom negro e o bom branco<br>Da Nação Brasileira<br>Dizem todos os dias<br>Deixa disso camarada<br>Me dá um cigarro.</p>
                <p>(Pronominais, Oswald de Andrade)</p>
                <p>Oswald de Andrade foi um dos principais autores da primeira fase do modernismo no Brasil. Na poesia acima, o escritor propõe:</p><br><br>A) a busca de uma identidade universal.<br>B) a valorização da linguagem coloquial brasileira.<br>C) uma crítica aos maus hábitos, como o tabagismo.<br>D) enfatizar a relação entre professor e aluno.<br>E) repensar o uso do português do Brasil.
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 w-25  border border-dark">Questão - 1</div>
                <div class="p-2 w-25  border border-dark border-left-0">Criada em: 24/11/2020</div>
                <div class="p-2 flex-fill  border border-dark border-left-0">
                    Dificuldade:
                    <select name="dificulty" id="dificulty" required>
                        <option value="1">Fácil</option>
                        <option value="2">Média</option>
                        <option value="3">Difícil</option>
                    </select>
                </div>
                <div class="p-2 flex-fill  border border-dark border-left-0">
                    Alternativa correta:
                    <select name="correctAnswer" id="correctAnswer" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>
                <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" height="25" data-toggle="modal" onclick="chooseAction(0)" data-target="#editModal" /></div>
                <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg" height="25" data-toggle="modal" onclick="chooseAction(1)" data-target="#archiveModal" /></div>
                <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg" height="25" data-toggle="modal" onclick="chooseAction(2)" data-target="#deleteModal" /></div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 w-25 border border-dark border-top-0">
                    Inclusa em:
                    <select name="" id="">
                        <option value="">Prova de Artes</option>
                        <option value="">Prova Global I</option>
                        <option value="">Prova Global II</option>
                    </select>
                </div>
                <div class="p-2 w-25 border border-dark border-left-0 border-top-0">
                    Disciplina:
                    <select name="disciplines" id="disciplines" onchange="updateSubjects()">
                        <?php disciplineNames(0); ?>
                    </select>
                </div>
                <div class="p-2 flex-fill border border-dark border-left-0 border-top-0">
                    Matéria:
                    <select name="subjects" id="subjects" required>
                        <!--updateSubjects()-->
                    </select>
                </div>
            </div>

            <div name="toolbar1" id="toolbar-container1" class="border border-dark border-top-0 border-bottom-0" disabled></div>
            <div name="editor1" id="editor1" class="border border-dark border-top-0 mb-3" style="min-width: 64rem; max-width: 64rem; min-height: 20rem; max-height: 20rem;">
                <p>Dê-me um cigarro<br>Diz a gramática<br>Do professor e do aluno<br>E do mulato sabido<br>Mas o bom negro e o bom branco<br>Da Nação Brasileira<br>Dizem todos os dias<br>Deixa disso camarada<br>Me dá um cigarro.</p>
                <p>(Pronominais, Oswald de Andrade)</p>
                <p>Oswald de Andrade foi um dos principais autores da primeira fase do modernismo no Brasil. Na poesia acima, o escritor propõe:</p><br><br>A) a busca de uma identidade universal.<br>B) a valorização da linguagem coloquial brasileira.<br>C) uma crítica aos maus hábitos, como o tabagismo.<br>D) enfatizar a relação entre professor e aluno.<br>E) repensar o uso do português do Brasil.
            </div>
        </div>
    </section>

    <div id="none" name="container" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="none" name="header" class="modal-title">none</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="p0">none</p>
                    <p id="p1">none</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="none" name="button" type="button" class="btn btn-danger" onclick="none" data-dismiss="modal">Sim, tenho certeza</button>
                </div>
            </div>
        </div>
    </div>

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

        function chooseAction(action) {
            var modal = [
                ["editModal", "editModalLabel", "Editar: $questionNumber", "Ao alterar essa questão, todas as provas simples e provas globais que a utilizam também serão alteradas.", "Você tem certeza que deseja fazer alguma modificação na <b>$questionNumber</b>?", "editIcon", "editQuestion()"],
                ["archiveModal", "archiveModalLabel", "Arquivar: $questionNumber", "Ao arquivar essa questão, ela não se perderá, mas, ficará indisponível em todas as provas simples e provas globais onde está inclusa.", "Você tem certeza que deseja arquivar a <b>$questionNumber</b>?", "archiveIcon", "archiveQuestion()"],
                ["deleteModal", "deleteModalLabel", "Deletar: $questionNumber", "Ao excluir essa questão, ela se perderá permanentemente e se tornará indisponível em todas as provas simples e provas globais onde está inclusa.", "Você tem certeza que deseja excluir a <b>$questionNumber</b>?", "deleteIcon", "deleteQuestion()"]
            ];

            var container = document.getElementsByName("container")[0];
            container.removeAttribute("id");
            container.setAttribute("id", `${modal[action][0]}`);

            var h5 = document.getElementsByName("header")[0];
            h5.removeAttribute("id");
            h5.setAttribute("id", `${modal[action][1]}`)
            h5.innerHTML = `${modal[action][2]}`;

            var p0 = document.getElementById("p0");
            p0.innerHTML = `${modal[action][3]}`;

            var p1 = document.getElementById("p1");
            p1.innerHTML = `${modal[action][4]}`;

            var button = document.getElementsByName("button")[0];
            button.removeAttribute("id")
            button.removeAttribute("onclick");
            button.setAttribute("id", `${modal[action][5]}`);
            button.setAttribute("onclick", `${modal[action][6]}`);
        }

        function editQuestion() {
            console.log("testeeeeeeeeeeee");
           
        }

        function archiveQuestion() {

        }

        function deleteQuestion() {

        }
    </script>

    <!--Importações do Bootstrap-->
    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importações do CKEditor-->
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <script>
        DecoupledEditor
            .create(document.querySelector("#editor0"))
            .then(editor0 => {
                const toolbarContainer0 = document.querySelector("#toolbar-container0");

                toolbarContainer0.appendChild(editor0.ui.view.toolbar.element);
            })
            .catch(error0 => {
                console.error0(error0);
            });
    </script>
    <script>
        DecoupledEditor
            .create(document.querySelector("#editor1"))
            .then(editor1 => {
                const toolbarContainer1 = document.querySelector("#toolbar-container1");

                toolbarContainer1.appendChild(editor1.ui.view.toolbar.element);

                editor1.isReadOnly = true;
            })
            .catch(error1 => {
                console.error1(error1);
            });
    </script>
</body>

</html>