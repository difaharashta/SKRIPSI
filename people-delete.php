<?php
	include 'admin/connect.php';
	$id = $_GET['id'];
	$idj = $_GET['idj'];
	mysql_query("delete from people where id_people='$id'");
// 
	header("location:people.php?id=".$idj);
?>