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
				<a href="perusahaan.php">Perusahaan</a> > <a href="index.php">Menu</a>
			</p>
			<div class="row">
                <div class="col-md-12">
                    <h3 style="margin:0px;margni-top:25px;text-align:center;">
                        Menu
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <div class="box-menu">
                        <p>
                            <a href="model.php" class="btn btn-primary">Membuat Model EA</a>
                        </p>
                        <p>
                            <a href="importxml.php" class="btn btn-primary importBtn">Import File XML</a>
                             <p class="message" style="color:red;text-align:center">
                                    <?php
                                    if(isset($_GET['error'])){
                                        echo $_GET['error'];
                                        if($_GET['error']==""){
                                            echo "<span style='color:green'>Berhasil Di Import</span>";
                                      }
                                    }
                                    ?>
                                </p>
                            <form id="formupload" action="importxml.php" style="display:none"  method="post" enctype="multipart/form-data">
                                <input type="file" name="file" class="import btn" value="Import File XML"/>
                                <p style="text-align:center">
                                <input type="submit" value="Upload" class="btn btn-primary">
                                </p>
                               
                            </form>
                        </p>
                        <p>
                            <a href="tracebility.php" class="btn btn-primary">View Tracebility</a>
                        </p>
                        <p>
                            <a href="profile.php" class="btn btn-primary">View Profile</a>
                        </p>

                    </div>
                </div>
            </div>
			<!-- <div  style = "text-align:center !important;"> -->
            <a href="perusahaan.php" class="btn btn-danger back" style="margin-top:100px;">Kembali</a>
			
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
	include 'footer.php';
?>

