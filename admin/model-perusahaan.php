<?php
    include 'header.php';
    $_SESSION['art_username'] = 'admin';
    
    $id = $_GET['id'];
    $query = mysql_query("select * from architect_perusahaan where architect_perusahaan_id='$id'");
    $data = mysql_fetch_array($query);
    $rows = mysql_num_rows($query);
	
	$_SESSION['perusahaan_nama'] = $data['architect_perusahaan_nama'];


//query data first untuk ngambil model EAnya yang udah dimodelin
 $queryDataFirst = mysql_query("SELECT * FROM `link` WHERE id_perusahaan='$id' group by id_architecture, type_architecture");
$cekModelEa = mysql_num_rows($queryDataFirst);
if($cekModelEa>0)
{
	
                                          while ($dataFirst = mysql_fetch_array($queryDataFirst)) {
                                          	if($dataFirst['type_architecture']=="diagram"){
                                          		$queryModel  = mysql_query("select * from togaf_diagram join togaf_model_diagram using(id_diagram) join togaf_model on (togaf_model.id_togaf=togaf_model_diagram.id_model) where id_diagram='".$dataFirst['id_architecture']."' group by id_model");
	                                          	$dataModelQuery = mysql_fetch_array($queryModel);
	                                          	$dataModels[] = $dataModelQuery['id_togaf'];

                                          	}else{
												$queryModel  = mysql_query("select * from togaf_matriks join togaf_model_matriks using(id_matriks) join togaf_model on (togaf_model.id_togaf=togaf_model_matriks.id_model) where id_matriks='".$dataFirst['id_architecture']."' group by id_model");
	                                          	$dataModelQuery = mysql_fetch_array($queryModel);
	                                          	$dataModels[] = $dataModelQuery['id_togaf'];

                                          	}
                                          	
                                          }
										  
										  
  
//array_unique untuk supaya ga ada model yg redundan atau lebih dari satu								
$dataModels = array_unique($dataModels);
//kalo datamodels yg belum berurutan kalo data model yang udah berurutan
end($dataModels);
$lastKey = key($dataModels);
// print_r($dataModels);

                                          $dataModels = array_unique($dataModels);
                                          //TAMBAH PRELIMINARY 
										  $indexs=1;
										  for ($i=0; $i <= $lastKey; $i++) { 
                                            if(isset($dataModels[$i])){ 		//diperbaiki dgn ditambah isset
												if($dataModels[$i]!=""){
												$dataModel[] = $dataModels[$i];
												// TAMBAH PRELIMINARY 
												$dataModel[$indexs] = $dataModels[$i];
												// TAMBAH PRELIMINARY 
												$indexs++;
                                            }
										}
											
											
                                          }

}	
// TAMBAH PRELIMINARY 
$dataModel[0]=1;
// print_r($dataModel);
?>
    <style type="text/css">
    .table-user tr th,.table-user tr td{
        text-align: center;
    }
    #table-box{
        width:100%;
        overflow-x:auto;
    }
    table tr td{
    	text-transform: capitalize;
    }
    ul li{
    	list-style: none;
    	text-align: left;
    	text-transform: capitalize;
    }
    </style>

    <div id="wrapper">

    <?php
    include 'nav.php';
    ?>
      <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Model Perusahaan <?php echo $data['architect_perusahaan_nama'] ?></h1>
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
                                            <th>No</th>
                                            <th>Model EA</th>
											<th>Katalog</th>
                                            <th>Matriks</th>
                                            <th>Diagram</th>
                                            
                                        </tr>
                                        <?php
                                        $no=1;
                                        $i=0;
                                         while ($i < count($dataModel)) {
                                     


                                         $queryDataData = mysql_query("select * from togaf_model where id_togaf='".$dataModel[$i]."'");

                                        $dataData=mysql_fetch_array($queryDataData);
                                        ?>
                                         <tr>
                                            <td><?php echo $no; ?></td>     
                                            <td><?php
                                            echo $dataData['nama_togaf'] ?></td>     
                                            <td>
                                                <ul>
                                                    <?php
										 if($dataData['id_togaf']==1){
											 
                                                    $queryKatalogVisi = mysql_query("select * from visi where id_perusahaan='".$id."'");
													if (mysql_num_rows($queryKatalogVisi) > 0) {
                                                        ?>
                                                        <li>
                                                        <a  target="_blank" href="../formvisi.php?idper=<?php
															echo $id;
															?>">
															 Visi
														</a>
                                                        </li>
                                                        <?php
                                                    }
													
													   $queryKatalogMisi = mysql_query("select * from misi where id_perusahaan='".$id."'");
													if (mysql_num_rows($queryKatalogMisi) > 0) {
                                                        ?>
                                                        <li>
                                                        <a  target="_blank" href="../formmisi.php?idper=<?php
															echo $id;
															?>">
															 Misi
														</a>
                                                        </li>
                                                        <?php
                                                    }
										 }

													//katalog
                                                    $queryKatalog = mysql_query("select * from togaf_katalog join togaf_model_katalog using(id_katalog) join form using(id_katalog) where id_perusahaan='".$id."' and id_model='".$dataData['id_togaf']."' group by id_katalog order by id_model_katalog");
                                                    while ($dataKatalog=mysql_fetch_array($queryKatalog)) {
                                                        ?>
                                                        <li>
                                                        <a  target="_blank" href="../daftarform_admin.php?id=<?php echo $dataKatalog['id_katalog']; ?>&idper=<?php
                                            echo $id;
                                            ?>">
                                             <?php echo $dataKatalog['nama_katalog']; ?>
                                        </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                    </td>    



                                   <td>
								   <?php if($dataData['id_togaf']==1){
									   echo "-";
								   }
								   ?>
                                                <ul>
												

                                                <?php
                                        //matriks        
                                             $queryMatriks = mysql_query("select * from link join togaf_matriks on(togaf_matriks.id_matriks=link.id_architecture) join togaf_model_matriks using(id_matriks) where id_model='".$dataData['id_togaf']."' and type_architecture='matriks' and id_perusahaan='".$id."' group by nama_matriks order by id_model_matriks");
                                        
                                        while($dataMatriks=mysql_fetch_array($queryMatriks)){
                                        ?>
                                        <li>
                                            <a  target="_blank" href="../matriks_detail.php?id=<?php echo $dataMatriks['id_matriks'] ?>&idper=<?php
                                            echo $id;
                                            ?>">
                                            <?php echo $dataMatriks['nama_matriks']; echo " matriks" ?>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        if($dataData['id_togaf']==2){

                                            $queryMatriksStack =mysql_query("select * from form join togaf_katalog using(id_katalog) where id_perusahaan='$id' and id_katalog='14' group by id_katalog");
                                            while ( mysql_fetch_array($queryMatriksStack)) {

                                            ?>
                                            <li>
                                                <a  target="_blank" href="../matriks_detail.php?id=1&idper=<?php
                                                echo $id;
                                                ?>">
                                                <?php echo "stakeholder map matriks";  ?>
                                                </a>
                                            </li>
                                            <?php
                                            }
                                        }
                                            ?>
                                        </ul>
                                    </td>     
                                   
                                           <td>
										   <?php if($dataData['id_togaf']==1){
									   echo "-";
								   }
								   ?>
                                            	<ul>

                                            	<?php 
                                           //diagram 	
                                             $queryDiagram = mysql_query("select * from link join togaf_diagram on(togaf_diagram.id_diagram=link.id_architecture) join togaf_model_diagram using(id_diagram) where id_model='".$dataData['id_togaf']."' and type_architecture='diagram' and id_perusahaan='".$id."' group by nama_diagram order by id_model_diagram");
                                        
                                        while($dataDiagram=mysql_fetch_array($queryDiagram)){
										?>
										<li>
											<a target="_blank" href="../diagram_detail_admin.php?id=<?php echo $dataDiagram['id_diagram'] ?>&idper=<?php
											echo $id;
											?>">
											<?php echo $dataDiagram['nama_diagram']; echo " Diagram"?>
											</a>
										</li>
										<?php
										}
										
                                            ?>
                                        </ul>
                                            </td>         
                                         </tr>
                                        <?php
                                        $no++;
                                        	
                                        $i++;
                                         }
                                        ?>
                                </table>
                    </div>
                    <?php
}else{
    ?>
<p>-</p>
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

