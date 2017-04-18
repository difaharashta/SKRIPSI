<?php
  include 'header.php';
  $id = $_GET['id'];
  $query = "select * from togaf_katalog where id_katalog='$id'";
  $dataTogaf = mysql_fetch_array(mysql_query($query));
  if($id!=14){

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
                        ADD <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="form-insert.php" method="post">
						
						
                        <div class="form-group">
                            <label> 						  <?php if($id!=4){
							  
						  echo "Nama "; 
						  }
							echo ucwords($dataTogaf['nama_katalog']); ?></label>
                            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                            <textarea type="text" class="form-control" name="nama"></textarea>
                        </div>
						
						<?php 
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12 && $dataTogaf['id_katalog']!=1 && $dataTogaf['id_katalog']!=13){
							
							?>
                        <div class="form-group">
                            <label> Deskripsi  <?php echo ucwords($dataTogaf['nama_katalog']); ?></label>
                            <textarea class="form-control" name="deskripsi"></textarea>
                        </div>
						<?php
						}
						if($dataTogaf['id_katalog']!=7 && $dataTogaf['id_katalog']!=4 && $dataTogaf['id_katalog']!=11 && $dataTogaf['id_katalog']!=12){
						?>
                        <div class="form-group">
                            <label>Parent </label>
                            <select name="parent" class="form-control">
                                <option value="-">-</option>
                                <option value="Root">Root</option>
                                 <?php
                                    $idperusahaan = $_SESSION['perusahaan_id'];
                                    $query = mysql_query("select * from form where id_katalog='$id' and id_perusahaan='$idperusahaan'");
                                    while($data=mysql_fetch_array($query)){
                                ?>
                                <option value="<?php echo $data['nama'] ?>"><?php echo $data['nama']; ?></option>

                                <?php  
                                }                      
                                ?>

                            </select>
                            
                        </div>
                       <?php
						}
					   ?>

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



}
//batas stackholder
else

{

    ?>

      <div id="page-wrapper">
            <p style="font-size:12px;text-align:right;margin-top:10px;font-style:italic">
                Anda Sedang Menggunakan Perusahaan <?php
                echo "<b>".$_SESSION['perusahaan_nama']."</b>"; ?>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin:0px;margni-top:25px;text-align:center;">
                        ADD <?php echo strtoupper($dataTogaf['nama_katalog']); ?>
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <form action="form-insert.php" method="post">
                        <div class="form-group">
                            <label> Nama <?php echo ucwords($dataTogaf['nama_katalog']); ?></label>
                            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                            <input required type="text" class="form-control" name="nama"/>
                        </div>
                        
                        
                         <div class="form-group">
                            <label>Parent Jabatan</label>
                            <select name="parent" class="form-control">
                                <option value="-">-</option>
                                <option value="Root">Root</option>
                                 <?php
                                    $idperusahaan = $_SESSION['perusahaan_id'];
                                    $query = mysql_query("select * from form where id_katalog='$id' and id_perusahaan='$idperusahaan'");
                                    while($data=mysql_fetch_array($query)){
                                ?>
                                <option value="<?php echo $data['nama'] ?>"><?php echo $data['nama']; ?></option>

                                <?php  
                                }                      
                                ?>

                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label> Class </label>
                            <select class="form-control" name="class">
                                <option value="Keep Satisfied">Keep Satisfied</option>
                                <option value="Keep Informed">Keep Informed</option>
								<option value="Key Players">Key Players</option>
								<option value="	">Minimal Efford</option>
                                
                            </select>
                        </div>
<div class="form-group">
                            <label> Status </label>
                            <select class="form-control" name="status">
                                <option value="external">Eksternal</option>
                                <option value="internal">Internal</option>
                            </select>
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
}
    ?>

<?php
	include 'footer.php';
?>

