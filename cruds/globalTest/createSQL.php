<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
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
    echo '    <div class="split left " style="width:35%;right:0%;"> <table class="table"> <thead class="thead-dark"> <tr> <th> NOME DA PROVA </th> <th> DATA EM QUE FOI FEITA </th> <th> DATA DE ULTIMA MODIFICAÇÃO </th> <th> PROFESSOR QUE CRIOU </th> <th> SELECIONAR PARA PROVA GLOBAL </th> </thead>';
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
                <div id = "TESTE'.$id_test.'">
                <tr>
                <td>  <a href="http://autella.com/cruds/simpleTest/readTestGUI.php?id='.$id_test.'">'.$nameTest.' </a></td>
                <td>'.$datamaking.' </td>
                <td>'.$datachanging.' </td>
                <td>'.$nameTeacher.' </td>
                </div>
                <td>
                  <img  src=../../../libraries/bootstrap/bootstrap-icons-1.0.0/arrow-right-square.svg alt=Editar height=25 onclick= "globalSend('.$id_test.')"/> 
                </td>
                </tr>
                </div>'; 
            }
            }
        }
       
    }
    echo '</div></table>';
    
}
function Globaldata()
{   
    $array = SimpleTestes();
    echo '    <div class="split left" style="width:35%;"> <table class="table"> <thead class="thead-dark"> <tr> <th> NOME DA PROVA </th> <th> DATA EM QUE FOI FEITA </th> <th> DATA DE ULTIMA MODIFICAÇÃO </th> <th> PROFESSOR QUE CRIOU </th> <th> SELECIONAR PARA PROVA GLOBAL </th> </thead>';
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
                echo ' <div id = "$id_test">
                <tr>
                <td>  <a href="http://autella.com/cruds/simpleTest/readTestGUI.php?id='.$id_test.'">'.$nameTest.' </a></td>
                <td>'.$datamaking.' </td>
                <td>'.$datachanging.' </td>
                <td>'.$nameTeacher.' </td>
                <td>
                <img  src=../../../libraries/bootstrap/bootstrap-icons-1.0.0/arrow-right-square.svg alt=Editar height=25 onclick=">
                </td>
                </tr>
                </div>'; 
            }
            }
        }
       
    }
    echo '</div></table>';
    
}
    function deletTest($id_test){
        date_default_timezone_set("America/Sao_Paulo");
        $date = date("Y-m-d");
        //echo $id_test;
        global $connection;
   
        
        $sql = "UPDATE autella.tests set status = -1 WHERE id = '$id_test';";
        echo $sql;
        $connection->query($sql);
    }


?>