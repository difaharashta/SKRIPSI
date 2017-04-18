<?php
	include 'connect.php';
	$id = $_GET['id'];
	$id_arc = $_GET['id_arc'];
	mysql_query("update architect_perusahaan set architect_perusahaan_status=0 where architect_perusahaan_id='$id'");
	header("location:architect-perusahaan.php?id=$id_arc");
?>