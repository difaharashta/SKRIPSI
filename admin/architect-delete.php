<?php
	include 'connect.php';
	$id = $_GET['id'];
	mysql_query("delete from architect where architect_id='$id'");

	header("location:architect.php");
?>