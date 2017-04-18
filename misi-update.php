<?php
	include 'admin/connect.php';
	$id = $_POST['id'];
	$misi = $_POST['misi'];
    // 
    mysql_query("UPDATE misi SET misi='$misi' where id_misi='$id'");
    header("location:misi.php");

?>