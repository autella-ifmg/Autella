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

function disciplineNames($action)
{
    $array = selectDisciplines();

    for ($i = 0; $i < count($array); $i++) {
        if ($action == 0) {
            if ($array[$i][0] == $_SESSION["userData"]["id_discipline"]) {
                echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item" selected="selected">' . $array[$i][2] . '</option>';
            } else {
                echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][2] . '</option>';
            }
        } else if ($action == 1) {
            if (($i - 1) == -1) {
                echo '<option name="null" id="null" value="null" class="dropdown-item" selected="selected">Escolha...</option>';
            } 
               
            echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][2] . '</option>';
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
function selectQuestions($limit, $start, $end, $filter)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql_limit = "";

    if ($limit) {
        $sql_limit = " LIMIT $start, $end;";
    }

    if (empty($filter)) {
        $id_discipline = "null";
        $id_subject = "question.id_subject";
        $dificulty = "";
        $date = "";
        $status = " AND question.status = 1";
    } else {
        $id_discipline = $filter[0] == null ? "null" : $filter[0];
        $id_subject = $filter[1] == null ? "question.id_subject" : $filter[1];
        $dificulty = $filter[2] == null ? "" : " AND question.dificulty = $filter[2]";
        $date = $filter[3] == null ? "" : " AND question.date = '$filter[3]'";
        $status = $filter[4] == null ? "" : " AND question.status = $filter[4]";
    }

    if ($id_discipline == "null") {
        $sql = "SELECT question.id, question.status, question.date, question.dificulty, question.enunciate, question.correctAnswer, 
            user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
            JOIN user ON user.id = question.id_user 
            JOIN discipline 
            JOIN subject ON subject.id = question.id_subject 
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] . "
            AND discipline.id = subject.id_discipline" . $status .
            $dificulty . $date . "
            ORDER BY discipline.name, subject.name " . $sql_limit;
    } else {
        $sql = "SELECT question.id, question.status, question.date, question.dificulty, question.enunciate, question.correctAnswer, 
        user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
        JOIN user ON user.id = question.id_user 
        JOIN discipline ON discipline.id = " . $id_discipline .
        " JOIN subject ON subject.id = ". $id_subject .
        " WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] .
        " AND discipline.id = subject.id_discipline AND subject.id = question.id_subject" 
        . $status . 
        $dificulty . $date .
        " ORDER BY discipline.name, subject.name " . $sql_limit;
    }
    //echo $sql;
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
//Provas
function selectTestQuestions($filter,$id_test)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";
    $id_discipline = $filter[0] == null ? "null" : $filter[0];
    $id_subject = $filter[1] == null ? "question.id_subject" : $filter[1];
   $sql = "SELECT id_question from question_test WHERE id_tests = ". $id_test;
   //echo $sql;
   $result = mysqli_query($connection, $sql);
   $arrayIDS = [];
   if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($arrayIDS, $row);
    }
}
    $array = [];
    for($i = 0; $i < count($arrayIDS); $i++){
        $sql = "SELECT question.id, question.status, question.date, question.dificulty, question.enunciate, question.correctAnswer, 
        user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
        JOIN user ON user.id = question.id_user 
        JOIN discipline ON discipline.id = " . $id_discipline .
        " JOIN subject ON subject.id = ". $id_subject .
        " WHERE question.id = ".$arrayIDS[$i][0];
        " ORDER BY discipline.name" ;
        //echo $sql;
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($array, $row);
            }
    }
}
    //echo $sql;
   

    $connection->close();
    return $array;
}
function SimpleTestes(){
    $array = [];
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";
    
    $sql = "SELECT * from Tests;";
    $result = mysqli_query($connection, $sql);


    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Questões selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar questões!");
    }
    for($i = 0; $i < count($array); $i++){
    $sql = "SELECT name from user WHERE id = ".$array[$i][1];
    $result = mysqli_query($connection, $sql);
    //$arrayname = [];
    array_push($array[$i],mysqli_fetch_array($result)[0]);
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
