<?php
function archiveQuestions($id_question) {
    $file = "E:\Área de Trabalho/dbSelect.php";
    $declaration = '$sql_archive = ';

    for ($i = 0; $i < count($id_question); $i++) {
        $declaration .= "$id_question[$i]";

        if($i == (count($id_question) - 1)) {
            $declaration .= ";";
        }
    }
    
    $openFile = fopen($file, "a");

    ftruncate($openFile, 15);

    fwrite($openFile, $declaration);

    fclose($openFile);
}

$id_question = [];

$id_question[0] = "AND question.id != 1 ";
$id_question[1] = "AND question.id != 2 ";
$id_question[2] = "AND question.id != 3 ";

archiveQuestions($id_question);
