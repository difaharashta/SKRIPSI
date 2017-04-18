<?php
	include 'admin/connect.php';
	$id = $_GET['id'];
	mysql_query("delete from architect_perusahaan where architect_perusahaan_id='$id'");

	header("location:perusahaan.php");
?>