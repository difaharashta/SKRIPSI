<?php
	include 'connect.php';
	$id = $_GET['id'];
	mysql_query("delete from link where id_link='$id'");

	header("location:form.php");
?>