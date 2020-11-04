<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['debug'])) {
    $scr = "";
    $scr .= '<script charset="UTF-8">';
    $scr .= 'console.log("';

    for ($i = 0; $i < count($_SESSION['debug']); $i++) {
        ;
        if ($i < 10) {
            $scr . '0';
        }
        $scr .=  $i . ' -> ' . $_SESSION['debug'][$i] . '\n';
    }
    $scr .= '");';
    $scr .=  '</script>';
    
    echo $scr;
} 

// Se der erro, faça logout
