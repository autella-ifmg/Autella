<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
global $connection;
if (!isset($_SESSION)) {
    session_start();
}

$id_role = $_SESSION["userData"]["id_role"];
//var_dump($id_role);
$id_discipline = $_SESSION["userData"]["id_discipline"];
//var_dump($id_discipline);

$filter = [];
//Verifica quais filtros foram setados.
if (isset($_GET["filter"])) {
    $filter[0] = (isset($_GET["id_discipline"]) ? $_GET["id_discipline"] : null);
    $filter[1] = (isset($_GET["id_subject"]) ? $_GET["id_subject"] : null);
    $filter[2] = (isset($_GET["dificulty"]) ? $_GET["dificulty"] : null);
    $filter[3] = (isset($_GET["date"]) ? $_GET["date"] : null);
    $filter[4] = (isset($_GET["status"]) ? $_GET["status"] : null);
} else if ($id_role != 1) {
    $filter[0] = $id_discipline;
    $filter[1] = null;
    $filter[2] = null;
    $filter[3] = null;
    $filter[4] = (isset($_GET["status"]) ? $_GET["status"] : null);
}
//var_dump($filter);

//Paginação - PHP
//Número da página atual
$current = intval(isset($_GET["pag"]) ? $_GET["pag"] : 1);
//var_dump($current);

//Total de itens por página.
$end = 5;

//Início da exibicação.
$start = ($end * $current) - $end;

$array = selectQuestions(true, $start, $end, $filter);
//var_dump($array);

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
            return $dificulty = "Dificuldade: Fácil";
            break;
        case 2:
            return $dificulty = "Dificuldade: Média";
            break;
        default:
            return $dificulty = "Dificuldade: Difícil";
            break;
    }
}

function dateTratament($creation_date)
{
    $creation_date = strtotime($creation_date);
    return $creation_date = "Criada em: " . date("d/m/Y", $creation_date);
}

function data($array, $id_role)
{
    global $start;
    global $array1;
    $array1 = $array; 
    $id_user = $_SESSION["userData"]["id"];

    if (!empty($array)) {
        if (count($array) > 0) {
            for ($i = 0; $i < count($array); $i++) {
                $questionNumber = ($start + ($i + 1));
                $dificulty = dificultyTratament($array[$i]["dificulty"]);
                $correctAnswer = "Alternativa correta: " . $array[$i]["correctAnswer"];
                $discipline =  "Disciplina: " . $array[$i][9];
                $subject = "Matéria: " . $array[$i]["name"];
                $creation_date = dateTratament($array[$i]["creation_date"]);
                $enunciate =  $array[$i]["enunciate"];

                echo '
                <div id = "questaoSQL'.$i.'">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="p-2 w-25 border border-dark">Questão - ' . $questionNumber . '</div>
                        <div class="p-2 w-25 border border-dark border-left-0">' . $discipline . '</div>
                        <div class="p-2 flex-fill border border-dark border-left-0">' . $subject . '</div>
                        <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/arrow-right-circle-fill.svg" alt="Mover" height="25" onclick="IDquestions(' . $i . ')"; /></div>';
                
                echo '    
                    </div>

                    <div class="d-flex flex-row bd-highlight">
                        <div class="p-2 w-25 border border-dark border-top-0">Inclusa em: ...</div>
                        <div class="p-2 w-25 border border-dark border-left-0  border-top-0">' . $creation_date . '</div>
                        <div class="p-2 w-25 border border-dark border-left-0  border-top-0">' . $dificulty . '</div>
                        <div class="p-2 w-25 border border-dark border-left-0  border-top-0">' . $correctAnswer  . '</div>
                    </div>

                    <div name="toolbar' . $i . '" id="toolbar-container' . $i . '" class="border border-dark border-top-0 border-bottom-0" disabled></div>
                    <div name="editor' . $i . '" id="editor' . $i . '" class="border border-dark border-top-0 mb-4" style="min-width: 64rem; max-width: 64rem; min-height: 20rem; max-height: 20rem;">' . $enunciate . '</div>
                    </div>
                    ';
            }
        }
    } else {
        echo '
                    <div class="d-flex flex-row bd-highlight">
                        <div class="p-2 w-25 bd-highlight border border-dark">Nº: </div>
                        <div class="p-2 w-25 bd-highlight border border-dark border-left-0">Disciplina:</div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">Matéria:</div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2 w-25 bd-highlight border border-dark border-top-0">Inclusa em: </div>
                        <div class="p-2 w-25 bd-highlight border border-dark border-left-0 border-top-0">Criada em: </div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0 border-top-0">Dificuldade: </div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0 border-top-0">Alternativa correta: </div>
                    </div>

                    <div name="editor" id="editor" class="border border-dark border-top-0 mb-3" style="min-width: 65rem; max-width: 65rem; min-height: 20rem; max-height: 20rem;"><p class="font-weight-bold text-center">Ainda não há questões . :/<p></div>';
    }
}

function imports($array)
{
    if (count($array) > 0) {
        for ($i = 0; $i < count($array); $i++) {
            echo '
            DecoupledEditor
            .create(document.querySelector("#editor' . $i . '"))
            .then(editor' . $i . ' => {
                const toolbarContainer' . $i . ' = document.querySelector("#toolbar-container' . $i . '");

                toolbarContainer' . $i . '.appendChild(editor' . $i . '.ui.view.toolbar.element);

                editor' . $i . '.isReadOnly = true;
            })
            .catch(error' . $i . ' => {
                console.error' . $i . '(error' . $i . ');
            });
            
            ';
        }
    }
}

function insertInDatabase($ids,$array,$testName)
{
    date_default_timezone_set("America/Sao_Paulo");
    $date = date("Y-m-d");
    
    global $connection;
    $id_user = $_SESSION["userData"]["id"];
    $sql = "INSERT into Tests(id_user, making_date, changing_date, name) VALUES ('$id_user','$date','$date','$testName');";  
    mysqli_query($connection, $sql);
    $id_test =  mysqli_insert_id($connection);
    if (!empty($ids)) {
        if (count($ids) > 0) {
            for ($i = 0; $i < count($ids); $i++) {
                $id_question = $array[$ids[$i]][0];    
                $sql = "INSERT into question_test(id_question, id_tests) VALUES ('$id_question','$id_test');";
                //echo $i .'+ '.$sql ;
                mysqli_query($connection, $sql);
            }
        }       
    }
}
