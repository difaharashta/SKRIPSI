<?php
	session_start();
	include 'admin/connect.php';
	// print_r($_POST);
	$idarc = $_POST['idarc'];
	$formdari = $_POST['formdari'];
	$type = $_POST['type'];




	//mengambil checkbox yang dipilih
	$count=0;
	$i=0;
	while ($i <= count($_POST)) {
		if($_POST['check'.$i]!=""){
			$check[] =$i;
		}
		$i++;
	}

	//mengambil isi yang dipilih
	for ($i=0; $i < count($check); $i++) {
		$data[] = array(
			'idform' => $_POST['check'.$check[$i]],
			'namalink' => $_POST['namalink'.$check[$i]]
 		);
	}

	//masukin data ke db
	$idperusahaan = $_SESSION['perusahaan_id'];

	//kalau execute query nya ga ada
	if (!($from = mysql_fetch_array(mysql_query("select * from link where form_dari='".$formdari."' OR form_ke='".$formdari."'")))) 
	{
		mysql_query("INSERT INTO diagrams(id_diagram, id_perusahaan, id_form) VALUES ('$idarc', '$idperusahaan', '$formdari' )");
	}else{
		mysql_query("INSERT INTO diagrams(id_diagram, id_perusahaan, id_form) VALUES ('$idarc', '$idperusahaan', '$formdari' )");
	}

	for ($i=0; $i < count($data); $i++) {
	// echo "INSERT INTO link(id_architecture, id_perusahaan, type_architecture, form_dari, form_ke, nama_link) VALUES ('$idarc','$idperusahaan','$type','$formdari','".$data[$i]['idform']."','".$data[$i]['namalink']."')";
		
	if (!($to = mysql_fetch_array(mysql_query("select * from link where form_dari='".$data[$i]['idform']."' OR form_ke='".$data[$i]['idform']."'")))) {
			mysql_query("INSERT INTO diagrams(id_diagram, id_perusahaan, id_form) VALUES ('$idarc', '$idperusahaan', '".$data[$i]['idform']."' )");
		}
	else{
			mysql_query("INSERT INTO diagrams(id_diagram, id_perusahaan, id_form) VALUES ('$idarc', '$idperusahaan', '".$data[$i]['idform']."' )");
		}
		
	 	mysql_query("INSERT INTO link(id_architecture, id_perusahaan, type_architecture, form_dari, form_ke, nama_link) VALUES ('$idarc','$idperusahaan','$type','$formdari','".$data[$i]['idform']."','".$data[$i]['namalink']."')");
	
	}

	//hanya untuk balik lagi 
	//buat direct ke form yg pertama mau direlasiin/form dari ga ada hubungannya sama generate/ buat tabel link ke form dan link dari form
	$queryKatalog = mysql_query("select * from form where id_form='$formdari'");
	$dataKatalog = mysql_fetch_array($queryKatalog);
	$idkatalog = $dataKatalog['id_katalog'];
    header("location:form.php?id=".$idkatalog);

?>
