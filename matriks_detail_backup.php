<?php
  include 'header.php';
  $id = $_GET['id']; //id matrix buat tau nama matriks 
  //buat ambil nama matriks
  $query = "select * from togaf_matriks where id_matriks='$id'"; 
  $dataMatriks = mysql_fetch_array(mysql_query($query));


  if($id==1){
    
	$idperusahaan = $_SESSION['perusahaan_id'];
  $queryMatriks = mysql_query("select * from form where id_katalog='5' and id_perusahaan='$idperusahaan'");
    

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
                        <?php
                        //nama matriks
                          echo strtoupper($dataMatriks['nama_matriks']);
                        ?> MATRIKS
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>


    <div id="orgChartContainer">
      <div id="orgChart"></div>
    </div>

                </div>
            </div>
            <a  onclick="window.history.back()" class="btn btn-danger back">Kembali</a>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  <!-- jQuery Version 1.11.0 -->
    <script src="admin/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/js/plugins/metisMenu/metisMenu.min.js"></script>



    <!-- DataTables JavaScript -->
    <script src="admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

  <script src="admin/js/jquery-1.11.0.js"></script>

    <script type="text/javascript" src="js/jquery.orgchart.js"></script>
    <script type="text/javascript">
    var testData = [
        <?php
        // $no
        while ($data=mysql_fetch_array($queryMatriks)) {
            $parent = 0;
            //menentukan root atau tidak
            if($data['parent']!='Root'){
                $parent=$data['parent'];
            }
            ?>
            //satu kotak struktur matriks
             {

                id: '<?php echo $data['nama']; ?>', 
                name: '<?php echo $data['nama']; ?>', 
                parent: '<?php echo $parent; ?>'

            },
            


            <?php
        }
        ?> 
         // {

         //        id: 'aaaa', 
         //        name: 'Aaaaaa', 
         //        parent: 'Asman 21'

         //    },
         //    {

         //        id: '123123123', 
         //        name: '12312312', 
         //        parent: 'aaaa'

         //    },
                   
    ];
    $(function(){
        org_chart = $('#orgChart').orgChart({
            data: testData
            // onAddNode: function(node){ 
            //     // log('Created new node on node '+node.data.id);
            //     // org_chart.newNode(node.data.id); 
            // },
            // onDeleteNode: function(node){
            //     // log('Deleted node '+node.data.id);
            //     // org_chart.deleteNode(node.data.id); 
            // },
            // onClickNode: function(node){
            //     // log('Clicked node '+node.data.id);
            // }

        });
    });


</script>

</body>

</html>

<?php


//buat create tabel
}else{

    if($_GET['idper']!=""){
    $idperusahaan = $_GET['idper'];
  }else{
    $idperusahaan = $_SESSION['perusahaan_id'];
  }
 //buat ngambil id katalog/form
$queryMatriksDaris = mysql_query("select * from link join form on(link.form_dari=form.id_form) where id_architecture='$id' and type_architecture='matriks' and link.id_perusahaan='$idperusahaan' group by id_form");
$queryMatriksKes = mysql_query("select * from link join form on(link.form_ke=form.id_form) where id_architecture='$id' and type_architecture='matriks' and link.id_perusahaan='$idperusahaan' group by id_form");

//buat ngambil isi katalog/form
$queryMatriksDari = mysql_query("select * from link join form on(link.form_dari=form.id_form) where id_architecture='$id' and type_architecture='matriks' and link.id_perusahaan='$idperusahaan' group by id_form");
$queryMatriksKe = mysql_query("select * from link join form on(link.form_ke=form.id_form) where id_architecture='$id' and type_architecture='matriks' and link.id_perusahaan='$idperusahaan' group by id_form");

//line 164 sampai 173 buat ngambil nama katalog/form
$dari = mysql_fetch_array($queryMatriksDaris);
$ke = mysql_fetch_array($queryMatriksKes);

$katalogDari = mysql_query("select * from togaf_katalog where id_katalog='".$dari['id_katalog']."' ");
$katalogKe = mysql_query("select * from togaf_katalog where id_katalog='".$ke['id_katalog']."' ");

$dataKatalogDari = mysql_fetch_array($katalogDari);
$dataKatalogKe = mysql_fetch_array($katalogKe);

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
                        <?php
                        //nama matriks
                          echo strtoupper($dataMatriks['nama_matriks']);
                        ?> MATRIKS
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
					<div style="text-align:right">
                        <!-- <a href="exporttoxml.php?type=matriks&id=<?php echo $id; ?>" class="btn btn-success">Export to XML</a> -->
                    </div>

    <div id="matriksTable">
      <table  class="table table-striped">
        <tr>
          <th>

            <?php
              echo ucwords($dataKatalogDari['nama_katalog']);
            ?> \
            <?php
              echo ucwords($dataKatalogKe['nama_katalog']);
            ?>
          </th>
          <?php 
          while ($dataMatriksDari = mysql_fetch_array($queryMatriksDari)) {
          ?>
          <th>
          <?php 
          $dataDari[] = $dataMatriksDari['id_form'];
          echo $dataMatriksDari['nama']; ?>
          </th>
          <?php
          }
          ?>
        </tr>

        <?php
           while ($dataMatriksKe = mysql_fetch_array($queryMatriksKe)) {
          ?>
          <tr>
            <th>
              <?php 
                echo $dataMatriksKe['nama']; ?>
            </th>
            <?php
            for ($i=0; $i <= count($dataMatriksDari); $i++) { 
              ?>
              <td>
                <?php
                  $queryLink = "select * from link where form_dari='".$dataDari[$i]."' and form_ke='".$dataMatriksKe['id_form']."' and id_architecture='$id' and type_architecture='matriks'";
                 $dataLink = mysql_fetch_array(mysql_query($queryLink));
                 echo $dataLink['nama_link'];

                 ?>
              </td>
              <?php
            }
            ?>
          </tr>
          <?php
          }
        ?>
      </table>
    </div>

                </div>
            </div>
                  <?php
  if($_GET['idper']!=""){
   ?>

            <a href="admin/model-perusahaan.php?id=<?php echo $_GET['idper'] ?>" class="btn btn-danger back">Kembali Ke Admin</a>
   <?php
  }else{
?>

            <a href="model.php" class="btn btn-danger back">Kembali</a>
   <?php  }
            ?>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  <!-- jQuery Version 1.11.0 -->
    <script src="admin/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/js/plugins/metisMenu/metisMenu.min.js"></script>



    <!-- DataTables JavaScript -->
    <script src="admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

  <script src="admin/js/jquery-1.11.0.js"></script>
 

</body>

</html>


<?php



}

?>
