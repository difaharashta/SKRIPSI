<?php
  include 'header.php';


  if(isset($_GET['id_per'])){
      if($_GET['idper']!=""){
            $idperusahaan = $_GET['idper'];
      }else{
            $idperusahaan = $_SESSION['perusahaan_id'];
      }

  }else{
          $idperusahaan = $_SESSION['perusahaan_id'];
  }


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
				<a href="perusahaan.php">Perusahaan</a> > <a href="index.php">Menu</a> > <a href="model.php">Model</a> > <a href="model_detail.php?id=1">  Preliminary</a> > <a href="misi.php">  Misi</a>
			</p>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin:0px;margni-top:25px;text-align:center;">
                        EDITOR FORM MISI
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <p style="margin:10px;text-align:right">
					<a href="formmisi.php" class="btn btn-success">Form Misi</a>
                      <a href="misi-add.php" class="btn btn-success">Add</a>
                    </p>

                    <table class="table table-bordered table-left">
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          Misi
                        </th>
                        <th>
                          Edit
                        </th>
                        <th>
                          Delete
                        </th>


                      </tr>
                      <?php
                      $no=1;


                      $query = mysql_query("select * from misi where id_perusahaan='$idperusahaan'");
   while($data=mysql_fetch_array($query)){

    ?>

    <tr>
      <td>
        <?php echo $no; ?>
      </td>
      <td>
        <?php echo $data['misi']; ?>
      </td>
      <td>
        <a href="misi-edit.php?id=<?php echo $data['id_misi']; ?>">Edit</a>
      </td>
      <td>
        <a href="misi-delete.php?id=<?php echo $data['id_misi']; ?>">Delete</a>
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
  include 'footer.php';
?>
