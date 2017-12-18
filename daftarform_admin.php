<?php
  include 'header.php';
  $id = $_GET['id']; //id katalog dari form togaf_katalog
  $query = "select * from togaf_katalog where id_katalog='$id'";
  $dataTogaf = mysql_fetch_array(mysql_query($query));
   if($id!=14){

?>

    <div id="wrapper">

    <?php
  include 'nav.php';
  ?>

      <div id="page-wrapper">
            <p style="font-size:12px;text-align:right;margin-top:10px;font-style:italic">
                Anda Sedang Menggunakan Perusahaan <?php
                echo "<b>".$_SESSION['perusahaan_nama']."</b>"; ?>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin:0px;margni-top:25px;text-align:center;">
                        FORM <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <p style="margin:10px;text-align:right">


                    </p>

                    <table class="table table-bordered table-left">
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          <?php if($id!=4){

						  echo "Nama ";
						  }
						   echo ucwords($dataTogaf['nama_katalog']); ?>
                        </th>
						<?php
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12 && $dataTogaf['id_katalog']!=1 && $dataTogaf['id_katalog']!=13){
							?>
                        <th>
                          Deskripsi
                        </th>
						<?php
						}
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12){

						?>
                        <th>
                          Parent
                        </th>
							<?php
						}
						?>
                        <th>
                          Link Ke Form
                        </th>
                        <th>
                          Terima Link dari Form
                        </th>



                      </tr>
                      <?php
                      $no=1;
                       if(isset($_GET['idper']) && $_GET['idper']!=""){
    $idperusahaan = $_GET['idper'];
  }else{
    $idperusahaan = $_SESSION['perusahaan_id'];
  }
                      $query = mysql_query("select * from form where id_katalog='".$id."' and id_perusahaan='$idperusahaan'");
   while($data=mysql_fetch_array($query)){

    ?>

    <tr>
      <td>
        <?php echo $no; ?>
      </td>
      <td>
        <?php echo str_replace("%%","<br>",$data['nama']); ?>
      </td>
	  <?php
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12 && $dataTogaf['id_katalog']!=1 && $dataTogaf['id_katalog']!=13){
							?>

	  <td style="text-align:left !important">
        <?php echo str_replace("%%","<br>",$data['deskripsi']); ?>
      </td>
	  <?php
						}
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12){

						?>
      <td>
        <?php echo $data['parent']; ?>
      </td>
	  <?php
						}
						?>
       <td>
        <?php
        //proses mengambil link dari form yang dipilih
        $queryDari = "select * from link join form on(form.id_form=link.form_dari) join togaf_katalog using(id_katalog) where link.form_dari='".$data['id_form']."'";
        $exeDari = mysql_query($queryDari);
        while ($dataDari=mysql_fetch_array($exeDari)) {
          echo "<p>";

		if($dataDari['type_architecture']=="diagram"){

          $queryModel="select * from togaf_diagram where id_diagram='".$dataDari['id_architecture']."'";
          $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_diagram'])." Diagram";
		}else{
           $queryModel="select * from togaf_matriks where id_matriks='".$dataDari['id_architecture']."'";
			 $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_matriks'])." Matriks";
		}

          //proses mengambil link ke form
          $queryKe="select * from form join togaf_katalog using(id_katalog) where id_form='".$dataDari['form_ke']."'";
          $exeKe = mysql_query($queryKe);
          $dataKe=mysql_fetch_array($exeKe);


          echo "Generate : ".$namaModel." <br/>Nama Link : ".$dataDari['nama_link']." <br/>Ke Form ".ucwords($dataKe['nama_katalog']);
          echo "<b> ( ".str_replace("%%","<br>",$dataDari['nama'])." ) </b>";
         // echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataDari['id_link']."'>Delete</a>";
          echo "</p>";
        }
        ?>
      </td>
      <td>
          <?php
        //proses link form ke
        $queryKe = "select * from link join form on(form.id_form=link.form_ke) join togaf_katalog using(id_katalog) where link.form_ke='".$data['id_form']."'";
        $exeKe = mysql_query($queryKe);
        while ($dataKe=mysql_fetch_array($exeKe)) {
          echo "<p>";

		if($dataKe['type_architecture']=="diagram"){

          $queryModel="select * from togaf_diagram where id_diagram='".$dataKe['id_architecture']."'";
          $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_diagram'])." Diagram";
		}else{
           $queryModel="select * from togaf_matriks where id_matriks='".$dataKe['id_architecture']."'";
			 $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_matriks'])." Matriks";
		}


          //proses mengambil form dari

           $queryDari="select * from form join togaf_katalog using(id_katalog) where id_form='".$dataKe['form_dari']."'";
          $exeDari = mysql_query($queryDari);
          $dataDari=mysql_fetch_array($exeDari);



          echo "Generate : ".$namaModel." <br/>Nama Link : ".$dataKe['nama_link']." <br/>Ke Form ".ucwords($dataDari['nama_katalog']);
          echo "<b> ( ".str_replace("%%","<br>",$dataDari['nama'])." ) </b>";
             //echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataKe['id_link']."'>Delete</a>";

          echo "</p>";
        }
        ?>
      </td>


    </tr>
    <?php
    $no++;
}
    ?>
                    </table>




                </div>
            </div>
			<?php
			if(isset($_GET['id_per']) && $_GET['id_per']!=""){

			?>
             <a  onclick="model.php" class="btn btn-danger back">Kembali</a>
			<?php
			}
			?>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php
	//batas stackholder
   }
