<?php
session_start();
$idperusahaan = $_SESSION['perusahaan_id'];
	include 'admin/connect.php';
	$visi = $_POST['visi'];
    

    mysql_query("INSERT INTO `visi`(`visi`,`id_perusahaan`) VALUES ('$visi','$idperusahaan')");
    header("location:visi.php");

?>