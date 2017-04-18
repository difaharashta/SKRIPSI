<?php
  include 'header.php';
  $id = $_GET['id'];

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
                        Add PEOPLE
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="people-insert.php" method="post">
                        <div class="form-group">
                            <label> No Induk</label>
                            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                            <input required type="number" class="form-control" name="noinduk"/>
                        </div>
                        <div class="form-group">
                            <label> Nama</label>
                            <input required type="text" class="form-control" name="nama"/>
                        </div>
                         <div class="form-group">
                            <label> Email</label>
                            <input required type="email" class="form-control" name="email"/>
                        </div>
                         <div class="form-group">
                            <label> Alamat</label>
                            <textarea  required class="form-control" name="alamat"></textarea>
                        </div>
                         <div class="form-group">
                            <label> Telepon</label>
                            <input required type="number" class="form-control" name="telepon"/>
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

