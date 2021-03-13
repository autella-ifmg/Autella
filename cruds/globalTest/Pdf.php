<?php 
    require($_SERVER['DOCUMENT_ROOT'] . '/libraries/fpdf/fpdf.php');
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/test_global.php';
    $id_global = 3;
    $filter = "";
    $questions = selectGlobalQuestions(false, 0 ,0 , $filter, $id_global);
    //var_dump($questions);
    $enunciado = $questions[1]['enunciate'];
    $title = "IFMG";
    $pdf = new FPDF();
    $pdf -> AddPage();
    $pdf->SetTitle($title);
    // Arial bold 15
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,5,$enunciado);
    // Calculate width of title and position
    $w = $pdf->GetStringWidth($enunciado)+6;
    $pdf->SetX((210-$w)/2);
    // Colors of frame, background and text
    $pdf->SetDrawColor(221,221,221,1);
    $pdf->SetFillColor(10,158,0,1);
    $pdf->SetTextColor(255,255,255,1);
    // Thickness of frame (1 mm)
    $pdf->SetLineWidth(1);
    // Title
    // Cell(width, height, content, border, nextline parametters, alignement[c - center], fill)
    $pdf->Cell($w, 200, $enunciado, 1, 1, 'C', true);
    
    $pdf->Output();

?>