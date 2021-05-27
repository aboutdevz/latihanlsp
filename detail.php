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
    tb_printer.idprinter = tb_transaksi.idprinter where idtransaksi = ".$_GET['id']);
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
        <button class="button"> <a style="height:10px; width:auto; padding: 1em 2em; padding-bottom:23px; color:white; text-decoration: none;" href="index.php">Kembali</a> </button>
        <br>
        <br>
        <div class="card">
        <div id="detailModal" class="modal-cotainer">
        <h2>Detail transaksi</h2><br><br>
        <p><b>id transaksi :    </b>   <?=$printerDataById['idtransaksi']?></p>
        <hr> <br>
        <p><b>nama printer : </b>    <?=$printerDataById['namaprinter']?></p>
        <hr> <br>
        <p><b>jumlah unit  : </b>    <?=$printerDataById['jumlah']?></p>
        <hr> <br>
        <p><b>Harga per unit   : </b><?=$printerDataById['harga']?></p>
        <hr> <br>
        <p><b>Total    : </b>        <?= ($printerDataById['jumlah']) * ($printerDataById['harga'])?> </p>
        <hr> <br>
        <p><b>Status   : </b>        <?= ($printerDataById['userid2'] == 0) ? ('belum lunas') : ('lunas') ?></p>
        <hr> <br>

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
                    <option value="<?=$printer['idprinter']?>"><?=$printer['namaprinter']?>   Harga Rp. <?=$printer['harga']?></option>
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



    <div id="detailModal" class="modal-container">
        <h2>Detail transaksi</h2><br><br>
        <p><b>id transaksi :    </b>   <?=$printerDataById['idtransaksi']?></p>
        <hr>
        <p><b>nama printer : </b>    <?=$printerDataById['namaprinter']?></p>
        <hr>
        <p><b>jumlah unit  : </b>    <?=$printerDataById['jumlah']?></p>
        <hr>
        <p><b>Harga per unit   : </b><?=$printerDataById['harga']?></p>
        <hr>
        <p><b>Total    : </b>        <?= ($printerDataById['jumlah']) * ($printerDataById['harga'])?> </p>
        <hr>
        <p><b>Status   : </b>        <?= ($printerDataById['userid2'] == 0) ? ('belum lunas') : ('lunas') ?></p>
        <hr>

    </div>

<script src="css/script.js"></script>
</body>
</html>