<?php
    include 'header.php';
    $id = $_GET['id'];
    $query = mysql_query("select * from architect join architect_perusahaan using(architect_id) where architect_id='$id'");
    
    $rows = mysql_num_rows($query);

?>
    <style type="text/css">
    .table-user tr th,.table-user tr td{
        text-align: center;
    }
    #table-box{
        width:100%;
        overflow-x:auto;
    }
    </style>

    <div id="wrapper">

    <?php
    include 'nav.php';
    ?>
      <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Daftar Perusahaan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                <?php
if($rows>0){
                ?>
                        <div id="table-box">
                      <table class="table table-bordered table-hover table-striped table-user" id="dataTables-example">
                                       
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Provinsi</th>
                                            <th>No. Hp</th>
                                            <th>Fax</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                        <?php
                                        while($data=mysql_fetch_array($query)){
                                            $queryCekModel = mysql_query("select * from link where id_perusahaan='".$data['architect_perusahaan_id']."'");
                                            $cek = mysql_num_rows($queryCekModel);
                                            $queryCek2Model = mysql_query("select * from form where id_perusahaan='".$data['architect_perusahaan_id']."'");
                                            $cek2 = mysql_num_rows($queryCek2Model);
                                        ?>
                                         <tr>
                                            <td><?php echo $data['architect_perusahaan_nama'] ?></td>     
                                            <td><?php echo $data['architect_perusahaan_email'] ?></td>     
                                            <td><?php echo $data['architect_perusahaan_alamat'] ?></td>     
                                            <td><?php echo $data['architect_perusahaan_kota'] ?></td>     
                                            <td><?php echo $data['architect_perusahaan_provinsi'] ?></td>     
                                            <td><?php echo $data['architect_perusahaan_nohp'] ?></td>         
                                            <td><?php echo $data['architect_perusahaan_fax'] ?></td>         
                                               
                                            <td>
                                            <?php
                                            if($data['architect_perusahaan_status']==0){
                                             ?>
                                            <a href="architect-perusahaan-approve.php?id_arc=<?php echo $id;?>&id=<?php echo $data['architect_perusahaan_id']; ?>" class="btn btn-success">Approve</a> 
                                             <?php   
                                            }else{
                                                ?>
                                            <a href="architect-perusahaan-cancel.php?id_arc=<?php echo $id;?>&id=<?php echo $data['architect_perusahaan_id']; ?>" class="btn btn-danger">Cancel</a> 
                                                <?php
                                            }

                                            if(($cek>0 || $cek2>0) and $data['architect_perusahaan_status']==1){

												?>

											<br/>
											<br/>
											<a href="model-perusahaan.php?id=<?php echo $data['architect_perusahaan_id']; ?>" class="btn btn-info">Lihat Hasil Model</a>
												<?php
											}else{
												?>
												
												<?php
											}
											?>
                                            </td>         
                                         </tr>
                                        <?php
                                        }
                                        ?>
                                </table>
                    </div>
                    <?php
}else{
    ?>
<p>User Ini Belum Memiliki Perusahaan</p>
    <?php
}
                    ?>
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

