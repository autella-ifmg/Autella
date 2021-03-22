<?php 
    require('WritehtmlPdf.php');
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/test_global.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/global.php';
    $id_global = $_GET['id'];
    $filter = "";
    $questions = selectGlobalQuestions(false, 0 ,0 , $filter, $id_global);
    //var_dump($questions);
    //Declaração de informações usadas na capa
    $title = globalName($id_global);
    $capa = "                                         PROVA GLOBAL : {$title[0][0]}<br><br><br>                                               INSTRUÇÕES<br><br><br> Para cada uma das questões objetivas, são apresentadas 4 opções, identificadas com as letras (A), (B), (C) e (D). Apenas uma opção responde corretamente à questão. Você deve, portanto, assinalar apenas uma opção em cada questão. A marcação em mais de uma opção anula a questão, mesmo que uma das respostas esteja correta<br><br> Você somente poderá deixar o local de prova após decorridas DUAS HORAS do início da sua aplicação.<br>
    <br>Será atribuída a nota zero à sua avaliação, caso você:<br><br><br>
    1. Utilize, durante a realização da prova, máquinas e/ou relógios de calcular, bem como rádios, gravadores, headphones, telefones
    celulares ou fontes de consulta de qualquer espécie;<br><br>
    2. Se ausente da sala de provas levando consigo o CADERNO DE QUESTÕES e/ou o CARTÃO-RESPOSTA antes do prazo
    estabelecido;<br><br>
    3. Aja com incorreção ou descortesia para com qualquer participante do processo de aplicação das provas;<br><br>
    4. Comunique-se com outro participante, verbalmente, por escrito ou por qualquer outra forma<br><br>";
    $capa = iconv('UTF-8', 'windows-1252', $capa);
    $pdf = new PDF_HTML();
    $pdf -> AddPage();
    $pdf->SetTitle($title[0][0]);
    $pdf->SetFont('Arial','B',15);
    $pdf->WriteHTML($capa);
    $pdf -> AddPage();
    // Inserção de questões
    $pdf->SetFont('Arial','',10);
    for($n = 0; $n != count($questions); $n++){
    $enunciado = $questions[$n]['enunciate'];
    $enunciado = iconv('UTF-8', 'windows-1252', $enunciado);
    $numeroQuestao = "QUESTÃO {$n}";
    $numeroQuestao = iconv('UTF-8', 'windows-1252', $numeroQuestao);
    $pdf->WriteHTML("{$numeroQuestao}{$enunciado}");
    $pdf -> ln(15);
    }
    $pdf->Output();


   
?>