<?php
  include 'header.php';
  $id = $_GET['id'];
  $idj = $_GET['idj'];
   $queryForm = "select * from people where id_people='$id'";
  $dataForm = mysql_fetch_array(mysql_query($queryForm));

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
                        ADD PEOPLE
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="people-insert.php" method="post">
                        <div class="form-group">
                            <label> No Induk</label>
                            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                            <input type="hidden" value="<?php echo $idj; ?>" name="idj"/>
                            <input type="text" class="form-control" name="noinduk" value="<?php echo $dataForm['noinduk']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label> Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $dataForm['nama']; ?>"/>
                        </div>
                         <div class="form-group">
                            <label> Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $dataForm['email']; ?>"/>
                        </div>
                         <div class="form-group">
                            <label> Alamat</label>
                            <textarea  class="form-control" name="alamat"><?php echo $dataForm['alamat']; ?></textarea>
                        </div>
                         <div class="form-group">
                            <label> Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="<?php echo $dataForm['notelp']; ?>"/>
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

