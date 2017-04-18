<?php
  include 'header.php';
 
  $id = $_GET['id'];
  $query = "select * from visi where id_visi='$id'";
  $dataTogaf = mysql_fetch_array(mysql_query($query));
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
                        EDIT VISI
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="visi-update.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <textarea class="form-control" rows=10 col=100 name="visi" placeholder="Masukkan Visi"><?php echo $dataTogaf['visi']; ?></textarea>
                                        </div>    
                     <button type="submit" class="form-control btn btn-success">Update </button>
                                   

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

