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
     $id = $_POST['id'];
	
	
    mysql_query("UPDATE `architect_perusahaan` SET `architect_perusahaan_nama`='$nama',`architect_perusahaan_email`='$email',`architect_perusahaan_alamat`='$alamat',`architect_perusahaan_kota`='$kota',`architect_perusahaan_provinsi`='$provinsi',`architect_perusahaan_nohp`='$hp',`architect_perusahaan_fax`='$fax' WHERE `architect_perusahaan_id`='$id'");
    
    header("location:perusahaan.php");

?>