<?php
	include 'header.php';
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
                        View Tracebility
                    </h3>
					<hr style="margin:0px;padding:10px;"/>
					
                    <div class="row">
                       <?php
                       $query = "select * from togaf_model where id_togaf";
                       $result = mysql_query($query);
                       while ($data=mysql_fetch_array($result)) {
                           ?>
                            <div class="col-md-2">
                                <a style="width:100%;" href="#" class="katalogclick btn btn-primary">

                                    <?php echo ucwords(strtolower($data['nama_togaf'])); ?></a>
									
									
									
									
				<?php
				// if($data['id_togaf']==1){
                       $querys = "select * from togaf_model_katalog join togaf_katalog using(id_katalog) where id_model='".$data['id_togaf']."'";
                       $results = mysql_query($querys);
                       if(mysql_num_rows($results)>0){
                    ?>
					<div class="childkatalog">
                      <h4>
                        Katalog
                      </h4>
					  <ul>
                       <?php
                       while ($datas=mysql_fetch_array($results)) {
                           ?>
                            <li  class="btn-primary">
                                <a href="<?php 
                                if($datas['nama_katalog']=='visi' || $datas['nama_katalog']=='misi' ){

                                echo  "form".$datas['nama_katalog']; 
								
								
                                }else{
                                echo "form";

                                }
                                 ?>.php?id=<?php echo $datas['id_katalog']; ?>&tracebility=1">

                                  Form  <?php echo ucwords(strtolower($datas['nama_katalog'])); ?></a>
                            </li>
                           <?php
                       }
                       ?>
					   </ul>
					</div>
                    <?php
                    }
                  // }
?>
                           
	 <?php
                       $querym = "select * from togaf_model_matriks join togaf_matriks using(id_matriks) where id_model='".$data['id_togaf']."'";
                       $resultm = mysql_query($querym);
                       if(mysql_num_rows($resultm)>0){
                    ?>
					<div class="childkatalog">
                      <h4>
                        Matriks
                      </h4>
					  <ul>
                       <?php
                       while ($datam=mysql_fetch_array($resultm)) {
                           ?>
                            <li class=" btn-primary">
                                <a href="matriks_detail.php?id=<?php echo $datam['id_matriks']; ?>" >

                                  <?php echo ucwords(strtolower($datam['nama_matriks'])); ?> Matriks</a> 
                            </li>
                        
						<?php
                       }
                       ?>
					  </ul>
					   </div>
                    <?php
                    }
                    ?>


					
					<?php
                       $queryd = "select * from togaf_model_diagram join togaf_diagram using(id_diagram) where id_model='".$data['id_togaf']."'";
                       $resultd = mysql_query($queryd);
                       if(mysql_num_rows($resultd)>0){
                    ?>
                    <div class="childkatalog">
                      <h4>
                      Diagram
                      </h4>
					  <ul>
                       <?php
                       while ($datad=mysql_fetch_array($resultd)) {
                           ?>
                            <li class="btn-primary">
                                <a href="diagram_detail.php?id=<?php echo $datad['id_diagram']; ?>" >
                                  <?php echo ucwords(strtolower($datad['nama_diagram'])); ?> Diagram</a> 
                            </li>
                           <?php
                       }
                       ?>
					  </ul>

                    </div>
                    <?php
                    }
                    ?>


						   </div>
                           <?php
                       }
                       ?>
                    </div>
				</div>	
			</div>	
				<div style="text-align:left ; margin-top:100px;">
				<a href="exporttoxmlall.php" class="btn btn-success back">Export To XML</a>
				<a href="index.php" class="btn btn-danger back">Kembali</a>
				</div>
		</div>		
		
	<?php
	include 'footer.php';
?>
