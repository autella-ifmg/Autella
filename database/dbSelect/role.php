<?php

function idRoleToRoleName($id)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT name from role WHERE id = '$id';";
    $result = mysqli_query($connection, $sql);

    $connection->close();
    return mysqli_fetch_array($result)[0];
}

function roleNamesToDropdownItems()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT * FROM role;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        //array_push($_SESSION['debug'], "Cargos selecionados com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar cargos!");
    }

    for ($i = 0; $i < count($array); $i++) {
        // Impedir a exibição da opção "Coordenador do sistema"
        if ($i != 5) {
            if ($i == 0) {
                echo '<option selected="selected" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
            } else {
                echo '<option value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
            }
        }
    }

    $connection->close();
}