<?php
  include 'header.php';
  $id = $_GET['id'];
  $idform = $_GET['idform'];
  $query = "select * from togaf_katalog where id_katalog='$id'";
  $dataTogaf = mysql_fetch_array(mysql_query($query));



    if($id!=14){

  $queryForm = "select * from form where id_form='$idform'";
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
                        EDIT <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="form-update.php" method="post">
                        <div class="form-group">
                            <label> Nama <?php echo ucwords($dataTogaf['nama_katalog']); ?></label>
                            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                            <input type="hidden" value="<?php echo $idform; ?>" name="idform"/>
                            <input type="text" class="form-control" name="nama" value="<?php echo $dataForm['nama'] ?>"/>
                        </div>
						<?php
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12 && $dataTogaf['id_katalog']!=1 && $dataTogaf['id_katalog']!=13)
							{
								?>
                        <div class="form-group">
                            <label> Deskripsi Tambahan <?php echo ucwords($dataTogaf['nama_katalog']); ?></label>
                            <textarea class="form-control" name="deskripsi"><?php echo $dataForm['deskripsi'] ?></textarea>
                        </div>
						<?php
							}
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12 && $dataTogaf['id_katalog']!=13){
							?>

                        <div class="form-group">
                            <label>Parent </label>
                            <select name="parent" class="form-control">
                                <option value="-">-</option>
								<option <?php
								if($dataForm['parent']=="Root"){
									echo "selected";
								}
                                //Memberikan opsi untuk menentukan Parent-nya
                                ?> <option value="Root">Root</option>
                                 <?php
                                     $idperusahaan = $_SESSION['perusahaan_id'];

                                     //query untuk mengambil id_katalog dari form_edit yang sedag dibuka
                                     //berguna untuk menampilkan form-form apa saja yang akan dipilih untuk dijadikan Parent sesuai dengan
                                     //form-form yang ada di dalam katalog tersebut
                                    $query = mysql_query("select * from FORM where id_katalog='$id' and id_perusahaan='$idperusahaan'");
                                   while($data=mysql_fetch_array($query)){
                                ?>
                                <option value="<?php echo $data['nama'] ?>"
								<?php
								if($dataForm['parent']==$data['nama']){
									echo "selected";
								}
                                ?>
								><?php echo $data['nama']; ?></option>

                                <?php
                                }
                                ?>

                            </select>

                        </div>

<?php
						}
            //Tempat button edit melakukan submit untuk kembali ke halaman diagram
    ?>
      <?php
        if(isset($_GET['redir'])){
          ?>
          <input type="hidden" name="redir" value= "<?= $_GET['redir']?>"/>

          <?php
        }
        ?>




                     <button type="submit" class="form-control btn btn-success">Edit </button>


                    </form>



                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
}
  else{
 $queryForm = "select * from form join stackholder using(id_form) where id_katalog='".$id."' and id_form='$idform'";

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
                        EDIT <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>

                    <!-- Form Dimulai -->
                    <form action="form-update.php" method="post">
                      <?php
                          if(isset($_GET['redir'])){
                            ?>
                          <input type="hidden" name="redir" value= "<?= $_GET['redir']?>"/>

                          <?php
                          }
                          ?>

                        <div class="form-group">
                            <label> Nama <?php echo ucwords($dataTogaf['nama_katalog']); ?></label>
                            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                            <input type="hidden" value="<?php echo $idform; ?>" name="idform"/>
                            <input type="text" class="form-control" name="nama" value="<?php echo $dataForm['nama'] ?>"/>
                        </div>

       <div class="form-group">
                            <label>Parent Jabatan</label>
                            <select name="parent" class="form-control">
                                <option value="-">-</option>
                                <option <?php
								if($dataForm['parent']=="Root"){
									echo "selected";
								}
								?> value="Root">Root</option>
                                 <?php
                                    $idperusahaan = $_SESSION['perusahaan_id'];
                                    $query = mysql_query("select * from form where id_katalog='$id' and id_perusahaan='$idperusahaan'");
                                    while($data=mysql_fetch_array($query)){
                                ?>
                                <option <?php
								if($data['nama']==$dataForm['parent']){
									echo "selected";
								}

								?> value="<?php echo $data['nama'] ?>"><?php echo $data['nama']; ?></option>

                                <?php
                                }
                                ?>

                            </select>

                        </div>
                        <div class="form-group">
                            <label> Class </label>
                            <select class="form-control" name="class">
                                <option value="Keep Satisfied" <?php
                                if($dataForm['class']=='Keep Satisfied'){
                                  echo "selected";
                                }
                                ?>>Keep Satisfied</option>
                                <option value="Keep Players" <?php
                                if($dataForm['class']=='Key Players'){
                                  echo "selected";
                                }
                                ?>>Key Players</option>
                                <option value="Keep Informed" <?php
                                if($dataForm['class']=='Keep Informed'){
                                  echo "selected";
                                }
                                ?>>Keep Informed</option>
                                <option value="Keep Informed" <?php
                                if($dataForm['class']=='Minimal Efford'){
                                  echo "selected";
                                }
                                ?>>Minimal Efford</option>

                            </select>
                        </div>
<div class="form-group">
                            <label> Status </label>
                            <select class="form-control" name="status">
                                <option value="external" <?php
                                if($dataForm['status']=='external'){
                                  echo "selected";
                                }
                                ?>>Eksternal</option>
                                <option value="internal" <?php
                                if($dataForm['status']=='internal'){
                                  echo "selected";
                                }
                                ?>>Internal</option>
                            </select>
                        </div>



                     <button type="submit" class="form-control btn btn-success">Edit </button>


                    </form>



                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
  <?php
}
	include 'footer.php';
?>
