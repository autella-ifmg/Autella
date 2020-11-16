<?php

function selectFields()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $sql = "SELECT * FROM field;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        // $message = "Áreas selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar Áreas!";
        // $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    if (isset($message)) {
        array_push($_SESSION['debug'], $message);
    }

    return $array;
}

function fieldNamesToDropdownItems()
{
    $array = selectFields();

    for ($i = 0; $i < count($array); $i++) {
        if ($i == 0) {
            echo '<option selected="selected" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        }
    }
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
        //$message = "Disciplinas selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar disciplinas!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    // echo var_dump($array);
    // echo $array[0][1];

    if (isset($message)) {
        array_push($_SESSION['debug'], $message);
    }
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

function selectRoles()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $sql = "SELECT * FROM role;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        // $message = "Cargos selecionados com sucesso!";
    } else {
        $message = "Erro ao selecionar cargos!";
        // $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    if (isset($message)) {
        array_push($_SESSION['debug'], $message);
    }

    return $array;
}

function roleNamesToDropdownItems()
{
    $array = selectRoles();

    for ($i = 0; $i < count($array); $i++) {
        if ($i == 0) {
            echo '<option selected="selected" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        }
    }
}

function selectInstitutions()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $sql = "SELECT * FROM institution;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        // $message = "Instituições selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar instituições!";
        // $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    if (isset($message)) {
        array_push($_SESSION['debug'], $message);
    }

    return $array;
}

function institutionNamesToDropdownItems()
{
    $array = selectInstitutions();

    for ($i = 0; $i < count($array); $i++) {
        if ($i == 0) {
            echo '<option selected="selected" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        }
    }
}

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
        // $message = "Matérias selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar matérias!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    // echo var_dump($array);
    // echo $array[0][1];

    if (isset($message)) {
        array_push($_SESSION['debug'], $message);
    }

    return $array;
}

function subjectNamesToDropdownItems($id_discipline)
{
    $array = selectSubjects();

    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i][1] == $id_discipline) {
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

function selectDisciplineQuestions($id_discipline)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql = "SELECT * FROM question WHERE id_discipline = '$id_discipline';";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        // $message = "Questões selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar questões!";
        //$message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    // echo var_dump($array);
    // echo $array[0][1];

    if (isset($message)) {
        array_push($_SESSION['debug'], $message);
    }

    return $array;
}

function selectRowsQuantTableQuestion($id_discipline)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql = "SELECT * from question WHERE id_discipline = '$id_discipline';";
    $result = mysqli_query($connection, $sql);
    $rowsQuant = mysqli_num_rows($result);

    return $rowsQuant;
}
