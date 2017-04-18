<?php
	include 'admin/connect.php';
	$id = $_GET['id'];
    

    mysql_query("delete from misi where id_misi='$id'");
    header("location:misi.php");

?>