<?php
//Inicia a sessão.
session_start();

$id_discipline = $_SESSION["userData"]["id_discipline"];

function selectSubjects()
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql = "SELECT * FROM subject;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        $message = "Matérias selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar matérias!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    // echo var_dump($array);
    // echo $array[0][1];

    array_push($_SESSION['debug'], $message);

    return $array;
}

function subjectNamesToDropdownItems($id_discipline)
{
    $array = selectSubjects();

    for ($i = 0; $i < count($array); $i++) {

        if ($array[$i][1] = $id_discipline) {
            echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" type="checkbox" class="dropdown-item" value="' . $array[$i][0] . '">' . $array[$i][2] . '</option>';
        }
    }
}

function subjectNamesToUpdate($id_subject)
{
    $array = selectSubjects();

    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i][0] == $id_subject) {
            return $array[$i][2];
        }
    }
}

function selectUserQuestions($id_user)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql = "SELECT * FROM question WHERE id_user = '$id_user';";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        $message = "Questões selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar questões!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    // echo var_dump($array);
    // echo $array[0][1];

    array_push($_SESSION['debug'], $message);

    return $array;
}

function selectDisciplines()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $sql = "SELECT * FROM discipline;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        $message = "Disciplinas selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar disciplinas!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    // echo var_dump($array);
    // echo $array[0][1];

    array_push($_SESSION['debug'], $message);
    $connection->close();

    return $array;
}

function disciplineNameToUpdate($id_discipline)
{
    $array = selectDisciplines();

    //var_dump($array);

    for ($i = 0; $i < count($array); $i++) {

        if ($array[$i][0] == $id_discipline) {
            return $array[$i][2] . " - ";
        }
    }
}


/*
$array = selectSubjects();
var_dump($array);
echo $array[0][2] . "<br>";
echo $array[1][2] . "<br>";
echo $array[2][2] . "<br>";
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 1</title>
    <link rel="stylesheet" href="../../../libraries/bootstrap/bootstrap.css">
</head>

<body>
    <h1 class="text-center">Autella | Crie sua questão</h1>

    <form id="questionForm" method="post">
        <section>
            <h1 class="text-left">Informações gerais</h1>

            <div class="form-group">
                <!--Campo para selecionar a matéria da questão-->
                <label for="subject">Matéria:</label>
                <select class="btn btn-primary dropdown-toggle" name="subject" id="subject" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                    <?php
                    subjectNamesToDropdownItems($id_discipline);
                    ?>
                </select>
            </div>

            <div class="form-group">
                <!--Campo para selecionar a dificuldade da questão-->
                <label for="dificulty">Dificuldade:</label>
                <select class="btn btn-primary dropdown-toggle" name="dificulty" id="dificulty" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                    <option value="facil">Fácil</option>
                    <option value="medio">Médio</option>
                    <option value="dificil">Difícil</option>
                </select>
            </div>

            <div class="form-group">
                <!--Lista para selecionar o número de alternativas-->
                <label for="answers">Número de alternativas:</label>
                <select class="btn btn-primary dropdown-toggle" name="answers" id="answers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-group">
                <!--Lista para selecionar a alternative correta-->
                <label for="correctAnswer">Alternativa correta:</label>
                <select class="btn btn-primary dropdown-toggle" name="correctAnswer" id="correctAnswer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div>
        </section>

        <?php disciplineNameToUpdate($id_discipline); ?>

    </form>

    <!--Importações do Bootstrap-->
    <script src="../../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <script>
        var answers = document.getElementById("answers");

        var option = answers.selectedIndex.value;
        console.log(option);
    </script>
</body>

</html>