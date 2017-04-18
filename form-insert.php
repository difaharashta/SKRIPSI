<?php
	session_start();
	include 'admin/connect.php';
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$deskripsi = $_POST['deskripsi'];
    $idperusahaan = $_SESSION['perusahaan_id'];
	$parent = $_POST['parent'];
    if($id!=14){
    	mysql_query("INSERT INTO `form`(`id_katalog`, `nama`, `deskripsi`,`parent`,`id_perusahaan`) VALUES ('$id','$nama','$deskripsi','$parent','$idperusahaan')");
    	
    }else{
    	mysql_query("INSERT INTO `form`(`id_katalog`, `nama`, `deskripsi`,`parent`,`id_perusahaan`) VALUES ('$id','$nama','$deskripsi','$parent','$idperusahaan')");
    	$query = mysql_query("select max(id_form) as id from form");
    	$data = mysql_fetch_array($query);
    	$class = $_POST['class'];
    	$status = $_POST['status'];
    	mysql_query("INSERT INTO `stackholder`(`id_form`, `jabatan`, `class`,`status`) VALUES ('".$data['id']."','$nama','$class','$status')");
    	// if($status=="internal"){
			// mysql_query("INSERT INTO `form`(`id_katalog`, `nama`, `deskripsi`,`parent`,`id_perusahaan`) VALUES ('5','$nama','$deskripsi','$parent','$idperusahaan')");
    	// }

    }
    header("location:form.php?id=".$id);

?>