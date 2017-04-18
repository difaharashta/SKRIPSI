<?php
	include 'connect.php';
	$id = $_GET['id'];
	mysql_query("update architect set architect_status=0 where architect_id='$id'");
	header("location:architect.php");
?>