else{
?>

    <div id="wrapper">

    <?php
  include 'nav.php';
  ?>

      <div id="page-wrapper">
            <p style="font-size:12px;text-align:right;margin-top:10px;font-style:italic">
                Anda Sedang Menggunakan Perusahaan <?php
                echo "<b>".$_SESSION['perusahaan_nama']."</b>"; ?>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin:0px;margni-top:25px;text-align:center;">
                        FORM <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>



                    <table class="table  table-bordered table-left">
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          Nama <?php echo ucwords($dataTogaf['nama_katalog']); ?>
                        </th>

                        <th>
                          Parent
                        </th>
                        <th>
                          Class
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Link Ke Form
                        </th>
                        <th>
                          Terima Link dari Form
                        </th>


                      </tr>
                      <?php
                      $no=1;
                        $id_perusahaan = $_SESSION['perusahaan_id'];
                        $idarc = $_SESSION['art_id'];
						// echo "select * from form join stackholder using(form_id) where id_katalog='".$id."' and id_perusahaan='$id_perusahaan'";
                      $query = mysql_query("select * from form join stackholder using(id_form) where id_katalog='".$id."' and id_perusahaan='$id_perusahaan'");
   while($data=mysql_fetch_array($query)){

    ?>

    <tr>
      <td>
        <?php echo $no; ?>
      </td>
      <td>
        <?php echo str_replace("%%","<br>",$data['nama']); ?>
      </td>


      <td>
        <?php echo $data['parent']; ?>
      </td>
      <td>
        <?php echo $data['class']; ?>
      </td>
      <td>
        <?php echo $data['status']; ?>
      </td>
       <td>
        <?php
        //proses mengambil link dari form yang dipilih
        $queryDari = "select * from link join form on(form.id_form=link.form_dari) join togaf_katalog using(id_katalog) where link.form_dari='".$data['id_form']."'";
        $exeDari = mysql_query($queryDari);
        while ($dataDari=mysql_fetch_array($exeDari)) {
          echo "<p>";

		if($dataDari['type_architecture']=="diagram"){

          $queryModel="select * from togaf_diagram where id_diagram='".$dataDari['id_architecture']."'";
          $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_diagram'])." Diagram";
		}else{
           $queryModel="select * from togaf_matriks where id_matriks='".$dataDari['id_architecture']."'";
			 $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_matriks'])." Matriks";
		}

          //proses mengambil link ke form
          $queryKe="select * from form join togaf_katalog using(id_katalog) where id_form='".$dataDari['form_ke']."'";
          $exeKe = mysql_query($queryKe);
          $dataKe=mysql_fetch_array($exeKe);


          echo "Generate : ".$namaModel." <br/>Nama Link : ".$dataDari['nama_link']." <br/>Ke Form ".ucwords($dataKe['nama_katalog']);
          echo "<b> ( ".str_replace("%%","<br>",$dataDari['nama'])." ) </b>";
          //echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataDari['id_link']."'>Delete</a>";

          echo "</p>";
        }
        ?>
      </td>
      <td>
          <?php
        //proses link form ke
        $queryKe = "select * from link join form on(form.id_form=link.form_ke) join togaf_katalog using(id_katalog) where link.form_ke='".$data['id_form']."'";
        $exeKe = mysql_query($queryKe);
        while ($dataKe=mysql_fetch_array($exeKe)) {
          echo "<p>";

		if($dataKe['type_architecture']=="diagram"){

          $queryModel="select * from togaf_diagram where id_diagram='".$dataKe['id_architecture']."'";
          $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_diagram'])." Diagram";
		}else{
           $queryModel="select * from togaf_matriks where id_matriks='".$dataKe['id_architecture']."'";
			 $exeModel  = mysql_query($queryModel);
			$dataModel = mysql_fetch_array($exeModel);
			$namaModel = ucwords($dataModel['nama_matriks'])." Matriks";
		}


          //proses mengambil form dari

           $queryDari="select * from form join togaf_katalog using(id_katalog) where id_form='".$dataKe['form_dari']."'";
          $exeDari = mysql_query($queryDari);
          $dataDari=mysql_fetch_array($exeDari);



          echo "Generate : ".$namaModel." <br/>Nama Link : ".$dataKe['nama_link']." <br/>Ke Form ".ucwords($dataDari['nama_katalog']);
          echo "<b> ( ".str_replace("%%","<br>",$dataDari['nama'])." ) </b>";
            // echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataKe['id_link']."'>Delete</a>";

          echo "</p>";
        }
        ?>
      </td>

    </tr>
    <?php
    $no++;
}
    ?>
                    </table>




                </div>
            </div>
            <a href="model.php" class="btn btn-danger back">Kembali</a>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
}

  include 'footer.php';
?>
