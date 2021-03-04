<?php
function globalTest()
{
    $array = [];
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
   
    $sql = "SELECT * from global;";
    $array = [];
    $result = mysqli_query($connection, $sql);


    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
    }

for ($i = 0; $i < count($array); $i++) {
    $sql = "SELECT name from user WHERE id = " . $array[$i][1];
    $result = mysqli_query($connection, $sql);
    //$arrayname = [];
    array_push($array[$i], mysqli_fetch_array($result)[0]);
}
//var_dump($_SESSION['userData']);
//echo  
$connection->close();
//var_dump($array);
return $array;
}


?>