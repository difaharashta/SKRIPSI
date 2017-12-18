<?php
	include 'connect.php';
	$id = $_GET['id'];
	$id_arc = $_GET['id_arc'];
	mysql_query("delete from architect_perusahaan where architect_perusahaan_id='$id'");
	mysql_query("delete * from form where architect_perusahaan_id='$id'"); 
	header("location:architect-perusahaan.php?id=".$id_arc);
?>