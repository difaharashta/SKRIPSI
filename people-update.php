<?php
	include 'admin/connect.php';
	$idj = $_POST['idj'];
	$id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $noinduk = $_POST['noinduk'];
	$telepon = $_POST['telepon'];

  	mysql_query("UPDATE `people` SET `id_jabatan`=$idj,`noinduk`='$noinduk',`nama`='$nama',`email`='$email',`alamat`='$alamat',`notelp`='$telepon' WHERE id_people='$id'");

	header("location:people.php?id=".$idj);


?>