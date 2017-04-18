<?php
  include 'header.php';
  $formid = $_GET['formid'];
  $idarc = $_GET['idarc'];
  $type = $_GET['type'];
  
  //untuk langsung buat value chain diagram
  if($type=="diagram" && $idarc=="1"){
    header("location:linkmapping.php?idkatalog=6&formid=".$formid."&idarc=1&type=diagram");
  }

  $query = "select * from togaf_katalog where nama_katalog!='visi' and nama_katalog!='misi'";
  $datas = mysql_query($query);
?>

    <div id="wrapper">

    <?php
  include 'nav.php';
  ?>

      <div id="page-wrapper">
        <p style="text-align:center;margin:10px;font-size:25px;">
          LINK KE FORM
        </p>   
        <ul id="linkke">
          <?php
          while ($data=mysql_fetch_array($datas)) {
            ?>
            <li>
                 <a href="linkmapping.php?idkatalog=<?php echo $data['id_katalog'] ?>&formid=<?php echo $formid; ?>&idarc=<?php echo $idarc; ?>&type=<?php echo $type; ?>">
                <?php echo $data['nama_katalog']; ?>
              </a>
            </li>
            <?php
          }

          ?>
        </ul>
      </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
  include 'footer.php';
?>

