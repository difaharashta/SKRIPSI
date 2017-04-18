<?php
    include 'header.php';

    $query = mysql_query("select * from architect");
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
                    <h1 class="page-header">Daftar Arsitek</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                        
                        <div id="table-box">
                      <table class="table table-bordered table-hover table-striped table-user" id="dataTables-example">
                                       
                                        <tr>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Provinsi</th>
                                            <th>No. Hp</th>
                                            <th>Perusahaan</th>
                                            <th>Approve</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                        <?php
                                        while($data=mysql_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td><?php echo $data['architect_nama'] ?></td>     
                                            <td><?php echo $data['architect_username'] ?></td>     
                                            <td><?php echo $data['architect_password'] ?></td>     
                                            <td><?php echo $data['architect_email'] ?></td>     
                                            <td><?php echo $data['architect_alamat'] ?></td>     
                                            <td><?php echo $data['architect_kota'] ?></td>     
                                            <td><?php echo $data['architect_provinsi'] ?></td>     
                                            <td><?php echo $data['architect_nohp'] ?></td>         
                                            <td>
                                            <a href="architect-perusahaan.php?id=<?php echo $data['architect_id']; ?>">Detail</a>
                                            </td>         
                                            <td>
                                            <?php
                                            if($data['architect_status']==0){
                                             ?>
                                            <a href="architect-approve.php?id=<?php echo $data['architect_id']; ?>" class="btn btn-success">Approve

                                            </a> 
                                             <?php   
                                            }else{
                                                ?>
                                            <a href="architect-cancel.php?id=<?php echo $data['architect_id']; ?>" class="btn btn-danger">Cancel</a> 
                                                <?php
                                            }
                                            ?>

                                            </td>         
                                            <td>
                                                
											<a href="architect-delete.php?id=<?php echo $data['architect_id']; ?>">Delete</a> </td>         
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                </table>
                    </div>
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

