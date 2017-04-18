<?php
    session_start();
	include 'admin/connect.php';

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password =  $_POST['password'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $hp = $_POST['hp'];

			$_SESSION['art_username'] = $username; //membuat session yang diisikan username 
		
	if($password==""){
		
     mysql_query("UPDATE `architect` SET `architect_nama`='$nama',`architect_username`='$username',`architect_email`='$email',`architect_alamat`='$alamat',`architect_kota`='$kota',`architect_provinsi`='$provinsi',`architect_nohp`='$hp' WHERE `architect_id`='$id'");
		
	}else{
    $password =  md5($_POST['password']);
    
	mysql_query("UPDATE `architect` SET `architect_nama`='$nama',`architect_username`='$username',`architect_password`='$password',`architect_email`='$email',`architect_alamat`='$alamat',`architect_kota`='$kota',`architect_provinsi`='$provinsi',`architect_nohp`='$hp' WHERE `architect_id`='$id'");
		
	}


    header("location:profile.php?edit=art");

?>