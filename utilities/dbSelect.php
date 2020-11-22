<?php
//discipline
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
        // array_push($_SESSION['debug'], "Disciplinas selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar disciplinas!");
    }
    $connection->close();

    return $array;
}

function disciplineNames()
{
    $array = selectDisciplines();

    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i][0] == $_SESSION["userData"]["id_discipline"]) {
            echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item" selected="selected">' . $array[$i][2] . '</option>';
        } else {
            echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][2] . '</option>';
        }
    }
}

//field
function fieldNamesToDropdownItems()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

    $sql = "SELECT * FROM field;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        //array_push($_SESSION['debug'], "Áreas selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar Áreas!");
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

//institution
function institutionNamesToDropdownItems()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

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

//question
function selectQuestions($id_discipline, $start, $end, $limit)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    if ($limit) {
        $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, discipline.id, discipline.name, subject.name FROM question
            JOIN user ON question.id_user = user.id
            JOIN discipline ON discipline.id = " . $id_discipline . "
            JOIN subject ON question.id_subject = subject.id AND subject.id_discipline = " . $id_discipline . "
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] . " LIMIT " . $start . ", " . $end;
    } else {
        $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, discipline.id, discipline.name, subject.name FROM question
            JOIN user ON question.id_user = user.id
            JOIN discipline ON discipline.id = " . $id_discipline . "
            JOIN subject ON question.id_subject = subject.id AND subject.id_discipline = " . $id_discipline . "
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"];
    }
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

//role
function idRoleToRoleName($id)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql = "SELECT name from role WHERE id = '$id';";
    $result = mysqli_query($connection, $sql);

    $connection->close();
    return mysqli_fetch_array($result)[0];
}

function roleNamesToDropdownItems()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbConnect.php';

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
        if ($i == 0) {
            echo '<option selected="selected" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        } else {
            echo '<option value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][1] . '</option>';
        }
    }

    $connection->close();
}

//subject
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
        // array_push($_SESSION['debug'], "Matérias selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar matérias!");
    }

    return $array;
}

//user
function selectUsers()
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql = "SELECT user.id, user.name, user.email, role.name, field.name, discipline.name FROM user 
            JOIN discipline ON user.id_discipline = discipline.id
            JOIN field ON field.id = discipline.id_field
            JOIN role ON user.id_role = role.id
            WHERE user.id_institution = " . $_SESSION['userData']['id_institution'];

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <tr>
                    <th style="vertical-align: middle;">' . $row[0] . '</th>
                    <td style="vertical-align: middle;">' . $row[1] . '</td>
                    <td style="vertical-align: middle;">' . $row[2] . '</td>
                    <td style="vertical-align: middle;">' . $row[3] . '</td>
                    <td style="vertical-align: middle;">' . $row[4] . '</td>
                    <td style="vertical-align: middle;">' . $row[5] . '</td>
                    
                    <td class="d-flex flex-row justify-content-around" style="min-width: 200px">
                        <a class="mt-2" href="/cruds/user/readGUI.php?id=' . $row[0] . '">
                            <img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/eye.svg">
                        </a>
                        <a class="mt-2" href="">
                            <img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil.svg">
                        </a>
                        <a class="mt-2" href="">
                            <img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle.svg">
                        </a>
                    </td>
                </tr>
            ';
        }
        array_push($_SESSION['debug'], 'Usuários selecionados com sucesso!');
        $connection->close();
    } else {
        array_push($_SESSION['debug'], 'Erro ao selecionar usuários!');
    }
}
