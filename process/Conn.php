<?php

$host = "localhost";
$user = "root";
$pass = "Comanderix9";
$db   = "db_ujikom";

$Conn = new mysqli( $host, $user, $pass, $db );

if ( $Conn->connect_errno ) die ('connect error' . $Conn->connect_errno . $Conn->connect_error);


/*************************
*
*     DATABASE INFO
*
**************************/
/*
+---------------------+
| Tables_in_db_ujikom |
+---------------------+
| tab_user            |
| tb_printer          |
| tb_transaksi        |
+---------------------+

/* tab_user */
/*
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| iduser   | int(10)     | NO   | PRI | NULL    | auto_increment |
| username | varchar(50) | NO   |     | NULL    |                |
| password | varchar(10) | NO   |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+

/* tb_printer */
/*
+-------------+-------------+------+-----+---------+----------------+
| Field       | Type        | Null | Key | Default | Extra          |
+-------------+-------------+------+-----+---------+----------------+
| idprinter   | int(10)     | NO   | PRI | NULL    | auto_increment |
| namaprinter | varchar(50) | NO   |     | NULL    |                |
| spesifikasi | varchar(50) | NO   |     | NULL    |                |
| harga       | int(10)     | NO   |     | NULL    |                |
+-------------+-------------+------+-----+---------+----------------+



/* tb_transaksi */
/*
+---------------+---------+------+-----+---------+----------------+
| Field         | Type    | Null | Key | Default | Extra          |
+---------------+---------+------+-----+---------+----------------+
| idtransaksi   | int(10) | NO   | PRI | NULL    | auto_increment |
| idprinter     | int(10) | NO   |     | NULL    |                |
| jumlah        | int(10) | NO   |     | NULL    |                |
| userid        | int(10) | NO   |     | NULL    |                |
| userid2       | int(10) | NO   |     | NULL    |                |
| printer_tbl   | int(10) | NO   |     | NULL    |                |
| transaksi_tbl | int(10) | NO   |     | NULL    |                |
+---------------+---------+------+-----+---------+----------------+
*/
