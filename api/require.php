<?php
switch ($_GET['metodo']) {
    case 0: {
            echo "opcao 0";
            break;
        }

    case 1: {
            // require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/autella.com/database/dbConnect.php';
            $sql = "SELECT name, id, list_release_date FROM tests";
            $result = mysqli_query($connection, $sql);

            $resultado = '{
                            "provas":[
                                
                            
                ';

            while ($row = mysqli_fetch_row($result)) {
                $resultado .= '{';
                $resultado .= '"name": "' . $row[0] . '", ';
                $resultado .= '"id": ' . $row[1] . ', ';
                $resultado .= '"release_date": "' . $row[2] . '"';
                $resultado .= '},';
            }

            $resultado .= "]}";
            $resultado = str_replace(',]', ']', $resultado);

            echo $resultado;
            break;
        }
        case 2: {
            // require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/autella.com/database/dbConnect.php';
            $sql = "SELECT question.correctAnswer FROM question JOIN question_test ON question.id = question_test.id_question JOIN tests ON tests.id = question_test.id_tests WHERE tests.id = " . $_GET['idDaProva'];
            $result = mysqli_query($connection, $sql);

            $resultado = '{
                            "gabarito":[
                                
                            
                ';

            while ($row = mysqli_fetch_row($result)) {
                $resultado .= '{';
                $resultado .= '"alternativaCorreta": "' . $row[0] . '"';
                $resultado .= '},';
            }

            $resultado .= "]}";
            $resultado = str_replace(',]', ']', $resultado);

            echo $resultado;
            break;
        }
}
