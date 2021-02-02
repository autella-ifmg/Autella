<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/tests.php';

global $connection;
if (!isset($_SESSION)) {
    session_start();
}



function dateTratament($creation_date)
{
    $creation_date = strtotime($creation_date);
    return $creation_date = "Criada em: " . date("d/m/Y", $creation_date);
}
function dateTratamentChange($date)
{
    $date = strtotime($date);
    return $date = "Ultima modificação em: " . date("d/m/Y", $date);
}
function data()
{   
    $array = SimpleTestes();
    echo '<table class="table"> <thead class="thead-dark"> <tr> <th> NOME DA PROVA </th> <th> DATA EM QUE FOI FEITA </th> <th> DATA DE ULTIMA MODIFICAÇÃO </th> <th> PROFESSOR QUE CRIOU </th> <TH colspan="2">EDIÇÕES DE PROVAS</thead>';
    //var_dump($array);
    if (!empty($array)) {
       
        if (count($array) > 0) {
            for ($i = 0; $i < count($array); $i++) {
                if($array[$i][5] != -1){
                $datamaking = "".dateTratament($array[$i][2]);
                $datachanging = "".dateTratamentChange($array[$i][3]);
                $nameTest = $array[$i][4];
                $nameTeacher = $array[$i][6];
                $id_test = $array[$i][0];
                echo ' <div>
                <tr>
                <td>  <a href="http://autella.com/cruds/simpleTest/readTestGUI.php?id='.$id_test.'">'.$nameTest.' </a></td>
                <td>'.$datamaking.' </td>
                <td>'.$datachanging.' </td>
                <td>'.$nameTeacher.' </td>
                <td><a href="http://autella.com/cruds/simpleTest/updateGUI.php?id='.$id_test.'">
                <img  src=../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil.svg alt=Editar height=25 />
                </a> </td>
                <td>
                <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg" alt="Deletar" height="25" onclick="chooseAction(0, ' . ($id_test) . ')" data-toggle="modal" data-target="#deleteModal"  data-toggle="tooltip" data-placement="bottom" title="Deletar questão"/></div>
                </td>
                </tr>
                </div>'; 
            }
            }
        }
       
    }
    echo '</table>';
    
}
    function deletTest($id_test){
        date_default_timezone_set("America/Sao_Paulo");
        $date = date("Y-m-d");
        //echo $id_test;
        global $connection;
        
        $sql =" UPDATE Tests set status = -1 WHERE id = '$id_test';";
        echo $sql;
        mysqli_query($connection, $sql);
    
    }


?>