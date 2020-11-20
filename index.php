<?php
session_start();
if (isset($_SESSION['userData'])) {
    header("Location: views/home.php");
} else {
    header("Location: views/loginGUI.php");
}
