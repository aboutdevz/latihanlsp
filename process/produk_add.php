<?php session_start();

include_once('Conn.php');
include_once('../global.php');

$namaPrinter = $Conn->escape_string($_POST['namaprinter']);
$spesifikasi = $Conn->escape_string($_POST['spesifikasi']);
$harga = $Conn->escape_string($_POST['harga']);



if ( isset($_SESSION['is_login']) && $_SESSION['user'] == 'admin' )
{
    $result = $Conn->query("INSERT INTO `tb_printer` (`namaprinter`, 
                            `spesifikasi`, `harga`) VALUES ('$namaPrinter',
                            '$spesifikasi', '$harga')");
    if ( $Conn->affected_rows > 0 )
    {
        echo '<script>alert("data berhasil dimasukkan");window.location.assign("'.BASEURL.'produk.php");</script>';
    }
    else
    {
        echo '<script>alert("data gagal dimasukkan");window.location.assign("'.BASEURL.'produk.php");</script>';
    }
}

