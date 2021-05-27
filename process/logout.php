<?php session_start();
include_once ('../global.php');
session_destroy();
header('Location: '.BASEURL.'login.php');