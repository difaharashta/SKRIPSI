<?php
	include 'admin/connect.php';
	$id = $_GET['id'];
	$idkatalog = $_GET['idkatalog'];
	mysql_query("delete from link where id_link='$id'");
// 
	header("location:form.php?id=".$idkatalog);
?>