<?php
	include 'admin/connect.php';
	$id = $_POST['id'];
	$visi = $_POST['visi'];
    // 
    mysql_query("UPDATE visi SET visi='$visi' where id_visi='$id'");
    header("location:visi.php");

?>