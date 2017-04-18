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
			 <p class="menunavigasi" style="font-size:13px;margin-top:10px">
				<a href="perusahaan.php">Perusahaan</a> > <a href="index.php">Menu</a> > <a href="model.php">Model</a>
			</p>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin:0px;margni-top:25px;text-align:center;">
                        Model EA
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <div class="box-menu">
                       <?php
                       $query = "select * from togaf_model";
                       $result = mysql_query($query);
                       while ($data=mysql_fetch_array($result)) {
                           ?>
                            <p>
                                <a href="model_detail.php?id=<?php echo $data['id_togaf']; ?>" class="btn btn-primary">

                                    <?php echo ucwords(strtolower($data['nama_togaf'])); ?></a>
                            </p>
                           <?php
                       }
                       ?>

                    </div>
                </div>
            </div>
            
            <a href="index.php" class="btn btn-danger back">Kembali</a>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
	include 'footer.php';
?>

