<html>


<head>
<title>Provas Simples</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <?php
    session_start();

    require_once "../../utilities/dbSelect.php";
    require_once "createSQL.php";
    ?>
  

</head>
<body>

<?php require_once '../../views/navbar.php'; ?>
<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-card" style="width:20%;right:0; background-color: lightgray; opacity: 0.6;" id = "sidebar">
  <h1 class="w3-bar-item" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-variant: small-caps;">Questões para a prova</h1>
<!-- Questões--> 
<div class="shadow-lg p-4 mb-4 bg-white">
  <?php echo idToEnunciate(21)?>
  </div>
</div>

<!-- Questões -->
<?php require_once '../../views/navbar.php'; ?>

<section class="d-flex justify-content-center mt-3">
    <div class="d-flex flex-column">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row justify-content-around mt-3 mb-3">
                <!--Filtro disciplina-->
                <div id="container_selectDisciplines" class="w-25 mt-1 mr-3" hidden>
                    <label for="disciplines">Disciplina:</label>
                    <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                        <?php disciplineNames(1); ?>
                    </select>
                </div>
                <!--Filtro matéria-->
                <div class="w-25 mt-1 mr-3">
                    <label for="subjects">Matéria:</label>
                    <select name="subjects" id="subjects" class="form-control">
                        <!--updateSubjects()-->
                    </select>
                </div>
                <!--Filtro dificuldade-->
                <div class="w-25 mt-1 mr-3">
                    <label for="dificulty">Dificuldade:</label>
                    <select name="dificulty" id="dificulty" class="form-control">
                        <option value=>Escolha...</option>
                        <option value="1">Fácil</option>
                        <option value="2">Média</option>
                        <option value="3">Difícil</option>
                    </select>
                </div>
                <!--Filtro data-->
                <div class="w-25 mt-1">
                    <label for="date">Data de criação:</label>
                    <input id="date" type="date" class="form-control">
                </div>
            </div>

            <!--Botões-->
            <div class="d-flex flex-row justify-content-center mb-3">
                <a href="../../views/home.php" type="button" class="btn btn-primary w-25 mr-5">Voltar</a>
                <a id="filter" type="button" class="btn btn-info w-25 mr-5" onclick="filter()">Filtrar</a>
                <a href="createGUI.php" type="button" class="btn btn-primary w-25">Criar questão</a>
            </div>

            <!--Blocos-->
            <?php data($array, $id_role); ?>
        </div>

        <!--Paginação - HTML e PHP-->
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="<?php echo $url . "pag=" . ($current >= 1 ? 1 : $current - 1); ?>&" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++) {
                $style = "";

                if ($current == $i) {
                    $style = "active";
                }
            ?>
                <li><a class="page-link <?php echo $style; ?>" href="readGUI.php?pag=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $url . "pag=" . ($current < $totalPages ? $current + 1 : $totalPages); ?>&" aria-label="Próximo">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</section>

<!--Modal genérico-->
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
    //Função para enviar a questão para uma sidebar
    function sendQuestion($id){ 
        <?php echo
        "document.getElementById(sidebar).innerHTML = idToEnunciate(" .$id. ");"
        ?>
    }
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

        var selectSubject = document.getElementById("subjects");
        selectSubject.innerHTML = "";

        var option = document.createElement("option");
        option.setAttribute("value", "");
        option.setAttribute("label", "Escolha...");
        selectSubject.appendChild(option);

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
                selectSubject.appendChild(option);
            }
        }
    }
    //Quando o documento estiver carregado, executa o método updateSubjects().
    document.addEventListener("DOMContentLoaded", updateSubjects(), false);

    //Função que coleta o filtro desejado.
    function filter() {
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
        filter_btn.setAttribute("href", `${url}filter=true&id_discipline=${discipline_filter}&id_subject=${subject_filter}&dificulty=${dificulty_filter}&date=${date_filter}&`);
    }

    //Especifica a ação do modal
    function chooseAction(action, questionNumber) {
        var modal = [
            ["editModal", "editModalLabel", `Editar a <b>Questão - ${questionNumber}</b>?`, "Ao alterar essa questão, todas as provas simples e provas globais que a utilizam também serão alteradas.", `Você tem certeza que deseja fazer alguma modificação na <b>Questão - ${questionNumber}</b>?`, "editIcon", "editQuestion()"],
            ["archiveModal", "archiveModalLabel", `Arquivar a <b>Questão - ${questionNumber}</b>?`, "Ao arquivar essa questão, ela não se perderá, mas, ficará indisponível em todas as provas simples e provas globais onde está inclusa.", `Você tem certeza que deseja arquivar a <b>Questão - ${questionNumber}</b>?`, "archiveIcon", "archiveQuestion()"],
            ["deleteModal", "deleteModalLabel", `Deletar a <b>Questão - ${questionNumber}</b>?`, "Ao excluir essa questão, ela se perderá permanentemente e se tornará indisponível em todas as provas simples e provas globais onde está inclusa.", `Você tem certeza que deseja excluir a <b>Questão - ${questionNumber}</b>?`, "deleteIcon", "deleteQuestion()"]
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

    <?php
    if ($id_role == 1) {
        echo '
         var div = document.getElementById("container_selectDisciplines");
       
         div.removeAttribute("hidden");
         
         ';
    }
    ?>
</script>

<!--Importação do Bootstrap-->
<script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
<script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

<!--Importação do CkEditor-->
<script src="../../libraries/ckeditor5/ckeditor.js"></script>
<script>
    <?php imports($array); ?>
</script>
</body>
</html>