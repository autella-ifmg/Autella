<?php
session_start();
if (isset($_SESSION['userData'])) {
    require_once 'views/home.php';
} else {
    require_once 'views/loginGUI.php';
}
