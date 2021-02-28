<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/question.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/question_test.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';

$id_role = $_SESSION["userData"]["id_role"];
//var_dump($id_role);
$id_discipline = $_SESSION["userData"]["id_discipline"];
//var_dump($id_discipline);

if ($id_role != 1 && !($id_role == 5)) {
    $filter_names = ['id_subject', 'dificulty', 'date'];
    $select_names = ['container_subjects', 'container_dificulty', 'container_date'];
    $structuresQuantity = 3;
    $class_div = "w-50 mr-3";
    $mr_exception = "w-50 mr-1";
} else {
    $filter_names = ['id_discipline', 'id_subject', 'dificulty', 'date'];
    $select_names = ['container_disciplines', 'container_subjects', 'container_dificulty', 'container_date'];
    $structuresQuantity = 4;
    $class_div = "w-25 mr-3";
    $mr_exception = "w-25 mr-1";
}

$filter = [];
//Verifica quais filtros foram setados.
if (isset($_GET["filter"])) {
    $filter[0] = (isset($_GET["id_discipline"]) ? $_GET["id_discipline"] : null);
    $filter[1] = (isset($_GET["id_subject"]) ? $_GET["id_subject"] : null);
    $filter[2] = (isset($_GET["dificulty"]) ? $_GET["dificulty"] : null);
    $filter[3] = (isset($_GET["date"]) ? $_GET["date"] : null);
    $filter[4] = (isset($_GET["status"]) ? $_GET["status"] : null);
} else if ($id_role != 1  && $id_role != 5) {
    $filter[0] = $id_discipline;
    $filter[1] = null;
    $filter[2] = null;
    $filter[3] = null;
    $filter[4] = (isset($_GET["status"]) ? $_GET["status"] : null);
}
//var_dump($filter);

function gatheringInfoForFiltersSystem()
{
    global $filter_names, $structuresQuantity, $id_role, $id_discipline;
    $php_array = [
        0 => ["false"],
        1 => ["false"],
        2 => ["false"],
        3 => ["false"]
    ];
    $js_array = [];
    $result = "filtersSystemData = null;\n";

    if (isset($_GET['filter'])) {
        for ($i = 0; $i < $structuresQuantity; $i++) {
            if (!empty($_GET[$filter_names[$i]])) {
                switch ($filter_names[$i]) {
                    case 'id_discipline':
                        $php_array[0] = [$_GET[$filter_names[$i]], "disciplines"];
                        break;
                    case 'id_subject':
                        $php_array[1] = [$_GET[$filter_names[$i]], "subjects"];
                        break;
                    case 'dificulty':
                        $php_array[2] = [$_GET[$filter_names[$i]], "dificulty"];
                        break;
                    case 'date':
                        $php_array[3] = [$_GET[$filter_names[$i]], "date"];
                        break;
                }
            } else if ($id_role != 1 && $id_role != 5) {
                $php_array[0] = [$id_discipline, "disciplines"];
            }
        }

        $js_array = json_encode($php_array);
        $result = "filtersSystemData = " . $js_array . ";\n";
    }

    return $result;
}

//Paginação
//Número da página atual
$current = intval(isset($_GET["pag"]) ? $_GET["pag"] : 1);
//var_dump($current);

//Total de itens por página.
$end = 5;

//Início da exibicação.
$start = ($end * $current) - $end;

$questions = selectQuestions(true, $start, $end, $filter);
//var_dump($questions);

//Total de linhas da tabela.
$totalRows = count($aux = selectQuestions(false, 0, 0, $filter));
//var_dump($totalRows);

//Total de páginas.
$totalPages = ceil($totalRows / $end);
//var_dump($totalPages);

//URL da página atual.
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'];
//echo $url;

function dificultyTratament($dificulty)
{
    switch ($dificulty) {
        case 1:
            return $dificulty = "Fácil";
            break;
        case 2:
            return $dificulty = "Média";
            break;
        default:
            return $dificulty = "Difícil";
            break;
    }
}

function dateTratament($creation_date)
{
    $creation_date = strtotime($creation_date);
    return $creation_date = date("d/m/Y", $creation_date);
}

function verifyHistoricOfQuestion($question_id) {
    $question_ids = selectAllFromQuestionTest();

    for ($i = 0; $i < count($question_ids); $i++) {
        if ($question_id == $question_ids[$i][1]) {
            return true;
            break;
        }
    }
}

