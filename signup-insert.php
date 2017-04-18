<?php
    session_start();
	include 'admin/connect.php';
	$nama = $_POST['nama'];
    $username = $_POST['username'];
   	$password =  $_POST['password'];
    $konf_password = $_POST['konf_password'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $hp = $_POST['hp'];

    if($password!=$konf_password){
        header("location:signup.php?error=Password Tidak Sesuai");

    }else{
        mysql_query("INSERT INTO `architect`(`architect_nama`, `architect_username`, `architect_password`, `architect_email`, `architect_alamat`, `architect_kota`, `architect_provinsi`, `architect_nohp`, `architect_status`) VALUES ('$nama','$username',md5('$password'),'$email','$alamat','$kota','$provinsi','$hp',0)");

        header("location:login.php?error=Tunggu Sampai Akun Anda Di aktifkan Oleh admin ");
    }

?>