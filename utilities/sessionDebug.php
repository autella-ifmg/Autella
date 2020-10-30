<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['debug'])) {
    echo '<script>';
    echo '        console.log("';

    for ($i = 0; $i < count($_SESSION['debug']); $i++) {
        if ($i < 10) {
            echo '0';
        }
        echo $i . ' -> ' . $_SESSION['debug'][$i] . '\n';
    }

    echo '                        ")';
    echo '</script>';
}
