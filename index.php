<?php
session_start();
if (isset($_SESSION['userData'])) {
    header("Location: views/home.php");
} else {
    header("Location: authentication/loginGUI.php");
}
