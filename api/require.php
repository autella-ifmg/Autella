<?php
switch ($_GET['metodo']) {
    case 0: {
            echo "opcao 0";
            break;
        }

    case 1: {
            // require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/autella.com/database/dbConnect.php';
            $sql = "SELECT name, id FROM tests";
            $result = mysqli_query($connection, $sql);
            
            $resultado = '{
                            "provas":[
                                
                            
                ';

            while ($row = mysqli_fetch_row($result)) {
                $resultado .= '{';
                $resultado .= '"name": "' . $row[0] . '", ';
                $resultado .= '"id": ' . $row[1];
                $resultado .= '},';
            }
            
            $resultado .= "]}";
            $resultado = str_replace(',]', ']', $resultado);

            echo $resultado;
        }
}
