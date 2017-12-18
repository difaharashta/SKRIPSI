<?php
	include 'connect.php';
	//$id = id_architect
	$id = $_GET['id'];
	//mysql_query("delete from architect join architect_perusahaan using (architect_id) join form using (architect_perusahaan_id) where architect_id='$id'");
	
	mysql_query("delete form, architect, architect_perusahaan, diagrams from form join architect join architect_perusahaan join diagrams on form.id_perusahaan = architect_perusahaan.architect_perusahaan_id AND architect_perusahaan.architect_id = architect.architect_id AND form.id_perusahaan = diagrams.id_perusahaan where architect.architect_id ='$id'");
    //Delete `form` FROM `architect` join `architect_perusahaan` on architect.`architect_id` = architect_perusahaan.`architect_id` join `form` on architect_perusahaan.`architect_perusahaan_id` = form.`id_perusahaan` where form.`id_perusahaan` = 16  
	
	 
	
	header("location:architect.php");

	?> 