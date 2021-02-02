<?php

function SimpleTestes()
{
    $array = [];
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    if($_SESSION['userData'][5] == 1){
    $sql = "SELECT * from Tests;";
    $array = [];
    $result = mysqli_query($connection, $sql);


    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
    }
    }
    else{
        $sql = "SELECT id_user,id from Tests;";
        $result = mysqli_query($connection, $sql);

        $arrayIdUser = [];
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($arrayIdUser, $row);
            }
            $arrayDisciplineUser = [];
            //Pegando o Id_Discipline de cada criador de prova ate o momento
        for ($i = 0; $i < count($arrayIdUser); $i++) {
               $sql = "SELECT id_discipline from user where id = " . $arrayIdUser[$i][0];
               $result = mysqli_query($connection, $sql);
               $row = mysqli_fetch_array($result);
               array_push($arrayDisciplineUser, $row);
        }
        //Array com id_disciple de cada usuario : var_dump($arrayDisciplineUser);
        $array = [];
        //var_dump($arrayDisciplineUser);
        //var_dump($arrayIdUser);
        for($i = 0; $i <count($arrayDisciplineUser); $i++){
            if($_SESSION['userData'][4] == $arrayDisciplineUser[$i][0]){
            $sql = "SELECT * from Tests where id = " . $arrayIdUser[$i][1];
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($result);
            array_push($array, $row);
            //echo $sql;
            }
        }
    }
}

   //var_dump($array);
        // array_push($_SESSION['debug'], "Questões selecionadas com sucesso!");
    
    
    for ($i = 0; $i < count($array); $i++) {
        $sql = "SELECT name from user WHERE id = " . $array[$i][1];
        $result = mysqli_query($connection, $sql);
        //$arrayname = [];
        array_push($array[$i], mysqli_fetch_array($result)[0]);
    }
    //var_dump($_SESSION['userData']);
    //echo  
    $connection->close();
    return $array;
}

