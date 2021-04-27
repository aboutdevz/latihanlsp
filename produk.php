<?php session_start();?>
<?php include_once('process/Conn.php')?>
<?php if ( !isset($_SESSION['is_login']) ) header('Location: http://localhost/ujikomv2/login.php'); ?>
<?php
    
    $result         = $Conn->query(" SELECT * FROM tb_printer ");
    $resultArray    = $result->fetch_all(MYSQLI_ASSOC);
    
    if ( isset($_GET['id']) )
    {
        $id = $Conn->escape_string($_GET['id']);
        $resultModal = $Conn->query(" SELECT * FROM tb_printer WHERE `idprinter` = $id ");
        $resultModal = $resultModal->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Produk</title>
</head>

<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="process/logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-title">
                <h3 class="float-left">Data Produk</h3>
                <button class="button ml-2 float-right" id="id01-trigger" style=" padding:10px">Add New Data</button>
            </div>

            <div class="table-wrapper">
                <table class="styled-table">

                    <thead>
                        <tr>
                            <th>Nama Printer</th>
                            <th>Spesifikasi</th>
                            <th>Harga</th>
                            <th>Options</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach( $resultArray as $hasil ) :?>

                            <tr class="active-row">
                                <td><?= $hasil['namaprinter']?></td>
                                <td><?= $hasil['spesifikasi']?></td>
                                <td style="text-align:left;"><?= "Rp. " . number_format($hasil['harga'],2,'.',',') ?></td>
                                <td>
                                    <div id="id03" class="btn-group">
                                        <button class="id02-trigger" id="id02-trigger" onclick="getButtonUpdate(this);" data-id="<?=$hasil['idprinter']?>" data-namaprinter="<?=$hasil['namaprinter']?>" data-spesifikasi="<?=$hasil['spesifikasi']?>" data-harga="<?=$hasil['harga']?>">Update</button>
                                        <button> <a style="color:white;" href="process/delete_produk.php?id=<?= $hasil['idprinter']?>">Delete</a> </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button class="logout"> <a style="color:white;" href="index.php">Back</a> </button>





    <div id="id01" class="modal-container">
        <form class="form-modal" action="process/produk_add.php" method="post" autocomplete="off">
            <h4>Input Produk<h4>
            <small style="font-size: 0.7em;">Masukkanlah data produk yang ingin di Input</small>
            <br><br>
            <label> <b>Nama Printer</b> </label>
            <input type="text" name="namaprinter" placeholder="Masukkan Nama Printer">
            <label> <b>Spesifikasi</b> </label>
            <input type="text" name="spesifikasi" placeholder="Masukkan Spesifikasi Printer">
            <label> <b>Harga</b> </label>
            <input type="text" name="harga" placeholder="Masukkan Harga Printer">
            <div class="btn-group"></div>
            <button class="btn-wide" type="submit">Submit</button>
        </form>
    </div>

    <div id="id02" class="modal-container">
        <form class="form-modal" action="process/produk_update.php" method="post" autocomplete="off">
            <input id="id-update" class="id-update" type="hidden" name="id" value="">
            <h4>Update Produk</h4>
            <small style="font-size: 0.7em;">Masukkanlah data produk yang ingin di Input</small>
            <br><br>
            <label> <b>Nama Printer</b> </label>
            <input id="namaprinter" class="namaprinter" type="text" name="namaprinter" placeholder="Masukkan Nama Printer" >
            <label> <b>Spesifikasi</b> </label>
            <input id="spesifikasi" class="spesifikasi" type="text" name="spesifikasi" placeholder="Masukkan Spesifikasi Printer">
            <label> <b>Harga</b> </label>
            <input id="harga" class="harga" type="text" name="harga" placeholder="Masukkan Harga Printer">
            <div class="btn-group"></div>
            <button class="btn-wide" type="submit">Submit</button>
        </form>
    </div>

    <script src="css/script.js"></script>
</body>

</html>