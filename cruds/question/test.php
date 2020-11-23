<?php
//question
function selectQuestionsTest($limit, $start, $end, $filter)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql_complete = "";

    if ($limit) {
        $sql_complete = " ORDER BY subject.name LIMIT $start, $end;";
    } else {
        $sql_complete = " ORDER BY subject.name;";
    }

    if (empty($filter)) {
        $id_discipline = $_SESSION["userData"]["id_discipline"];
        $id_subject = "subject.id";
        $dificulty = "";
    } else {
        $id_discipline = $filter[0];
        $id_subject = $filter[1];
        $dificulty = " AND question.dificulty = $filter[2]";
    }

    //$date = $filter[0];

    $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, discipline.id, discipline.name, subject.name FROM question
            JOIN user ON question.id_user = user.id
            JOIN discipline ON discipline.id = " . $id_discipline . "
            JOIN subject ON subject.id = " . $id_subject . " AND subject.id_discipline = " . $id_discipline . "
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] . $dificulty . $sql_complete;
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Questões selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar questões!");
    }

    $connection->close();
    return $array;
}
//" . $id_subject . "
$filter = [];
$filter[0] = 1;
$filter[1] = 8;
$filter[2] = 2;
//$filter[3] = (isset($_GET["date""]));

$array = selectQuestionsTest(false, 0, 0, $filter);
var_dump($array);
