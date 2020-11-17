<?php
function dificultyTratament($dificulty)
{
    switch ($dificulty) {
        case 1:
            return $dificulty = "Nível: Fácil";
            break;
        case 2:
            return $dificulty = "Nível: Médio";
            break;
        default:
            return $dificulty = "Nível: Difícil";
            break;
    }
}

function dateTratament($date)
{
    $date = strtotime($date);
    return $date = "Data de criação: " . date("d/m/Y", $date);
}
