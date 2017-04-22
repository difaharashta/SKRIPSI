<?php
	include 'admin/connect.php';
	$id = $_GET['id'];
	$idkatalog = $_GET['idkatalog'];
	$link = mysql_fetch_array(mysql_query("select * from link where id_link='$id'"));
	mysql_query("delete from link where id_link='$id'");
	if (!($from = mysql_fetch_array(mysql_query("select * from link where form_dari='".$link['form_dari']."' OR form_ke='".$link['form_dari']."'")))) {
		mysql_query("delete from diagrams where id_form='".$link['form_dari']."' AND id_diagram='".$link['id_architecture']."'");
	}
	if (!($to = mysql_fetch_array(mysql_query("select * from link where form_dari='".$link['form_ke']."' OR form_ke='".$link['form_ke']."'")))) {
		mysql_query("delete from diagrams where id_form='".$link['form_ke']."' AND id_diagram='".$link['id_architecture']."'");
	}
//
	header("location:form.php?id=".$idkatalog);
?>
