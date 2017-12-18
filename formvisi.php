<?php
  include 'header.php';
 
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
                         FORM VISI
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <p style="margin:10px;text-align:right">
					  
                    </p>

                    <table class="table table-striped table-left">
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          Visi
                        </th>
                        


                      </tr>
                      <?php
                      $no=1;
                       if($_GET['idper']!=""){
    $idperusahaan = $_GET['idper'];
  }else{
    $idperusahaan = $_SESSION['perusahaan_id'];
  }

                      $query = mysql_query("select * from visi where id_perusahaan='$idperusahaan'");
   while($data=mysql_fetch_array($query)){
                                       
    ?>

    <tr>
      <td>
        <?php echo $no; ?>
      </td>
      <td>
        <?php echo $data['visi']; ?>
      </td>
     

    </tr>
    <?php
    $no++;
}
    ?>
                    </table>
    



                </div>
            </div>
            <a  href="admin/model-perusahaan.php?id=<?php echo $_SESSION['perusahaan_id']?>" class="btn btn-danger back">Kembali</a>
           
			<!-- <a  onclick="window.history.back()" class="btn btn-danger back">Kembali</a> -->
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
  include 'footer.php';
?>

