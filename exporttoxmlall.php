<?php
session_start();
include 'admin/connect.php';

$idperusahaan = $_SESSION['perusahaan_id'];

	$queryDiagram = mysql_query("select * from link join togaf_diagram on(link.id_architecture=togaf_diagram.id_diagram) where id_perusahaan='$idperusahaan' and type_architecture='diagram' group by id_architecture");
	$queryMatriks = mysql_query("select * from link join togaf_matriks on(link.id_architecture=togaf_matriks.id_matriks) where id_perusahaan='$idperusahaan' and type_architecture='matriks' group by id_architecture");
	$queryKatalog = mysql_query("select * from form join togaf_katalog using(id_katalog) where id_perusahaan='$idperusahaan' group by id_katalog");

	$queryVisi = mysql_query("select * from visi where id_perusahaan='$idperusahaan'");
	$numVisi = mysql_num_rows($queryVisi);
	
	$queryMisi = mysql_query("select * from misi where id_perusahaan='$idperusahaan'");
	$numMisi = mysql_num_rows($queryMisi);
	

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="togaf'.date('Ymdhis').'.xml"');
echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<togaf>";
	echo "<name>TOGAF</name>";
	echo "<resultkatalog>";
	if($numVisi>0){

		echo "<katalog>";
			echo "<name>";
			echo "Visi";
			echo "</name>";
			while($dataVisi = mysql_fetch_array($queryVisi)){
				echo "<value>";
				echo $dataVisi['visi'];
				echo "</value>";
			}
		echo "</katalog>";
	}
	if($numMisi>0){

		echo "<katalog>";
			echo "<name>";
			echo "Misi";
			echo "</name>";
			while($dataMisi = mysql_fetch_array($queryMisi)){
				echo "<value>";
				echo $dataMisi['misi'];
				echo "</value>";				
			}
		echo "</katalog>";

	}
	while ($dataKatalog=mysql_fetch_array($queryKatalog)) {
		echo "<katalog>";
			echo "<name>";
			echo $dataKatalog['nama_katalog'];
			echo "</name>";

			if($dataKatalog['id_katalog']!=14){

				$queryForm = mysql_query("select * from form where id_katalog='".$dataKatalog['id_katalog']."' and id_perusahaan='$idperusahaan'");
				while ($dataForm = mysql_fetch_array($queryForm)) {
					echo "<formkatalog>";
						echo "<name>";
						echo $dataForm['nama'];
						echo "</name>";
						echo "<deskripsi>";
						echo $dataForm['deskripsi'];
						echo "</deskripsi>";
						echo "<parent>";
						echo $dataForm['parent'];
						echo "</parent>";
					echo "</formkatalog>";
				}
			}else{
				$queryForm = mysql_query("select * from form join stackholder using(id_form) where id_katalog='".$dataKatalog['id_katalog']."' and id_perusahaan='$idperusahaan'");
				while ($dataForm = mysql_fetch_array($queryForm)) {
					echo "<formkatalog>";
						echo "<name>";
						echo $dataForm['nama'];
						echo "</name>";
						echo "<class>";
						echo $dataForm['class'];
						echo "</class>";
						echo "<status>";
						echo $dataForm['status'];
						echo "</status>";
						echo "<deskripsi>";
						echo $dataForm['deskripsi'];
						echo "</deskripsi>";
						echo "<parent>";
						echo $dataForm['parent'];
						echo "</parent>";
					echo "</formkatalog>";
				}
			}

		echo "</katalog>";
	}
	echo "</resultkatalog>";
	echo "<resultdiagram>";
		while ($dataDiagram=mysql_fetch_array($queryDiagram)) {
		echo "<diagram>";
			echo "<name>";
				echo ucwords($dataDiagram['nama_diagram'])." Diagram";
			echo "</name>";
			echo "<relations>";
				$queryLink = mysql_query("select * from link where type_architecture='diagram' and id_architecture='".$dataDiagram['id_diagram']."' and id_perusahaan='$idperusahaan'");
				while ($dataLink=mysql_fetch_array($queryLink)) {
				echo "<item>";
					echo "<node_from>";
				
					$queryDari = mysql_query("select * from form join togaf_katalog using(id_katalog) where id_form='".$dataLink['form_dari']."'");
					$dataDari = mysql_fetch_array($queryDari);
					echo "<katalog>";
						echo $dataDari['nama_katalog'];
					echo "</katalog>";
					echo "<name>";
						echo $dataDari['nama'];
					echo "</name>";

					echo "</node_from>";
					
					echo "<link>";
					echo $dataLink['nama_link'];
					echo "</link>";

					echo "<node_to>";
					

					$queryKe = mysql_query("select * from form join togaf_katalog using(id_katalog)  where id_form='".$dataLink['form_ke']."'");
					$dataKe = mysql_fetch_array($queryKe);
					echo "<katalog>";
						echo $dataKe['nama_katalog'];
					echo "</katalog>";
					echo "<name>";
						echo $dataKe['nama'];
					echo "</name>";


					echo "</node_to>";
				echo "</item>";
				}
			echo "</relations>";
		echo "</diagram>";
		}
		echo "<items>";

			//link
			$idperusahaan = $_SESSION['perusahaan_id'];
			$queryLink = mysql_query("select * from link where type_architecture='$type' and id_architecture='$id' and id_perusahaan='$idperusahaan'");
			while ($dataLink=mysql_fetch_array($queryLink)) {
				echo "<node_from>";
				
				$queryKe = mysql_query("select * from form where id_form='".$dataLink['form_ke']."'");
				$dataKe = mysql_fetch_array($queryKe);
				echo $dataKe['nama'];

				echo "</node_from>";
				
				echo "<link>";
				echo $dataLink['nama_link'];
				echo "</link>";

				echo "<node_to>";
				

				$queryDari = mysql_query("select * from form where id_form='".$dataLink['form_dari']."'");
				$dataDari = mysql_fetch_array($queryDari);
				echo $dataDari['nama'];


				echo "</node_to>";
			}
		echo "</items>";
	echo "</resultdiagram>";
	echo "<resultmatriks>";
		while ($dataMatriks=mysql_fetch_array($queryMatriks)) {
		echo "<matriks>";
			echo "<name>";
				echo ucwords($dataMatriks['nama_matriks'])." Matriks";
			echo "</name>";
			echo "<relations>";
				$queryLink = mysql_query("select * from link where type_architecture='matriks' and id_architecture='".$dataMatriks['id_matriks']."' and id_perusahaan='$idperusahaan'");
				while ($dataLink=mysql_fetch_array($queryLink)) {
				echo "<item>";
					echo "<node_from>";
				
					
					$queryDari = mysql_query("select * from form join togaf_katalog using(id_katalog) where id_form='".$dataLink['form_dari']."'");
					$dataDari = mysql_fetch_array($queryDari);
					echo "<katalog>";
						echo $dataDari['nama_katalog'];
					echo "</katalog>";
					echo "<name>";
						echo $dataDari['nama'];
					echo "</name>";


					echo "</node_from>";
					
					echo "<link>";
					echo $dataLink['nama_link'];
					echo "</link>";

					echo "<node_to>";
					

					
					$queryKe = mysql_query("select * from form join togaf_katalog using(id_katalog) where id_form='".$dataLink['form_ke']."'");
					$dataKe = mysql_fetch_array($queryKe);
					echo "<katalog>";
						echo $dataKe['nama_katalog'];
					echo "</katalog>";
					echo "<name>";
						echo $dataKe['nama'];
					echo "</name>";



					echo "</node_to>";
				echo "</item>";
				}
			echo "</relations>";
		echo "</matriks>";
		}
		echo "<items>";

			//link
			$idperusahaan = $_SESSION['perusahaan_id'];
			$queryLink = mysql_query("select * from link where type_architecture='$type' and id_architecture='$id' and id_perusahaan='$idperusahaan'");
			while ($dataLink=mysql_fetch_array($queryLink)) {
				echo "<node_from>";
				
				$queryKe = mysql_query("select * from form where id_form='".$dataLink['form_ke']."'");
				$dataKe = mysql_fetch_array($queryKe);
				echo $dataKe['nama'];

				echo "</node_from>";
				
				echo "<link>";
				echo $dataLink['nama_link'];
				echo "</link>";

				echo "<node_to>";
				

				$queryDari = mysql_query("select * from form where id_form='".$dataLink['form_dari']."'");
				$dataDari = mysql_fetch_array($queryDari);
				echo $dataDari['nama'];


				echo "</node_to>";
			}
		echo "</items>";
	echo "</resultmatriks>";

echo "</togaf>";
?>