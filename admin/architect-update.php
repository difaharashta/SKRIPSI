<?php
	include 'connect.php';
	$id = $_POST['id'];
	$nama = $_POST['nama'];
    $username = $_POST['username'];
   	$password =  $_POST['password'];
    $konf_password = $_POST['konf_password'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $hp = $_POST['hp'];

     mysql_query("UPDATE `architect` SET `architect_nama`='$nama',`architect_username`='$username',`architect_password`='$password',`architect_email`='$email',`architect_alamat`='$alamat',`architect_kota`='$kota',`architect_provinsi`='$provinsi',`architect_nohp`='$hp' WHERE `architect_id`='$id'");
    header("location:architect.php");

?>