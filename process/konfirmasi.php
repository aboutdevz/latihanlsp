<?php session_start();
include_once('Conn.php');
include_once('../global.php');

$id = $Conn->escape_string($_GET['id']) ;

if ( isset($_SESSION['is_login']) && $_SESSION['user'] == "admin" )
{
    $Conn->query(" UPDATE `tb_transaksi` SET `userid2` = 1 WHERE `idtransaksi` = $id ");

    if ( $Conn->affected_rows > 0 )
    {
        echo '<script>alert("data berhasil dikonfirmasi");window.location.assign("'.BASEURL.'index.php");</script>';
    }
    else
    {
        echo '<script>alert("data gagal dikonfirmasi");window.location.assign("'.BASEURL.'index.php");</script>';
    }
}