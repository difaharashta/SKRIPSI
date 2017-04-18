<?php
	session_start();
	include 'admin/connect.php';
	$file = $_FILES['file']['name'];
	$fileTmp = $_FILES['file']['tmp_name'];
	
	//cara ngambil data xmlnya
	$data = simplexml_load_file($fileTmp);


	$idperusahaan = $_SESSION['perusahaan_id'];
	$model = $data->name;

		$architecture_name = strtolower($data->result->name);
		$architecture_tipe = strtolower($data->result->tipe);
		$items = $data->result->items;
		
		//buat nyari sesuai atau engga nama matrix/diagram yang ditulis
		if($architecture_tipe=="diagram"){
			$queryArch = mysql_query("select * from togaf_diagram where nama_diagram='$architecture_name'");
			$dataArch = mysql_fetch_array($queryArch);
			$idarch = $dataArch['id_diagram'];

		}else{
			$queryArch = mysql_query("select * from togaf_matriks where nama_matriks='$architecture_name'");
			$dataArch = mysql_fetch_array($queryArch);
			$idarch = $dataArch['id_matriks'];

		}
		if($idarch!=""){


		for($i=0;$i<count($items->node_from);$i++){
			$from = $items->node_from[$i];
			$link = $items->link[$i];
			$to = $items->node_to[$i];

			$queryFrom = mysql_query("select * from form where nama='$from'");
			$dataFrom = mysql_fetch_array($queryFrom);
			$cekFrom = mysql_num_rows($queryFrom);

			$queryTo = mysql_query("select * from form where nama='$to'");
			$dataTo = mysql_fetch_array($queryTo);
			$cekTo = mysql_num_rows($queryTo);

			
			
			if($cekFrom>0 || $cekTo>0){
				$idfrom= $dataFrom['id_form'];
				$idto= $dataTo['id_form'];

				$insert = mysql_query("INSERT INTO `link`(`id_architecture`, `id_perusahaan`, `type_architecture`, `form_dari`, `form_ke`, `nama_link`) VALUES ('$idarch','$idperusahaan','$architecture_tipe','$idfrom','$idto','$link')");

			}else{
				$errors= "ERROR. ADA YANG SALAH DI FORM";
			}

		}
	}else{
		$errors = "Architecture TIDAK Ditemukan";
	}
	

	header("location:index.php?error=".$errors);

?>