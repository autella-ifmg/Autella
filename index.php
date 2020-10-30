<?php
session_start();
 if (isset($_SESSION['userData'])) {
     header("Location: utilities/home.php");
 } else {
     header("Location: utilities/loginProfessor.php");
 }
