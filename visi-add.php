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
                        ADD VISI
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="visi-insert.php" method="post">
                        <div class="form-group">
                        <textarea class="form-control" rows=10 col=100 name="visi" placeholder="Masukkan Visi"></textarea>
                                        </div>    
                     <button type="submit" class="form-control btn btn-success">Tambah </button>
                                   

                    </form>



                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
	include 'footer.php';
?>

