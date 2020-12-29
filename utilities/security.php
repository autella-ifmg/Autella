<?php
function secure($data)
{
    global $connection;
    $data = mysqli_escape_string($connection, $data);
    $data = htmlspecialchars($data);
    return $data;
}
