<?php session_start();

include_once('Conn.php');

$namaPrinter = $Conn->escape_string($_POST['namaprinter']);
$jumlah = $Conn->escape_string($_POST['jumlah']);



if ( isset($_SESSION['is_login']) && $_SESSION['user'] != 'admin' )
{
    $result = $Conn->query(" INSERT INTO `tb_transaksi` (`idprinter`, 
                            `jumlah`, `userid2`) VALUES ($namaPrinter,
                            $jumlah, 0) ");
    if ( $Conn->affected_rows > 0 )
    {
        echo '<script>alert("data berhasil dimasukkan");window.location.assign("http://localhost/ujikomv2/index.php");</script>';
    }
    else
    {
        echo '<script>alert("data gagal dimasukkan");window.location.assign("http://localhost/ujikomv2/index.php");</script>';
    }
}

