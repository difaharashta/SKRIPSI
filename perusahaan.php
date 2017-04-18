<?php
	include 'header.php';
?>

    <div id="wrapper">

    <?php
	include 'nav.php';
	?>
      <div id="page-wrapper">
            <div class="row box perusahaan">
                <h2>
                    Daftar Perusahaan Anda
                </h2>
                <hr/>
                <form method="POST" action="perusahaan-pilih.php">
                <?php
                $query = "select * from architect join architect_perusahaan using(architect_id) where architect_username='".$_SESSION['art_username']."'";
                $exe = mysql_query($query);
                if(mysql_num_rows($exe)>0){
                    ?>
                    <div style="text-align:right;margin-top:30px;margin-bottom:10px;">
                        <a href="perusahaan-add.php" class="btn btn-success">Tambah Perusahaan</a>
                    </div>
                    <table class="table">
                        <tr>
                            <td>No</td>
                            <td>Nama Perusahaan</td>
                            <td>Status</td>
                            <td>Pilih</td>
							<td>Action</td>
                        </tr>
                        <?php
                        $no=1;
                       while ( $data = mysql_fetch_array($exe)) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td>
                                <?php echo $data['architect_perusahaan_nama']; ?>
                            </td>
                            <td>
                                <?php if($data['architect_perusahaan_status']==0){
                                    echo "<span style='color:red'>Belum di Approve</span>";
                                } else{
                                    echo "<span style='color:green'>Sudah di Approve</span>";
                                }?>
                            </td>
                            <td><input type="radio"  class="pilih-per" required <?php if($data['architect_perusahaan_status']==0){ echo "disabled"; } ?> value="<?php echo $data['architect_perusahaan_id'] ?>" name="pilih"></td>
							<td>
							<a href="perusahaan-edit.php?id=<?php echo $data['architect_perusahaan_id']; ?>">Edit</a> <br>

							<a href="perusahaan-delete.php?id=<?php echo $data['architect_perusahaan_id']; ?>">Delete</a> </td>
                        </tr>
                        <?php
                        $no++;
                        }


                        ?>
                    </table>
                    <?php
                }else{
                    echo "<p style='margin:20px;text-align:center'>Anda belum membuat perusahaan silahkan <a href='perusahaan-add.php'>Create Perusahaan</a></p>";
                }

                ?>
                <input type="submit" disabled class="pilih-submit btn btn-success" value="Pilih" style="width:100%">
                </form>
            </div>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
	include 'footer.php';
?>
<script type="text/javascript">
$(document).ready(function(){
    $('.pilih-per').click(function(){
        $('.pilih-submit').removeAttr('disabled');
    });


});
</script>
