<?php session_start();

include_once('Conn.php');
include_once('../global.php');


$id = $Conn->escape_string($_POST['id']);
$namaPrinter = $Conn->escape_string($_POST['namaprinter']);
$jumlah = $Conn->escape_string($_POST['jumlah']);



if ( isset($_SESSION['is_login']) && $_SESSION['user'] != 'admin' )
{
    $result = $Conn->query(" UPDATE `tb_transaksi` SET 
                            `idprinter` = $namaPrinter, 
                            `jumlah` = $jumlah, `userid2` = 0 
                            WHERE `idtransaksi` = $id ");

    if ( $Conn->affected_rows > 0 )
    {
        echo '<script>alert("data berhasil update");window.location.assign("'.BASEURL.'index.php");</script>';
    }
    else
    {
        echo '<script>alert("data gagal update");window.location.assign("'.BASEURL.'index.php");</script>';
    }
}

