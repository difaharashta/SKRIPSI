<?php
  include 'header.php';
  $id = $_GET['id']; //id model dari tabel togaf_model yang didirect dari model.php (preliminary dll)
  $query = "select * from togaf_model where id_togaf='$id'";
  $dataTogaf = mysql_fetch_array(mysql_query($query));
?>

    <div id="wrapper">

    <?php
	include 'nav.php';
	?>

      <div id="page-wrapper">
            <p style="font-size:12px;text-align:right;margin-top:10px;font-style:italic">
                Anda Sedang Menggunakan <?php
                echo "<b>".$_SESSION['perusahaan_nama']."</b>"; ?>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin:0px;margni-top:25px;text-align:center;">
                        <?php
                          echo strtoupper($dataTogaf['nama_togaf']);
                        ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
					
					 <?php
           if($id==1){
                       $query = "select * from togaf_model_katalog join togaf_katalog using(id_katalog) where id_model='$id'";
                       $result = mysql_query($query);
                       if(mysql_num_rows($result)>0){
                    ?>
                    <!-- css/style.css -->
                    <div class="box-menu-detail"> 
                      <h4>
                        Katalog
                      </h4>
                       <?php
                       while ($data=mysql_fetch_array($result)) {
                           ?>
                            <p>
                                <a href="<?php 
                                if($data['nama_katalog']=='visi' || $data['nama_katalog']=='misi' ){

                                echo $data['nama_katalog'];
                                }else{
                                echo "form";

                                }
                                 ?>.php?id=<?php echo $data['id_katalog']; ?>&tracebility=1" class="btn btn-primary">

                                  Form  <?php echo ucwords(strtolower($data['nama_katalog'])); ?></a>
                            </p>
                           <?php
                       }
                       ?>

                    </div>
                    <?php
                    }
                  }
                    ?>
					

 <?php
                       $query = "select * from togaf_model_matriks join togaf_matriks using(id_matriks) where id_model='$id'";
                       $result = mysql_query($query);
                       if(mysql_num_rows($result)>0){
                    ?>
                    <div class="box-menu-detail">
                      <h4>
                        Matriks
                      </h4>
                       <?php
                       while ($data=mysql_fetch_array($result)) {
                           ?>
                            <p>
                                <a href="matriks_detail.php?id=<?php echo $data['id_matriks']; ?>" class="btn btn-primary">

                                  <?php echo ucwords(strtolower($data['nama_matriks'])); ?> Matriks</a> 
                            </p>
                           <?php
                       }
                       ?>

                    </div>
                    <?php
                    }
                    ?>


<?php
                       $query = "select * from togaf_model_diagram join togaf_diagram using(id_diagram) where id_model='$id'";
                       $result = mysql_query($query);
                       if(mysql_num_rows($result)>0){
                    ?>
                    <div class="box-menu-detail">
                      <h4>
                      Diagram
                      </h4>
                       <?php
                       while ($data=mysql_fetch_array($result)) {
                           ?>
                            <p>
                                <a href="diagram_detail.php?id=<?php echo $data['id_diagram']; ?>" class="btn btn-primary">

                                  <?php echo ucwords(strtolower($data['nama_diagram'])); ?> Diagram</a> 
                            </p>
                           <?php
                       }
                       ?>

                    </div>
                    <?php
                    }
                    ?>




                </div>
            </div>
            <a href="tracebility.php" class="btn btn-danger back">Kembali</a>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
	include 'footer.php';
?>

