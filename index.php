<?php session_start();?>
<?php include_once('process/Conn.php');?>
<?php include_once('global.php');?>
<?php if ( !isset($_SESSION['is_login']) ) header('Location:'.BASEURL.'login.php'); ?>
<?php
    $cekIsi;
    $result = $Conn->query(" SELECT tb_transaksi.idtransaksi, tb_printer.namaprinter, 
                            tb_transaksi.jumlah, tb_printer.harga, 
                            tb_transaksi.userid2 FROM 
                            tb_transaksi INNER JOIN tb_printer ON 
                            tb_printer.idprinter = tb_transaksi.idprinter ");
    $resultArray = $result->fetch_all(MYSQLI_ASSOC);

    $printerData = $Conn->query(" SELECT `idprinter`, `namaprinter`,`harga` FROM tb_printer ");
    $printerData = $printerData->fetch_all(MYSQLI_ASSOC);
    $printerDataById = $Conn->query("SELECT tb_transaksi.idtransaksi, tb_printer.namaprinter, 
    tb_transaksi.jumlah, tb_printer.harga, 
    tb_transaksi.userid2 FROM 
    tb_transaksi INNER JOIN tb_printer ON 
    tb_printer.idprinter = tb_transaksi.idprinter where idtransaksi = 20");
    $printerDataById = $printerDataById->fetch_assoc();
    if ( $result->num_rows < 1 )
    {
        $cekIsi = false;
    }
    else
    {
        $cekIsi = true;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Home</title>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?= ($_SESSION['user'] != "admin") ? '' : '<li><a href="produk.php">Produk</a></li>' ?>
            <li><a href="process/logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
        <h2>Selamat Datang di Aplikasi Penjualan Printer</h2>
        <h4>Welcome <?= $_SESSION['user']?>!</h4>
        <?= ($_SESSION['user'] != "admin") ? '<button id="adduser" class="button" style="margin-top:30px; padding:10px" onclick="showAddUser();">Add New Pesanan</button>' : '' ?>
        
        <div class="table-wrapper">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nama Printer</th>
                    <th>Jumlah Unit</th>
                    <th>Harga Per Unit</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
    
            <tbody>
                <?php foreach( $resultArray as $hasil ) : ?>
                <tr class="active-row">                        
                        <td><?=$hasil['namaprinter']?></td>
                        <td><?=$hasil['jumlah']?></td>
                        <td> <?= "Rp. " . number_format($hasil['harga'],2,'.',',') ?></td>
                        <td><?= "Rp. " . number_format($hasil['jumlah'] * $hasil['harga'],2,'.',',') ?></td>
                        <td><?= ( $hasil['userid2'] == 1 ) ? "Sudah Dikonfirmasi" : "Belum Dikonfirmasi" ?></td>
                        <td>
                            <div class="btn-group">
                            
                                <?= ( $_SESSION['user'] == "admin" ) ? ( ($hasil['userid2'] == 0) ? ('<button> <a style="color:white;" href="process/konfirmasi.php?id='. $hasil['idtransaksi'] .'">Konfirmasi</a> </button>') : ('Done') ) : ( ($hasil['userid2'] != 0) ? ('<div class="btn-group">
    <button id="detailModalButton" style="background-color:#007bff; width:100%;"> <a style="text-decoration: none; color:white;" href="detail.php?id='.$hasil['idtransaksi'].'"> Detail</a></button>
    <button onclick="konfirmasi(this,user)" style="color:white;" data-id="'. $hasil['idtransaksi'] .'">Delete</button>
</div>') : ('<div class="btn-group">
<button data-id="'. $hasil['idtransaksi'] .'" data-idprinter="'. $hasil['namaprinter'] .'" data-jumlah="'. $hasil['jumlah'] .'" onclick="updateUser(this);">Update</button>
<button onclick="konfirmasi(this,user)" style="color:white;" data-id="'. $hasil['idtransaksi'] .'">Delete</button>
</div>') )?>
                            </div>
                        </td>
                </tr>
                <?php endforeach;?>
                <?php
                    if (!$cekIsi)
                    {
                        echo '<tr><td colspan="6"><h4>Tidak Ada Data</h4></td></tr>';
                    }
                ?>
                
            </tbody>
        </table>
        </div>

    </div>
    </div>
    <button class="logout"> <a style="color:white;" href="process/logout.php">Logout</a> </button>





    

    <div id="addUserModal" class="modal-container">
        <form class="form-modal" action="process/add.php" method="post" autocomplete="off">
            <h4>Input Produk</h4>
            <small style="font-size: 0.7em;">Masukkanlah data yang ingin di Input</small>
            <br><br>
            <label> <b>Nama Printer</b> </label>
            <select name="namaprinter">
                <?php foreach( $printerData as $printer ) : ?>
                    <option value="<?=$printer['idprinter']?>"><?=$printer['namaprinter']?>   (Harga Rp. <?= number_format($printer['harga'],2,'.',',')?>)</option>
                <?php endforeach;?>
            </select>
            <label> <b>Jumlah</b> </label>
            <input type="text" name="jumlah" placeholder="Masukkan Jumlah">
            <button class="btn-wide" type="submit">Submit</button>
        </form>
    </div>


    <div id="updateUserModal" class="modal-container">
        <form class="form-modal" action="process/update.php" method="post" autocomplete="off">
            <input id="idUserUpdate" type="hidden" name="id">
            <h4>Update Produk</h4>
            <small style="font-size: 0.7em;">Masukkanlah data yang ingin di Update</small>
            <br><br>
            <label> <b>Nama Printer</b> </label>
            <select id="namaPrinterUser" name="namaprinter">
                <?php foreach( $printerData as $printer ) : ?>
                    <option value="<?=$printer['idprinter']?>"><?=$printer['namaprinter']?> Harga Rp. <?=$printer['harga']?></option>
                <?php endforeach;?>
            </select>
            <label> <b>Jumlah</b> </label>
            <input id="jumlahUser" type="text" name="jumlah" placeholder="Masukkan Jumlah">
            <button class="btn-wide" type="submit">Submit</button>
        </form>
    </div>



    

<script src="css/script.js"></script>
</body>
</html>