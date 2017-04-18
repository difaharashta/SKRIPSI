<?php
	session_start();
	include 'admin/connect.php';
	$file = $_FILES['file']['name'];
	$fileTmp = $_FILES['file']['tmp_name'];
	
	
	//cara ngambil data xmlnya
	$data = simplexml_load_file($fileTmp);


	$idperusahaan = $_SESSION['perusahaan_id'];
	$model = $data->name;

	$dataKatalog = $data->resultkatalog;

	// echo "<pre>";
	// print_r($dataKatalog);
	// echo "</pre>";
	

	// insert data data katalog
	foreach ($dataKatalog->katalog as $valueKatalog) {
		$katalogName = $valueKatalog->name;
		$katalogValue = $valueKatalog->value;
		
		if($katalogValue!=""){
			for($i=0;$i<count($katalogValue);$i++){
				if(strtolower($katalogName)=="visi"){
					
						mysql_query("insert into visi (visi,id_perusahaan) values ('".$katalogValue[$i]."','$idperusahaan')");
				}
				if(strtolower($katalogName)=="misi"){
								
						mysql_query("insert into misi (misi,id_perusahaan) values ('".$katalogValue[$i]."','$idperusahaan')");
				}

			}
		}
		
		if($valueKatalog->name!="" && strtolower($valueKatalog->name)!="visi" && strtolower($valueKatalog->name)!="misi"){

			$queryKat = mysql_query("select id_katalog from togaf_katalog where nama_katalog='".$valueKatalog->name."'");
			$dataKat = mysql_fetch_array($queryKat);
			$idKat = $dataKat['id_katalog'];

			foreach ($valueKatalog->formkatalog as $valueForm) {
				 $nama = $valueForm->name;
				$deskripsi = $valueForm->deskripsi;
				$parent = $valueForm->parent;
				mysql_query("INSERT INTO `form`(`id_katalog`, `nama`, `deskripsi`, `parent`, `id_perusahaan`) VALUES ('$idKat','$nama','$deskripsi','$parent','$idperusahaan')");
				//kalo stackholder
				if($idKat==14){
					$class = $valueForm->class;
					$status = $valueForm->status;
					$querym = mysql_query("select max(id_form) as id from form");
    				$datam = mysql_fetch_array($querym);
					mysql_query("INSERT INTO `stackholder`(`id_form`, `jabatan`, `class`, `status`) VALUES ('".$datam['id']."','$nama','$class','$status')");
				}
			}
			// echo "<br/>";


		}
	}




	//import data diagram
	$dataDiagram = $data->resultdiagram;
	foreach ($dataDiagram->diagram as $valueDiagram) {
		$name = str_replace("diagram", "", strtolower($valueDiagram->name));
		$queryArch = mysql_query("select * from togaf_diagram where nama_diagram='$name'");
		$dataArch = mysql_fetch_array($queryArch);
		$idarch = $dataArch['id_diagram'];

		foreach ($valueDiagram->relations->item as $valueItem) {

			$katalognamaFrom= $valueItem->node_from->katalog;
			$namaFrom= strtolower($valueItem->node_from->name);
			$queryKatFrom = mysql_query("select id_katalog from togaf_katalog where nama_katalog='".$katalognamaFrom."'");
			$dataKatFrom = mysql_fetch_array($queryKatFrom);
			$idKatFrom = $dataKatFrom['id_katalog'];

			$queryFrom = mysql_query("select * from form where nama='$namaFrom' and id_katalog='$idKatFrom' and id_perusahaan='$idperusahaan'");
			$dataFrom = mysql_fetch_array($queryFrom);
			$cekFrom = mysql_num_rows($queryFrom);

			$link = $valueItem->link;

			$katalognamaTo= $valueItem->node_to->katalog;
			$namaTo= strtolower($valueItem->node_to->name);
			$queryKatTo = mysql_query("select id_katalog from togaf_katalog where nama_katalog='".$katalognamaTo."'");
			$dataKatTo = mysql_fetch_array($queryKatTo);
			$idKatTo = $dataKatTo['id_katalog'];

			$queryTo = mysql_query("select * from form where nama='$namaTo' and id_katalog='$idKatTo' and id_perusahaan='$idperusahaan'");
			$dataTo = mysql_fetch_array($queryTo);
			$cekTo = mysql_num_rows($queryTo);




			if($cekFrom>0 || $cekTo>0){
				 $dataFrom['nama']." - ".$link." - ".$dataTo['nama'];
				$idfrom= $dataFrom['id_form'];
				$idto= $dataTo['id_form'];

				$insert = mysql_query("INSERT INTO `link`(`id_architecture`, `id_perusahaan`, `type_architecture`, `form_dari`, `form_ke`, `nama_link`) VALUES ('$idarch','$idperusahaan','diagram','$idfrom','$idto','$link')");

			}

		}
	}



	//import data matriks
	$dataMatriks = $data->resultmatriks;
	foreach ($dataMatriks->matriks as $valueMatriks) {
	// print_r($dataMatriks);
		$name = str_replace("matriks", "", 	strtolower($valueMatriks->name));
		$queryArch = mysql_query("select * from togaf_matriks where nama_matriks='$name'");
		$dataArch = mysql_fetch_array($queryArch);
		 $idarch = $dataArch['id_matriks'];

		foreach ($valueMatriks->relations->item as $valueItem) {

			$katalognamaFrom= $valueItem->node_from->katalog;
			$namaFrom= strtolower($valueItem->node_from->name);
			$queryKatFrom = mysql_query("select id_katalog from togaf_katalog where nama_katalog='".$katalognamaFrom."'");
			$dataKatFrom = mysql_fetch_array($queryKatFrom);
			$idKatFrom = $dataKatFrom['id_katalog'];

			$queryFrom = mysql_query("select * from form where nama='$namaFrom' and id_katalog='$idKatFrom' and id_perusahaan='$idperusahaan'");
			$dataFrom = mysql_fetch_array($queryFrom);
			$cekFrom = mysql_num_rows($queryFrom);

			 $link = $valueItem->link;

			$katalognamaTo= $valueItem->node_to->katalog;
			$namaTo= strtolower($valueItem->node_to->name);
			$queryKatTo = mysql_query("select id_katalog from togaf_katalog where nama_katalog='".$katalognamaTo."'");
			$dataKatTo = mysql_fetch_array($queryKatTo);
			$idKatTo = $dataKatTo['id_katalog'];

			$queryTo = mysql_query("select * from form where nama='$namaTo' and id_katalog='$idKatTo' and id_perusahaan='$idperusahaan'");
			$dataTo = mysql_fetch_array($queryTo);
			$cekTo = mysql_num_rows($queryTo);




			if($cekFrom>0 || $cekTo>0){
				 $dataFrom['nama']." - ".$link." - ".$dataTo['nama'];
				$idfrom= $dataFrom['id_form'];
				$idto= $dataTo['id_form'];

				$insert = mysql_query("INSERT INTO `link`(`id_architecture`, `id_perusahaan`, `type_architecture`, `form_dari`, `form_ke`, `nama_link`) VALUES ('$idarch','$idperusahaan','matriks','$idfrom','$idto','$link')");

			}

		}
		
	}



	header("location:index.php?error=".$errors);

?>