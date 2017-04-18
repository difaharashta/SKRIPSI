<?php
  include 'header.php';
  $idjabatan = $_GET['id']; 
  $query = "select * from form where id_katalog='5' and id_form='$idjabatan'";
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
                        EDITOR FORM <?php echo strtoupper($dataTogaf['nama']);?> PEOPLE
                    </h3>
                    <hr style="margin:0px;padding:10px;"/>
                    <p style="margin:10px;text-align:right">
                      <a href="people-add.php?id=<?php echo $idjabatan; ?>" class="btn btn-success">Add</a>
                     
                    </p>

                    <table class="table table-striped">
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          NoInduk
                        </th>
                        <th>
                          Nama 
                        </th>
           <th>
                          Email 
                        </th>
           <th>
                          Alamat
                        </th>
           <th>
                          Telepon
                        </th>
                        <th>
                          Edit
                        </th>
                        <th>
                          Delete
                        </th>
                      


                      </tr>
                      <?php
                      $no=1;
                      $idarc = $_SESSION['art_id'];
                      $query = mysql_query("select * from people where id_jabatan='".$idjabatan."'");
   while($data=mysql_fetch_array($query)){
                                       
    ?>

    <tr>
      <td>
        <?php echo $no; ?>
      </td>
      <td>
        <?php echo $data['noinduk']; ?>
      </td>
    <td>
        <?php echo $data['nama']; ?>
      </td>
    <td>
        <?php echo $data['email']; ?>
      </td>
    <td>
        <?php echo $data['alamat']; ?>
      </td>
   
    <td>
        <?php echo $data['notelp']; ?>
      </td>
	 
      <td>
        <a href="people-edit.php?idj=<?php echo $idjabatan; ?>&id=<?php echo $data['id_people']; ?>">Edit</a> 
      </td>
      <td>
        <a href="people-delete.php?idj=<?php echo $idjabatan; ?>&id=<?php echo $data['id_people']; ?>">Delete</a>
      </td>


    </tr>
    <?php
    $no++;
}
    ?>
                    </table>
    

<a href="model.php" class="btn btn-danger back">Kembali</a>

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

