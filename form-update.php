<?php
	include 'admin/connect.php';
	$id = $_POST['id'];
	$idform = $_POST['idform'];
	$nama = $_POST['nama'];
	$deskripsi = $_POST['deskripsi'];
	$parent = $_POST['parent'];



	if($id!="14"){
    mysql_query("UPDATE `form` SET `nama`='$nama',`deskripsi`='$deskripsi',`parent`='$parent' WHERE id_form='$idform'");

	}else{


		$class = $_POST['class'];
		$status = $_POST['status'];

		$queryGet = mysql_query("select * from stackholder where id_form='$idform'");
		$dataGet = mysql_fetch_array($queryGet);
		$statusOld = $dataGet['status'];


	    mysql_query("UPDATE `stackholder` SET `jabatan`='$nama',`class`='$class',`status`='$status' WHERE `id_form`='$idform'");
	    mysql_query("UPDATE `form` SET `nama`='$nama',`deskripsi`='$deskripsi',`parent`='$parent' WHERE id_form='$idform'");

		// if($status=="internal" && $statusOld=="external")	{
			// mysql_query("UPDATE `form` SET `nama`='$nama',`deskripsi`='$deskripsi',`parent`='$parent' WHERE id_form='$ids'");

		// }
		// else if($status=="external" && $statusOld=="internal")	{
			// $ids = $idform+1;
	    	// mysql_query("UPDATE `form` SET `nama`='$nama',`deskripsi`='$deskripsi',`parent`='$parent' WHERE id_form='$ids'");

		// }
		// else{
			// $ids = $idform+1;
	    	// mysql_query("UPDATE `form` SET `nama`='$nama',`deskripsi`='$deskripsi',`parent`='$parent' WHERE id_form='$ids'");

		// }

		
	}

	//kalo yang keluar itu dengan nama 'redir' maka kembali ke halaman dengan nama 'redir'

    if (isset($_POST['redir'])) {
		header("location:".$_POST['redir']);
	} else {
		header("location:form.php?id=".$id);
	}

?>
