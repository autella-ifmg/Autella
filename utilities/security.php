<?php
function secure($data)
{
    global $connection;
    $data = mysqli_escape_string($connection, $data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fazer função que recebe um inteiro e checa autorização
// Ex.: se passar 0, permite todo mundo
// se passar 1, só permite professores
// se passar 2, só permite professores e coordenadores
// se passar 3, só permite administradores do site