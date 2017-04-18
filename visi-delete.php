<?php
	include 'admin/connect.php';
	$id = $_GET['id'];
    

    mysql_query("delete from visi where id_visi='$id'");
    header("location:visi.php");

?>