<?php
	session_start();
	include 'admin/connect.php';
	$perusahaan = $_POST['pilih'];
	$_SESSION['perusahaan_id'] = $perusahaan;
	$query = mysql_query("select * from architect_perusahaan where architect_perusahaan_id='$perusahaan'");
	$data = mysql_fetch_array($query);
	$_SESSION['perusahaan_nama'] = $data['architect_perusahaan_nama'];
	header("location:index.php"); //redirect ke login.php dengan pesan error

?>