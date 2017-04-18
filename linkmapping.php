<?php
  include 'header.php';
   $formid = $_GET['formid'];
  $idarc = $_GET['idarc'];
  $type = $_GET['type'];
  $idkatalog = $_GET['idkatalog'];
  $idarci = $_SESSION['art_id'];
  $idperusahaan = $_SESSION['perusahaan_id'];
  $queryKatalog = "select * from togaf_katalog where id_katalog='$idkatalog'";
  $dataKatalog = mysql_fetch_array(mysql_query($queryKatalog));
  // echo $idarc;


  if($idkatalog==6 && $idarc==1){

	$query = "select * from form where id_katalog='".$idkatalog."' and id_perusahaan='$idperusahaan' and id_form!='$formid' and parent='root'";

  }else{

  $query = "select * from form where id_katalog='".$idkatalog."' and id_perusahaan='$idperusahaan' and id_form!='$formid'";
  }
  $datas = mysql_query($query);
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
                        FORM <?php echo strtoupper($dataKatalog['nama_katalog']); ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="linksubmit.php" method="post">
                      <input type="hidden" value="<?php echo $formid; ?>" name="formdari"/>
                      <input type="hidden" value="<?php echo $idarc; ?>" name="idarc"/>
                      <input type="hidden" value="<?php echo $type; ?>" name="type"/>


                      <table class="table table-striped">
                        <tr>
                          <th>
                            No.
                          </th>
                          <th>
                            Nama Link
                          </th>
                          <th>
                            Nama <?php echo ucwords($dataKatalog['nama_katalog']); ?>
                          </th>
                          <th>
                            Pilih
                          </th>


                        </tr>
                        <?php
                        $no=1;
     while($data=mysql_fetch_array($datas)){

      ?>

      <tr>
        <td>
          <?php echo $no; ?>
        </td>
        <td>
          <input type="text" name="namalink<?php echo $no; ?>"
        </td>
        <td>
        <!--  <?php echo $data['nama']; ?> -->
		  <?php echo str_replace("%%","<br>",$data['nama']); ?>
        </td>
        <td>
          <input type="checkbox" value="<?php echo $data['id_form']; ?>" name="check<?php echo $no; ?>"/>
        </td>


      </tr>
      <?php
      $no++;
  }
      ?>
                      </table>
                      <input type="submit" value="Submit" class="btn btn-success form-control"/>
      </form>



                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
  include 'footer.php';
?>
