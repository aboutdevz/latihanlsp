<?php session_start();

include_once('Conn.php');

$username = $_POST['username'];
$password = $_POST['password'];

if ( $username || $password != "" )
{
    $result = $Conn->query("SELECT * FROM `tab_user` WHERE `username` = '$username' AND `password` = '$password' ");

    if ( $result->num_rows > 0 )
    {
        header('Location: http://localhost/ujikomv2/index.php');
        $_SESSION['is_login'] = true;
        $_SESSION['user'] = $result->fetch_assoc()['username'];
    }
    else
    {
        echo '<script>alert("Login Gagal pastikan username dan password anda benar");window.location.assign("http://localhost/ujikomv2/login.php");</script>';
    }
    $Conn->close();
}