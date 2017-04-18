<?php
    session_start();
	include 'admin/connect.php';
	$nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $hp = $_POST['hp'];
    $fax = $_POST['fax'];
    $id = $_SESSION['art_id'];

    mysql_query("INSERT INTO `architect_perusahaan`(`architect_id`, `architect_perusahaan_nama`, `architect_perusahaan_email`, `architect_perusahaan_alamat`, `architect_perusahaan_kota`, `architect_perusahaan_provinsi`, `architect_perusahaan_nohp`, `architect_perusahaan_fax`, `architect_perusahaan_status`) VALUES ('$id','$nama','$email','$alamat','$kota','$provinsi','$hp','$fax',0)");
    
    header("location:perusahaan.php");

?>