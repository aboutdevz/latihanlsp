<?php session_start();
include_once('Conn.php');

$id = $Conn->escape_string($_GET['id']) ;

if ( isset($_SESSION['is_login']) )
{
    $Conn->query("DELETE FROM tb_printer WHERE `idprinter` = $id ");

    if ( $Conn->affected_rows > 0 )
    {
        echo '<script>alert("data berhasil dihapus");window.location.assign("http://localhost/ujikomv2/produk.php");</script>';
    }
    else
    {
        echo '<script>alert("data gagal dihapus");window.location.assign("http://localhost/ujikomv2/produk.php");</script>';
    }
}