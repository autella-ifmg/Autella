<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <?php
    require_once "../../utilities/dbSelect.php";
    require_once "readTestSQL.php";
    ?>
</head>

<body>
    <?php require_once '../../views/navbar.php'; ?>
    <div style="text-align: center;"><H1>PROVA SIMPLES</H1></div>
    <!--Filtros-->
    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row mb-3">
                <!--Filtro disciplina-->
                <div id="container_selectDiscipline" class="w-25 mt-1 mr-3" hidden>
                    <label for="disciplines">Disciplina:</label>
                    <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                        <?php disciplineNames(1); ?>
                    </select>
                </div>
                <!--Filtro matéria-->
                <div name="container_select" class="w-25 mt-1 mr-3">
                    <label for="subjects">Matéria:</label>
                    <select name="subjects" id="subjects" class="form-control">
                        <!--updateSubjects()-->
                    </select>
                </div>
                <!--Filtro dificuldade-->
                <div name="container_select" class="w-25 mt-1 mr-3">
                    <label for="dificulty">Dificuldade:</label>
                    <select name="dificulty" id="dificulty" class="form-control">
                        <option value="" selected>Escolha...</option>
                        <option value="1">Fácil</option>
                        <option value="2">Média</option>
                        <option value="3">Difícil</option>
                    </select>
                </div>
                <!--Filtro data-->
                <div name="container_select" class="w-25 mt-1 mr-3">
                    <label for="date">Data de criação:</label>
                    <input id="date" type="date" class="form-control">
                </div>
                <!--Questões arquivadas-->
                <div class="w-auto mt-1">
                    <a id="archive" onclick="filter(0, 0)"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg" alt="Questões arquivadas" height="75" data-toggle="tooltip" data-placement="top" title="Visualizar questões arquivadas"> </a>
                </div>
            </div>

            <!--Botões-->
            <div class="d-flex flex-row justify-content-between mb-3">
                <a href="../../views/home.php" type="button" class="btn btn-primary w-25 mr-5">Voltar</a>
                <a id="filter" type="button" class="btn btn-info w-25 mr-5" onclick="filter(1, 1)">Filtrar</a>
               
            </div>

            <!--Blocos de questões-->
            <div>
                <?php data($array, $id_role); ?>
            </div>

            <!--Paginação - HTML e PHP-->
           
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

    
    
        function convertQuestionNumber(questionNumber) {
            var position;
            var str = questionNumber.toString();

            if ((str.substr(-1)) > 5) {
                position = Math.ceil(questionNumber % 5) - 1;
            } else if ((str.substr(-1)) == 0) {
                position = 4;
            } else {
                questionNumber -= 1;
                str = questionNumber.toString();
                position = Number.parseInt(str.substr(-1));
            }

            return position;
        }

        function editQuestion(questionNumber) {
            var button = document.getElementById("editButton");
            button.setAttribute("href", `updateGUI.php?questionNumber=${questionNumber}`);
        }

        function archiveQuestion(questionNumber) {
            var position = convertQuestionNumber(questionNumber);

            var question = questions[position];
            //console.log(question);

            $.ajax({
                type: 'POST',
                url: 'updateSQL.php',
                data: {
                    question
                },
                success: function(result) {
                    window.location.reload();
                    console.log(result);
                    $('#toast').toast('show');
                    $('#result').html(result).fadeIn();
                    //$(".toast").toast("show");
                }
            });
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

        if (empty($array)) {
            echo '
        $("#container_selectDiscipline").find("*").prop("disabled", true);

        var list = document.getElementsByName("container_select");
            ';

            for ($i = 0; $i < 3; $i++) {
                echo '
        var container' . $i . ' = list[' . $i . '];
        $(container' . $i . ').find("*").prop("disabled", true);
                ';
            }
        }
        ?>
    </script>

    <!--CKEditor-->
    <script>
        <?php imports($array); ?>
    </script>
</body>

</html>