function questionBlocks($questions, $id_role)
{
    global $start;
    $id_user = $_SESSION["userData"]["id"];

    if (!empty($questions)) {
        if (count($questions) > 0) {
            for ($i = 0; $i < count($questions); $i++) {
                $question_id = $questions[$i][0];
                $questionNumber = ($start + ($i + 1));
                $dificulty = dificultyTratament($questions[$i]["dificulty"]);
                $correctAnswer = "Alternativa correta: " . $questions[$i]["correctAnswer"];
                $discipline =  "Disciplina: " . $questions[$i][9];
                $subject = "Matéria: " . $questions[$i]["name"];
                $creation_date = dateTratament($questions[$i]["creation_date"]);
                $enunciate =  $questions[$i]["enunciate"];
                $status = $questions[$i]["status"];

                $create_by = selectUserName($questions[$i]['id_user']);

                $test_names = selectTestNames($question_id);

                $historic_of_question = verifyHistoricOfQuestion($question_id);
         
                if($historic_of_question == true) {
                    $action_delete = 4;
                } else {
                    $action_delete = 3;
                }

                $icons = "";

                if ($id_role == 1 || $id_role == 5 || $questions[$i]["id_user"] == $id_user) {
                    if ($status == 0) {
                        $icons = '
                        <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive.svg" alt="Arquivar" height="25" onclick="defineModalAction(2, ' . ($questionNumber) . ')" data-toggle="modal" data-target="#unarchiveModal" data-toggle="tooltip" data-placement="bottom" title="Arquivar questão"/></div>
                        <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg" alt="Deletar" height="25" onclick="defineModalAction(' . ($action_delete) . ', ' . ($questionNumber) . ')" data-toggle="modal" data-target="#deleteModal" data-toggle="tooltip" data-placement="bottom" title="Deletar questão"/></div>
                        ';
                    } elseif ($status == 1) {
                        $icons = '
                        <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" alt="Editar" height="25" onclick="defineModalAction(0, ' . ($questionNumber) . ')" data-toggle="modal" data-target="#editModal" data-toggle="tooltip" data-placement="bottom" title="Editar questão"/></div>
                        <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg" alt="Arquivar" height="25" onclick="defineModalAction(1, ' . ($questionNumber) . ')" data-toggle="modal" data-target="#archiveModal" data-toggle="tooltip" data-placement="bottom" title="Arquivar questão"/></div>
                        <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg" alt="Deletar" height="25" onclick="defineModalAction(' . ($action_delete) . ', ' . ($questionNumber) . ')" data-toggle="modal" data-target="#deleteModal" data-toggle="tooltip" data-placement="bottom" title="Deletar questão"/></div>
                        ';
                    }
                }

                echo '
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-row w-50">
                            <div class="p-2 w-auto border border-dark">Questão - ' . $questionNumber . '</div>
                            <div class="p-2 flex-fill border border-dark border-left-0">Criada por: ' . $create_by . '</div>
                        </div>

                        <div class="p-2 flex-fill border border-dark border-left-0">Criada em: ' . $creation_date . '</div>
                ';

                if (!empty($test_names)) {
                    echo '    
                        <div class="dropdown p-2 w-auto border border-dark border-left-0">
                            <img id="dropdownMenuButton' . $i . '" src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/file-ruled-fill.svg" height="25" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Lista de Provas" />
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $i . '">
                                <h6 class="dropdown-header"></h6>
                    ';

                    for ($aux = 0; $aux < count($test_names); $aux++) {
                        echo '<a class="dropdown-item" href="../simpleTest/readTestGUI.php?id=' . $test_names[$aux][0] . '">' . $test_names[$aux][1] . '</a>';
                    }
                    echo '
                            </div>
                        </div>
                    ';
                }

                echo     $icons .
                    '</div>

                    <div class="d-flex flex-row">
                        <div class="p-2 w-25 border border-dark border-top-0">Dificuldade: ' . $dificulty . '</div>
                        <div class="p-2 w-25 border border-dark border-left-0 border-top-0">' . $correctAnswer  . '</div>
                        <div class="p-2 w-auto border border-dark border-left-0 border-top-0">' . $discipline . '</div>
                        <div class="p-2 flex-fill border border-dark border-left-0 border-top-0">' . $subject . '</div>
                    </div>

                    <div id="toolbar' . $i . '" class="d-none col-lg-11"></div>
                    <div name="editor' . $i . '" id="editor' . $i . '" class="border border-dark border-top-0 mb-4" style="min-width: 65rem; max-width: 65rem; min-height: 20rem; max-height: 20rem;">' . $enunciate . '</div>
                ';
            }
        }
    } else {
        if (isset($_GET['filter']) && isset($_GET['id_discipline'])) {
            $message = "Não encontramos nenhum resultado correspondente ao(s) filtro(s) aplicado(s). :/";
        } else {
            $message = "Ainda não há nenhuma questão disponível aqui.";
        }
        echo '
                    <div class="d-flex flex-row">
                        <div class="p-2 w-25 border border-dark">Nº:</div>
                        <div class="p-2 w-25 border border-dark border-left-0">Criada por:</div>
                        <div class="p-2 flex-fill border border-dark border-left-0">Criada em:</div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2 w-25 border border-dark border-top-0">Dificuldade:</div>
                        <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Alternativa correta:</div>
                        <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Disciplina:</div>
                        <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Matéria:</div>
                    </div>
    
                    <div class="d-flex justify-content-center align-items-center border border-dark border-top-0 mb-3" style="min-width: 65rem; max-width: 65rem; min-height: 20rem; max-height: 20rem;"><p class="font-weight-bold text-primary">' . $message . '<p></div>
        ';
    }
}