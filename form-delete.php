<?php
	include 'admin/connect.php';
	$id = $_GET['id'];
	$idform = $_GET['idform'];
	$status = $_GET['status'];
	$idstack = $_GET['idstack'];
	mysql_query("delete from stackholder where id_stackholder='$idstack'");
    mysql_query("delete from form where id_form='$id'");
    mysql_query("delete from link where form_ke='$id' or form_dari='$id'");
	
    // if($status=="internal"){
    	// $ids=$id+1;
    	// mysql_query("delete from form where id_form='$ids'");
    // }
    header("location:form.php?id=".$idform);

?>