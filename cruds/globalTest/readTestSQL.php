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
    echo '    <div class="split left " style="width:44%;right:0%;left:2%"> <table class="table"> <thead class="thead-dark"> <tr> <th style="width:20%;"> NOME DA PROVA </th> <th style="width:20%;"> DATA EM QUE FOI FEITA </th> <th style="width:20%;"> DATA DE ULTIMA MODIFICAÇÃO </th> <th style="width:20%;"> PROFESSOR QUE CRIOU </th> <th style="width:20%;"> SELECIONAR PARA PROVA GLOBAL </th> </thead>';
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
                echo '<table class ="table" id = "simpleTest'.$id_test.'"> 
                <div>
                <tr>
                <td style="width:20%;" id = "name'.$id_test.'">  <a href="http://autella.com/cruds/globalTest/readTestGUI.php?id='.$id_test.'">'.$nameTest.' </a></td>
                <td style="width:20%;" id = "dataMaking'.$id_test.'">'.$datamaking.' </td>
                <td style="width:20%;" id = "dataChanging'.$id_test.'">'.$datachanging.' </td>
                <td style="width:20%;" id = "nameTeacher'.$id_test.'">'.$nameTeacher.' </td>
                
                <td>
                  <img  src=../../../libraries/bootstrap/bootstrap-icons-1.0.0/arrow-right-square.svg alt=Editar height=25 onclick= "globalSend('.$id_test.')"/> 
                </td>
                </tr>
                </div></table>';
            }
            }
        }
       
    }
    echo '</div></table>';
    
}

    function readGlobal($id){
        global $connection;
        $sql = "SELECT id_tests from test_global WHERE id_global = $id";  
        $result = mysqli_query($connection, $sql);
        $array = [];
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($array, $row);
            }
        
            for($i = 0; $i != count($array); $i ++){
              $sql = "SELECT * from tests where = "+$array[$i][0]+"";
              $result = mysqli_query($connection, $sql);
              $arrayInfo = [];
              if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    array_push($arrayInfo, $row);
                }
            } 
        }
            return $arrayInfo;
    }
}
    function insertInDatabase($globalList,$GlobalName)
{
    date_default_timezone_set("America/Sao_Paulo");
    $date = date("Y-m-d");
    //var_dump($globalList);
    global $connection;
    $id_user = $_SESSION["userData"]["id"];
    $sql = "INSERT into Global(id_user, making_date, changing_date, name) VALUES ('$id_user','$date','$date','$GlobalName');";  
   mysqli_query($connection, $sql);
    $id_global =  mysqli_insert_id($connection);
    if (!empty($globalList)) {
        if (count($globalList) > 0) {
            for ($i = 0; $i != count($globalList); $i++) {
                $id_test = $globalList[$i];    
                $sql = "INSERT into test_Global(id_global, id_tests) VALUES ('$id_global','$id_test');";
                //echo $sql;
               mysqli_query($connection, $sql);
            }
        }       
    }
}
