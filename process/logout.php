<?php session_start();

session_destroy();
header('Location: http://localhost/ujikomv2/login.php');