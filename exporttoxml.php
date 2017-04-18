<?php
session_start();
include 'admin/connect.php';
$id=$_GET['id'];
$type=$_GET['type'];
if($type=="diagram"){
	$query = mysql_query("select * from togaf_diagram join togaf_model_diagram using(id_diagram) join togaf_model on(togaf_model.id_togaf=togaf_model_diagram.id_model) where id_diagram='$id'");
	$data = mysql_fetch_array($query);

}


header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="togaf'.date('Ymdhis').'.xml"');
echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<togaf>";
	echo "<name>".strtoupper($data['nama_togaf'])."</name>";
	echo "<result>";
		echo "<name>".strtoupper($data['nama_diagram'])."</name>";
		echo "<tipe>DIAGRAM</tipe>";
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
	echo "</result>";
echo "</togaf>";
?>