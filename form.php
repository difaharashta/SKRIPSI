<?php
include 'header.php';
$id = $_GET['id']; //id katalog dari form togaf_katalog
$idperusahaan = $_SESSION['perusahaan_id'];


if(isset($_GET['tracebility'])){
  if($_GET['tracebility']==1){
    header("location:daftarform.php?id=".$id);
  }

}



$query = "select * from togaf_katalog where id_katalog='$id'";
$dataTogaf = mysql_fetch_array(mysql_query($query));


$queryGetModel = mysql_query("select * from togaf_model_katalog join togaf_model on (togaf_model_katalog.id_model=togaf_model.id_togaf) where id_katalog='$id'");
$dataModel = mysql_fetch_array($queryGetModel);
// print_r($dataTogaf);
/*
$querymodelkatalog = "select * from togaf_model_katalog where id_katalog='$id'";
$datamodelkatalog = mysql_fetch_array(mysql_query($querymodelkatalog));
$model = $datamodelkatalog['id_model'];
*/

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
      <p class="menunavigasi" style="font-size:13px;margin-top:10px">
        <a href="perusahaan.php">Perusahaan</a> > <a href="index.php">Menu</a> > <a href="model.php">Model</a> > <a href="model_detail.php?id=<?php echo $dataModel['id_togaf']; ?>">  <?php
        echo ucwords($dataModel['nama_togaf']);
        ?></a> > <a href="model_detail.php?id=<?php echo $dataTogaf['id_katalog']; ?>">  <?php
        echo ucwords($dataTogaf['nama_katalog']);
        ?></a>
      </p>
      <div class="row">
        <div class="col-md-12">
          <h3 style="margin:0px;margni-top:25px;text-align:center;">
            EDITOR FORM <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
          </h3>
          <hr style="margin:0px;padding:10px;"/>
          <p style="margin:10px;text-align:right">
            <a href="daftarform.php?id=<?php echo $id; ?>" class="btn btn-success"> Lihat Form  <?php echo ucwords($dataTogaf['nama_katalog']); ?> </a>
            <?php
            if($id!=5){

              ?>
              <a href="form-add.php?id=<?php echo $id; ?>" class="btn btn-success">Add Form </a>
              <?php
            }
            ?>
          </p>

          <table class="table  table-bordered table-left">
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
              <th>
                Edit
              </th>
              <th>
                Delete
              </th>
              <th>
                Add Link
              </th>


            </tr>
            <?php
            $no=1;
            // $idarc = $_SESSION['art_id'];
            $query = mysql_query("select * from form where id_katalog='".$id."' and id_perusahaan='$idperusahaan'");
            while($data=mysql_fetch_array($query)){

              ?>
              <!--
              <tr <?php if($no==1){
              ?> style="background:green;"<?php

            } ?>>
          -->
          <tr>
            <td>
              <?php echo $no; ?>
            </td>
            <td>
              <?php echo str_replace("%%","<br>",$data['nama']); ?>
            </td>
            <?php
            if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12 && $dataTogaf['id_katalog']!=1 && $dataTogaf['id_katalog']!=13)
            {
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
            }							?>
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
                echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataDari['id_link']."'>Delete</a>";
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
                //sehingga form dari akan langsung mengembalikan 'form_dari' dari database

                $queryDari="select * from form join togaf_katalog using(id_katalog) where id_form='".$dataKe['form_dari']."'";
                $exeDari = mysql_query($queryDari);
                $dataDari=mysql_fetch_array($exeDari);



                echo "Generate : ".$namaModel." <br/>Nama Link : ".$dataKe['nama_link']." <br/>Ke Form ".ucwords($dataDari['nama_katalog']);
                echo "<b> ( ".str_replace("%%","<br>",$dataDari['nama'])." ) </b>";
                echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataKe['id_link']."'>Delete</a>";

                echo "</p>";
              }
              ?>
            </td>
            <!-- $id = id katalog misalkan nama katalog nya apa(proses/jabatan dll) kalo id form isi si form nya -->
            <td>
              <a href="form-edit.php?id=<?php echo $id; ?>&idform=<?php echo $data['id_form']; ?>">Edit</a>
            </td>
            <td>
              <a href="form-delete.php?idform=<?php echo $id; ?>&id=<?php echo $data['id_form']; ?>">Delete</a>
            </td>
            <td>
              <a href="addlink.php?formid=<?php echo $data['id_form']; ?>">Add Link</a>
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



//batas stackholder

else{

  //batas stackholder


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
            EDITOR FORM <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
          </h3>
          <hr style="margin:0px;padding:10px;"/>
          <p style="margin:10px;text-align:right">
            <a href="daftarform.php?id=<?php echo $id; ?>" class="btn btn-success">Form <?php echo ucwords($dataTogaf['nama_katalog']); ?> </a>
            <a href="form-add.php?id=<?php echo $id; ?>" class="btn btn-success">Add</a>
          </p>

          <table class="table  table-bordered">
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
              <th>
                Edit
              </th>
              <th>
                Delete
              </th>
              <th>
                Add Link
              </th>
              <!--
              <th>
                Add People
              </th>

               -->
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

                    //nampilin isi tabel link dari form
                    echo "Generate : ".$namaModel." <br/>Nama Link : ".$dataDari['nama_link']." <br/>Ke Form ".ucwords($dataKe['nama_katalog']);
                    // echo $dataDari['nama_link']." Ke Form ".ucwords($dataKe['nama_katalog']);
                    echo "<b> ( ".$dataKe['nama']." ) </b>";
                    echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataDari['id_link']."'>Delete</a>";
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

                    //nampilin isi tabel link ke form
                    echo "Generate : ".$namaModel." <br/>Nama Link : ".$dataKe['nama_link']." <br/>Ke Form ".ucwords($dataDari['nama_katalog']);
                    //echo $dataKe['nama_link']." Dari Form ".ucwords($dataDari['nama_katalog']);
                    echo "<b> ( ".$dataDari['nama']." ) </b>";
                    echo "<a href='link-delete.php?idkatalog=".$id."&id=".$dataKe['id_link']."'>Delete</a>";

                    echo "</p>";
                  }
                  ?>
                </td>
                <td>
                  <a href="form-edit.php?id=<?php echo $id; ?>&idform=<?php echo $data['id_form']; ?>">Edit</a>
                </td>

                <!-- $id = id katalog misalkan nama katalog nya apa(proses/jabatan dll) kalo id form isi si form nya -->
                <td>
                  <a href="form-delete.php?idstack=<?php echo $data['id_stackholder']; ?>&status=<?php echo $data['status']; ?>&idform=<?php echo $id; ?>&id=<?php echo $data['id_form']; ?>">Delete</a>
                </td>
                <td>
                  <?php
                  // if($data['status']=="external"){

                  ?>
                  <a href="addlink.php?formid=<?php echo $data['id_form']; ?>">Add Link</a>
                  <?php
                  // }else{
                  // echo "-";
                  // }
                  ?>
                </td>

                <!--
                <td>
                  <a href="people.php?id=<?php echo $data['id_form']; ?>"><i class="fa fa-user fa-fw"></i></a>
                </td>
              -->



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
