<?php session_start();
include_once('Conn.php');

$id = $Conn->escape_string($_POST['id']);
$namaPrinter = $Conn->escape_string($_POST['namaprinter']);
$spesifikasi = $Conn->escape_string($_POST['spesifikasi']);
$harga = $Conn->escape_string($_POST['harga']);


if ( isset($_SESSION['is_login']) )
{
    if ( $_SESSION['user'] == "admin" )
    {
        $Conn->query(" UPDATE `tb_printer` SET `namaprinter` = '$namaPrinter',
                    `spesifikasi` = '$spesifikasi', `harga` = '$harga' WHERE `idprinter` = $id "); 

        if ( $Conn->affected_rows > 0 )
        {
            echo '<script>alert("data berhasil diupdate");window.location.assign("http://localhost/ujikomv2/produk.php");</script>';
        }
        else
        {
            echo '<script>alert("data gagal diupdate");window.location.assign("http://localhost/ujikomv2/produk.php");</script>';
        }
    }
}