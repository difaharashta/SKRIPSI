<?php
session_start();
$idperusahaan = $_SESSION['perusahaan_id'];

	include 'admin/connect.php';
	$misi = $_POST['misi'];
    

    mysql_query("INSERT INTO `misi`(`misi`,`id_perusahaan`) VALUES ('$misi','$idperusahaan')");
    header("location:misi.php");

?>