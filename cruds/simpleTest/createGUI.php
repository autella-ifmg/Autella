<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor-inline/build/ckeditor.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/discipline.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/question.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/subject.php';
    require_once "createSQL.php";
    require_once "../../libraries/ckeditor-inline/CKEditorImport.php";

    ?>
    <style>
        .a {
            border-style: solid;
        }

        /* Split the screen in half */
        .split {
            height: 100%;
            width: 50%;
            position: fixed;
            z-index: 1;
            top: 0;
            overflow-x: hidden;
            padding-top: 200px;

        }

        /* Control the left side */
        .left {
            left: 0;

        }

        /* Control the right side */
        .right {
            right: 0;

        }

        /* If you want the content centered horizontally and vertically */
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /* Style the image inside the centered container, if needed */
        .centered img {
            width: 150px;
            border-radius: 50%;
        }
    </style>
    <script>
        function dificultyTratament($dificulty) {
            console.log($dificulty);
            switch ($dificulty) {
                case '1':
                    return "Dificuldade: Fácil";
                    break;
                case '2':
                    return "Dificuldade: Média";
                    break;
                default:
                    return "Dificuldade: Difícil";
                    break;
            }
        }

        function dateTratament(date) {
            date1 = date.split("-");
            date1 = date1[0] + "/" + date1[1] + "/" + date[2];
            return date1;
        }


        function IDquestions(id) {
            for (var i in js_array) {
                //console.log("row " + i);
                for (var j in js_array[i]) {
                    //console.log(" "+ j +"--- "+ js_array[i][j]);
                }
            }
            $DataDeCriação = "Criada em :" + dateTratament(js_array[id][2]);
            $Dificuldade = dificultyTratament(js_array[id][3]);
            testQuestion[testQuestion.length] = id;
            IdentidadeDaQuestão = js_array[id][1];
            Enunciado = js_array[id][4];
            $Disciplina = js_array[id][9];
            $Materia = js_array[id][10];
            $NumeroDaQuestão = js_array[id][0];
            QuestaoCorreta = js_array[id][5];
            document.getElementById('questaoSQL' + id).style.display = 'none';

            var GlobalName = document.getElementById("testName").value;

            document.getElementById('sidebar').innerHTML += "    <div id='prova" + id + "' style=\"margin: 20px;\"> <div class=\"d-flex flex-row bd-highlight\"><div class=\"p-2 w-25 border border-dark\">Questão - " + (id + 1) + "</div> <div class=\"p-2 w-25 border border-dark border-left-0\">" + $Disciplina + "</div>  <div class=\"p-2 flex-fill border border-dark border-left-0\">" + $Materia + "</div>  </div>  <div class=\"d-flex flex-row bd-highlight\">  <div class=\"p-2 w-25 border border-dark border-top-0\">" + $DataDeCriação + ".</div> <div class=\"p-2 w-25 border border-dark border-left-0  border-top-0\">" + $Dificuldade + "</div> <div class=\"p-2 flex-fill border border-dark border-left-0  border-top-0\">Alternativa Correta :" + QuestaoCorreta + "</div></div> <div '\" class=\" p-2 flex-fill  border border-dark border-top-0 \" style=\"overflow: auto;\">" + Enunciado + "</div> <img  src=../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash.svg alt=Editar height=25 onclick = 'delet(" + id + ")'/> </div>";
            document.getElementById("testName").value = GlobalName;
        }

        function delet(id) {
            for (i = 0; i <= testQuestion.length; i++) {
                if (testQuestion[i] == id) {
                    document.getElementById('questaoSQL' + id).style.display = 'block';
                    document.getElementById('prova' + id).remove();
                    testQuestion.splice(i, 1);
                }

            }
        }
    </script>
</head>

