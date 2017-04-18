<?php
	include 'header.php';
     $id = $_SESSION['art_id'];
    $query = mysql_query("select * from architect where architect_id='$id'");
    $data = mysql_fetch_array($query);
    
     $id_perusahaan = $_SESSION['perusahaan_id'];
    $queryPerusahaan = mysql_query("select * from architect_perusahaan where architect_perusahaan_id='$id_perusahaan'");
    $dataPerusahaan = mysql_fetch_array($queryPerusahaan);

	$provinsi =  array("Aceh", "Sumatera Utara", "Sumatera Barat", "Riau", "Jambi", "Sumatera Selatan", "Lampung", "Bengkulu", "Bangka Belitung", "Kepulauan Riau", "Jakarta", "Jawa Barat", "Jawa Tengah", "Yogyakarta", "Jawa Timur", "Banten", "Bali", "Nusa Tenggara Barat", "Nusa Tenggara Timur", "Kalimantan Barat", "Kalimantan Timur", "Kalimantan Tengah", "Kalimantan Selatan", "Sulawesi Utara", "Sulawesi Tengah", "Sulawesi Selatan", "Sulawesi Tenggara", "Gorontalo", "Sulawesi Barat", "Maluku", "Maluku Utara", "Papua", "Papua Barat");

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
                        Profile
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <div class="box-profile">
                        <?php
                       if($_GET['edit']=='art'){
                            ?>
                                                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Data <b>Arsitek</b> Berhasil Diperbaharui 
                            </div>

                            <?php
                        }
                        
                       
                        ?>
                      <div class="panel panel-default">
                        <div class="panel-heading ">
                            Informasi Kontak Personal
                        </div>
                        <div class="panel-body">
                              <form role="form" method="post" action="architect-update.php">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="hidden" name="id" value="<?php echo $data['architect_id']; ?>"/>
                                            <input required class="form-control" value="<?php echo $data['architect_nama']; ?>" type="text" name="nama" placeholder="Masukkan Nama"/>
                                        </div>
                                       <div class="form-group">
                                            <label>Username</label>
											
                                            <input required class="form-control" value="<?php echo $data['architect_username']; ?>" type="text" name="username" placeholder="Masukkan Username"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" value="" type="password" name="password" placeholder="Masukkan Password"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Email</label>
                                            <input  required class="form-control" value="<?php echo $data['architect_email']; ?>" type="email" name="email" placeholder="Masukkan Email"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea required class="form-control" name="alamat" placeholder="Masukkan Alamat Lengkap"><?php echo $data['architect_alamat']; ?></textarea>
                                        </div>
                                      <div class="form-group">
                                            <label>Provinsi</label>
											 
                                            <select required class="form-control" name="provinsi">
                                            <?php
											for($i=0;$i<count($provinsi);$i++){
												?>
												<option <?php 
												if($provinsi[$i]==$data['architect_provinsi']){
													echo "selected";
												}
												?>
												value="<?php
												echo $provinsi[$i]; ?>"><?php echo $provinsi[$i]; ?></option>
												<?php
											}
											?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kota</label>
									        <input required class="form-control" value="<?php echo $data['architect_kota']; ?>"  type="text" name="kota" placeholder="Masukkan Kota Asal"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon/Hp</label>
									        <input required class="form-control" value="<?php echo $data['architect_nohp']; ?>"  type="number" name="hp" placeholder="Masukkan Nomor Telepon/Handphone"/>
                                        </div>
                                        <button type="submit" class="form-control btn btn-success">Update Profile </button>
                                        
                                    </form>
                        </div>
                    </div>


                    </div>
                </div>
            </div>
			<a  href="index.php" class="btn btn-danger back">Kembali</a>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
	include 'footer.php';
?>

