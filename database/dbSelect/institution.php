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

function institutionsToRows(){
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT id, full_name, phone, email, status FROM institution";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <tr>
                    <td style="vertical-align: middle;"> 
                        <a class="mt-2" href="/cruds/institution/readGUI.php?id=' . $row[0] . '">
                            <img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/eye.svg">
                        </a> 
                    </td>
                    <td style="vertical-align: middle;">' . $row[1] . '</td>
                    <td style="vertical-align: middle;">' . $row[2] . '</td>
                    <td style="vertical-align: middle;">' . $row[3] . '</td>

                    <td style="vertical-align: middle;">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch' . $row[0] . '" onChange="changeInstitutionStatus(' . $row[0] . ')"';

            // Se a conta estiver ativada, colocar atributo "checked"
            if($row[4] == 1){
                echo 'checked';
            }
        
            echo '>
                            <label style="cursor: pointer;" class="custom-control-label" for="customSwitch' . $row[0] . '"></label>
                        </div>
                    </td>
                </tr>
            ';
        }
        // array_push($_SESSION['debug'], 'Usuários selecionados com sucesso!');
    } else {
        array_push($_SESSION['debug'], 'Erro ao selecionar usuários!');
    }
    $connection->close();
}