<body>

    </div>
    <?php require_once '../../views/navbar.php'; ?>
    <br>
    <div id='sidebar' class="split rigth a" style="width:35%;right:0;">
        <div style="text-align: center; ">
            <script type="text/javascript">
                function convert() {
                    var ids = document.getElementById("ids");
                    var testName = document.getElementById("name")
                    NEWstring = testQuestion.toString();
                    ids.value = NEWstring;
                    testName.value = NEWstring;
                    Insert();
                }
            </script>
            <form method="get">
                <input name="ids" id="ids" type="hidden" value="aaa" />
                <label style="font-size: 20px ;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;" for="testName">Nome da prova simples:</label><br>
                <input aria-label="Prova 1" id="testName" name="testName" type="text" required/>
                <input class="btn btn-success" onclick="convert();" name="BTN" type="submit" value="FINALIZAR" />
            </form>
            <div style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                <H2>QUESTÕES:</H2>
            </div>
            <?php
            if (isset($_GET['BTN'])) {
                $testQuestion = explode(',', $_GET['ids']);
                $testName = explode(',', $_GET['testName']);
                insertInDatabase($testQuestion, $array, $testName[0]);
            }
            ?>
        </div>
    </div>
    <script>
        var testQuestion = [];
        <?php $js_array = json_encode($array);
        echo "var js_array = " . $js_array . ";\n"; ?>
    </script>
    <!-- Page Content -->
    <div style="margin-right:25%">
        <!--
        Toast genérico
        <div name="toast" class="toast d-flex justify-content-left mt-3 " role="alert" aria-live="assertive" aria-atomic="true" data-animation="true" data-delay="5000">
            <div class="toast-header">
                <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg" alt="Arquivada!" class="rounded mr-2">
                <strong class="mr-auto">Sucesso!</strong>
            </div>
            <div id="result" class="toast-body"></div>
        </div>
    -->
        <div class="split left" style="width: 60%;">
            <div>
                <!--Filtros-->
                <section class="d-flex justify-content-center mt-3">
                    <div class="d-flex flex-column">


                        <!--Blocos de questões-->

                        <?php data($array, $id_role); ?>
                    </div>
            </div>

            
        </div>
        </section>

        <!--Modal genérico-->
        <div name="container" id="none" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 name="header" id="none" class="modal-title">none</h5>
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
                        <a name="modalButton" id="none" class="btn btn-danger" onclick="none" data-dismiss="modal">Sim, tenho certeza</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            <?php
            $questions = json_encode($array);
            echo "questions = " . $questions . ";\n";
            ?>

            //Função para inserir as matérias no selectSubjects.
            function updateSubjects() {
                <?php
                if ($id_role == 1) {
                    echo "
            var selectDiscipline = document.getElementById('disciplines');\n
            selectDiscipline = selectDiscipline.value;\n
                    ";
                } else {
                    $var = json_encode($id_discipline);
                    echo "var selectDiscipline = " . $id_discipline . ";\n";
                }
                ?>

                var selectSubjects = document.getElementById("subjects");
                selectSubjects.innerHTML = "";

                var option = document.createElement("option");
                option.setAttribute("disabled", "disabled");
                option.setAttribute("selected", "selected");
                option.setAttribute("label", "Escolha...");
                selectSubjects.appendChild(option);

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

            //Função que coleta o filtro desejado.
            function filter(archive_filter) {
                var url = "http://autella.com/cruds/question/readGUI.php?";

                <?php
                if ($id_role == 1) {
                    echo "
            var discipline_filter = document.getElementById('disciplines');\n
            discipline_filter = discipline_filter.value;\n
            ";
                } else {
                    $var = json_encode($id_discipline);
                    echo "var discipline_filter = " . $id_discipline . ";\n";
                }
                ?>

                var subject_filter = document.getElementById("subjects");
                subject_filter = subject_filter.value
                var dificulty_filter = document.getElementById("dificulty");
                dificulty_filter = dificulty_filter.value
                var date_filter = document.getElementById("date");
                date_filter = date_filter.value;

                var filter_btn = document.getElementById("filter");
                filter_btn.setAttribute("href", `${url}filter=true&id_discipline=${discipline_filter}&id_subject=${subject_filter}&dificulty=${dificulty_filter}&date=${date_filter}&status=${archive_filter}&`);

                var archive_btn = document.getElementById("archive");
                archive_btn.setAttribute("href", `${url}filter=true&id_discipline=${discipline_filter}&id_subject=${subject_filter}&dificulty=${dificulty_filter}&date=${date_filter}&status=${archive_filter}&`);
            }

            //Especifica a ação do modal
            function chooseAction(action, questionNumber) {
                var modal = [
                    ["editModal", "editModalLabel", `Editar a <b>Questão - ${questionNumber}</b>?`, "Ao alterar essa questão, todas as provas simples e provas globais que a utilizam também serão alteradas.", `Você tem certeza que deseja fazer alguma modificação na <b>Questão - ${questionNumber}</b>?`, "editButton", "editQuestion("],
                    ["archiveModal", "archiveModalLabel", `Arquivar a <b>Questão - ${questionNumber}</b>?`, "Ao arquivar essa questão, ela não se perderá, mas, ficará indisponível em todas as provas simples e provas globais onde está inclusa.", `Você tem certeza que deseja arquivar a <b>Questão - ${questionNumber}</b>?`, "archiveButton", "archiveQuestion("],
                    ["deleteModal", "deleteModalLabel", `Deletar a <b>Questão - ${questionNumber}</b>?`, "Ao excluir essa questão, ela se perderá permanentemente e se tornará indisponível em todas as provas simples e provas globais onde está inclusa.", `Você tem certeza que deseja excluir a <b>Questão - ${questionNumber}</b>?`, "deleteButton", "deleteQuestion("]
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

                var button = document.getElementsByName("modalButton")[0];
                button.removeAttribute("id")
                button.removeAttribute("onclick");
                button.setAttribute("id", `${modal[action][5]}`);
                button.setAttribute("onclick", `${modal[action][6] + questionNumber})`);

                if (action == 0) {
                    button.removeAttribute("data-dismiss");
                }
            }

            function editQuestion(questionNumber) {
                var button = document.getElementById("editButton");
                button.setAttribute("href", `updateGUI.php?questionNumber=${questionNumber}`);
            }

            function archiveQuestion(questionNumber) {
                var position;
                var str = questionNumber.toString();
                console.log(str)

                if ((str.substr(-1)) > 5) {
                    position = Math.ceil(questionNumber % 5) - 1;
                    console.log(position)
                } else if ((str.substr(-1)) == 0) {
                    position = 4;
                    console.log(position)
                } else {
                    questionNumber -= 1;
                    str = questionNumber.toString();
                    position = Number.parseInt(str.substr(-1));
                    console.log(position);
                }

                var questionForArchive = questions[position];
                console.log(questionForArchive);

                $.ajax({
                    type: 'POST',
                    url: 'updateSQL.php',
                    data: {
                        questionForArchive
                    },
                    success: function(result) {
                        window.location.reload();
                        console.log(result);
                        //$('#resultados').html(result).fadeIn();
                        //$(".toast").toast("show");
                    }
                });
            }

            function deleteQuestion(questionNumber) {
                var position = Math.ceil(questionNumber % 5) - 1;

                var questionForDelete = questions[position];
            }

            <?php
            if ($id_role == 1) {
                echo '
        var div = document.getElementById("container_selectDiscipline");
        div.removeAttribute("hidden"); 
             ';
            } else {
                echo '
        var list = document.getElementsByName("container_select");';

                for ($i = 0; $i < 3; $i++) {
                    echo '
        var container' . $i . ' = list[' . $i . '];
        container' . $i . '.removeAttribute("class");
        container' . $i . '.setAttribute("class", "w-50 mt-1 mr-3");
            ';
                }
            }
            ?>
        </script>
        <!--CKEditor-->
        <?php forRead($array); ?>
</body>

</html>