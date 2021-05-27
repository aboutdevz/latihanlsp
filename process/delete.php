<?php session_start();
include_once('Conn.php');
include_once('../global.php');


$id = $Conn->escape_string($_GET['id']) ;

if ( isset($_SESSION['is_login']) && $_SESSION['user'] != 'admin' )
{
    $Conn->query("DELETE FROM tb_transaksi WHERE `idtransaksi` = $id ");

    if ( $Conn->affected_rows > 0 )
    {
        echo '<script>alert("data berhasil dihapus");window.location.assign("'.BASEURL.'index.php");</script>';
    }
    else
    {
        echo '<script>alert("data gagal dihapus");window.location.assign("'.BASEURL.'index.php");</script>';
    }
}