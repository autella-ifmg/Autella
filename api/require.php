<?php
switch ($_GET['metodo']) {
    case 0: {
            echo "opcao 0";
            break;
        }

    case 1: {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
            $sql = "SELECT name FROM tests";
            $result = mysqli_query($connection, $sql);
            $nomes = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($nomes, $row[0]);
            }
            echo json_encode($nomes);
        }
}
