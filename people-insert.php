<?php
	session_start();
	include 'admin/connect.php';
	$id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $noinduk = $_POST['noinduk'];
	$telepon = $_POST['telepon'];

    	mysql_query("INSERT INTO `people`(`id_jabatan`, `noinduk`, `nama`, `email`, `alamat`, `notelp`) VALUES ('$id','$noinduk','$nama','$email','$alamat','$telepon')");
    header("location:people.php?id=".$id);

?>