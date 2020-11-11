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
        $message = "Áreas selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar Áreas!";
        // $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    array_push($_SESSION['debug'], $message);

    return $array;
}

function fieldNamesToDropdownItems()
{
    $array = selectFields();

    for ($i = 0; $i < count($array); $i++) {
        if($i == 0){
            echo '<option selected="selected" value="'. $array[$i][0] .'" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="'. $array[$i][0] .'" class="dropdown-item">' . $array[$i][1] . '</option>';
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
        $message = "Cargos selecionados com sucesso!";
    } else {
        $message = "Erro ao selecionar cargos!";
        // $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    array_push($_SESSION['debug'], $message);

    return $array;
}

function roleNamesToDropdownItems()
{
    $array = selectRoles();

    for ($i = 0; $i < count($array); $i++) {
        if($i == 0){
            echo '<option selected="selected" value="'. $array[$i][0] .'" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="'. $array[$i][0] .'" class="dropdown-item">' . $array[$i][1] . '</option>';
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
        $message = "Instituições selecionadas com sucesso!";
    } else {
        $message = "Erro ao selecionar instituições!";
        // $message = "Error: " . $sql . "<br>" . $connection->error;
    }

    array_push($_SESSION['debug'], $message);

    return $array;
}

function institutionNamesToDropdownItems()
{
    $array = selectInstitutions();

    for ($i = 0; $i < count($array); $i++) {
        if($i == 0){
            echo '<option selected="selected" value="'. $array[$i][0] .'" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="'. $array[$i][0] .'" class="dropdown-item">' . $array[$i][1] . '</option>';
        }
    }
}
