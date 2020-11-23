<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <?php
    //Inicia a sessão.
    session_start();

    require_once "../../utilities/dbSelect.php";
    require_once "readSQL.php";
    //Obtém o cargo do usuário que está logado no momento.
    $id_role = $_SESSION["userData"]["id_role"];
    //Obtém o id da disciplina correspondente ao usuário que está logado no momento.
    $id_discipline = $_SESSION["userData"]["id_discipline"];
    //var_dump($id_discipline);

    /*
    $filter = [];
    
    $filter[0] = (isset($_GET["id_discipline"]));
    $filter[1] = (isset($_GET["id_subject"]));
    $filter[2] = (isset($_GET["dificulty"]));
    //$filter[3] = (isset($_GET["date""]));
    */
    //Obtém a página atual
    $current = intval(isset($_GET["pag"]) ? $_GET["pag"] : 1);
    //var_dump($current);

    //Total de itens por página
    $end = 5;

    //Início da exibicação
    $start = ($end * $current) - $end;

    $array = selectQuestions($id_discipline, $start, $end, true);
    //var_dump($array);
    $totalRows = count($aux = selectQuestions($id_discipline, 0, 0, false));
    //var_dump($totalRows);

    $totalPages = ceil($totalRows / $end);
    //var_dump($totalPages);
    ?>
</head>

<body>
    <!--Inclui a navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <form method="post">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-around mt-3 mb-3">
                        <!--Filtro - disciplina-->
                        <div id="container_selectDisciplines" class="w-25 mt-1 mr-3" hidden>
                            <label for="disciplines">Disciplina:</label>
                            <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                                <?php disciplineNames(); ?>
                            </select>
                        </div>
                        <!--Filtro - matérias-->
                        <div class="w-25 mt-1 mr-3">
                            <label for="subjects">Matéria:</label>
                            <select name="subjects" id="subjects" class="form-control">

                            </select>
                        </div>
                        <!--Filtro - dificuldade-->
                        <div class="w-25 mt-1 mr-3">
                            <label for="dificulty">Dificuldade:</label>
                            <select name="dificulty" id="dificulty" class="form-control">
                                <option value="1">Fácil</option>
                                <option value="2">Média</option>
                                <option value="3">Difícil</option>
                            </select>
                        </div>
                        <!--Filtro - data-->
                        <div class="w-25 mt-1">
                            <label for="date">Data de criação:</label>
                            <select name="date" id="date" class="form-control">

                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-center bd-higlight mb-3">
                        <!--Botão para voltar-->
                        <a href="../../views/home.php" type="button" class="btn btn-primary w-25 bd-highlight mr-5">Voltar</a>
                        <!--Botão para criar questões-->
                        <a href="createGUI.php" type="button" class="btn btn-primary w-25 bd-highlight mr-5">Criar questão</a>
                        <!--Botão para filtrar-->
                        <a id="filter" type="button" class="btn btn-primary w-25 bd-highlight" onclick="filter()">Filtrar</a>
                    </div>

                    <?php data($array, $id_discipline, $id_role); ?>
                </div>
            </form>


            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="readGUI.php?pag=<?php echo $current >= 1 ? 1 : $current - 1; ?>&" aria-label="Anterior">
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
                    <a class="page-link" href="readGUI.php?pag=<?php echo $current < $totalPages ? $current + 1 : $totalPages; ?>&" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>

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

        function filter() {
            var url = document.url;

            var discipline_filter = document.getElementById("disciplines");
            discipline_filter = discipline_filter.value
            var subjects_filter = document.getElementById("subject");
            subjects_filter = subjects_filter.value
            var dificulty_filter = document.getElementById("dificulty");
            dificulty_filter = dificulty_filter.value

            var filter_btn = document.getElementById("filter");
            filter_btn.setAttribute("href", `${url}0=${discipline_filter}&1=${subjects_filter}&2=${dificulty_filter}`)



        }

        <?php selectControl($id_role); ?>
    </script>

    <!--Importações do Bootstrap-->
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <script>
        <?php imports($array, $id_discipline); ?>
    </script>
</body>

</html>