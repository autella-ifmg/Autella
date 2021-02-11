<?php

function institutionNamesToDropdownItems()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT * FROM institution;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Instituições selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar instituições!");
    }

    for ($i = 0; $i < count($array); $i++) {
        if ($i == 0) {
            echo '<option selected="selected" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        }
    }

    $connection->close();
}

function getInstitutionStatus($id_institution)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT status FROM institution WHERE id = " . $id_institution;

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            return $row[0];
        }
        // array_push($_SESSION['debug'], 'Status da instituição obtido com sucesso!');
    } else {
        array_push($_SESSION['debug'], 'Erro ao obter status da instituição!');
    }
    $connection->close();
}