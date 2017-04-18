<?php
  include 'header.php';
  //ini ngambil id form dari
  $id = $_GET['formid'];
  
  //ini id_togaf!=1 karna preliminary ga dimunculin
  $query = mysql_query("select * from togaf_model where id_togaf!=1");
?>

    <div id="wrapper">

    <?php
  include 'nav.php';
  ?>

      <div id="page-wrapper">
        
        <ul id="link">
          <?php
          while ($data=mysql_fetch_array($query)) {
            ?>
            <li class="parent">
              <p class="main">
                <?php echo ucwords($data['nama_togaf']); ?>
              </p>
              <ul>
                <?php
                $queryMatr = mysql_query("select * from togaf_model_matriks join togaf_matriks using(id_matriks) where id_model='".$data['id_togaf']."' and id_matriks!=1");
                while ($dataMatr=mysql_fetch_array($queryMatr)) {
                   ?>
                   <li class="child">
                    <p>
                      <a href="linkke.php?idarc=<?php echo $dataMatr['id_matriks']; ?>&formid=<?php echo $id; ?>&type=matriks">
                       <?php echo $dataMatr['nama_matriks'];
							echo " Matriks"; 
					   ?>
                      </a>
                    </p>
                   </li>
                   <?php
                 }
                $queryDiagram = mysql_query("select * from togaf_model_diagram join togaf_diagram using(id_diagram) where id_model='".$data['id_togaf']."'");
                while ($dataDiagram=mysql_fetch_array($queryDiagram)) {
                   ?>
                   <li class="child">
                    <p>
					<!-- -->
                      <a href="linkke.php?idarc=<?php echo $dataDiagram['id_diagram']; ?>&formid=<?php echo $id; ?>&type=diagram">
                    <?php echo $dataDiagram['nama_diagram']; 
						echo " Diagram";
					?>
                  </a>
                    </p>
                   </li>
                   <?php
                 } 
                ?>
              </ul>
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

