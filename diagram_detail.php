<?php

include 'header.php';

?>
<div id="modalLink" class="modal">
	<div class="modal-content" id="show">
		<span class="close">&times;</span>
	</div>
</div>



<?php





$id = $_GET['id'];

//setiap ada hasil 'koordinat' dari $_POST maka 'koordinat' tersebut di decode ke dalam variable $koordinat
// lalu $koordinat dijadikan sebagai variable $key yang berisi idForm
//variable $value berisi x dan y berupa koordinat yang tadi sudah didapatkan dari getBBox
if (isset($_POST['koordinat'])) {
	$koordinat = json_decode($_POST['koordinat']);
	foreach ($koordinat as $key => $value) {
		mysql_query("UPDATE `diagrams` SET `x`='".$value->x."', `y`='".$value->y."' WHERE `id_form` = '$key' AND `id_diagram`='$id';");
	}
}


//buat nama diagram
$query = "select * from togaf_diagram where id_diagram='$id'";
$dataDiagram = mysql_fetch_array(mysql_query($query));

//inisialisasi array ke 0 buat ngecek kalo isi form ga lebih dari 1
$dataParent[0] = "";


//untuk ngebedain kalo get itu untuk yang ngebuka si admin
// echo $_SESSION['idper'];
// var_dump(isset($_GET['idper']));

// if($_GET['idper']!=""){
// 		$idperusahaan = $_GET['idper'];
//
// }else{
// 	$idperusahaan = $_SESSION['perusahaan_id'];
//
// }

if(isset($_GET['idper'])){
	if($_GET['idper']!=""){
		$idperusahaan = $_GET['idper'];
	}else{
		$idperusahaan = $_SESSION['perusahaan_id'];
	}
}else{
	$idperusahaan = $_SESSION['perusahaan_id'];
}

$query = mysql_query("
SELECT * FROM `LINK`
WHERE type_architecture='diagram' and
id_architecture='$id' and
id_perusahaan='$idperusahaan'");

//fetching data id form nya
// lalu $dataParent diisi dengan 'form dari' atau 'form_ke'
while($data=mysql_fetch_array($query)){
	if(!in_array($data['form_dari'],$dataParent)){
		$dataParent[] = $data['form_dari'];
	}

	if(!in_array($data['form_ke'],$dataParent)){
		$dataParent[] = $data['form_ke'];
	}
}

//hapus array ke 0 karna ga di pake
unset($dataParent[0]);

//mengambil nama dan deskripsi dari form yang udah diambil sblmnya berdasarkan id
for ($i=1; $i <= count($dataParent); $i++) {
	$queryForm = mysql_query("SELECT * FROM `form`  WHERE id_form='$dataParent[$i]'");
	$dataForm=mysql_fetch_array($queryForm);
	//$dataParentDiagram[] =$dataForm['nama']." (".$dataForm['deskripsi'].")";
	// $dataParentDiagram[] =$dataForm['nama'];
	// $dataParentDiagram[] =$dataForm['nama']." \\n\\r(".str_replace("<br>","\\n\\r",$dataForm['deskripsi']).")";

	//  if($i ==1){
	// 	 var_dump($dataParentDiagram);
	//  }
	//  if($dataForm['deskripsi']){
	//  %% diganti jadi enter(\\n\\r )
	$dataParentDiagram[] =str_replace("%%","\\n\\r",$dataForm['nama'])." \\n\\r(".str_replace("%%","\\n\\r",$dataForm['deskripsi']).")";
	//  }else{
	//  $dataParentDiagram[] =str_replace("%%","\\n\\r",$dataForm['nama']);
	//  }
	//atribut tambahan
	//id_form dan id_katalog untuk mengacu pada id_form & id_katalog icon yang di click
	$dataIDForm[] = $dataForm['id_form'];
	$dataIDKatalog[] = $dataForm['id_katalog'];

}
// print_r($dataParentDiagram);

?>

<div id="wrapper">

	<?php
	include 'nav.php';
	?>

	<div id="page-wrapper">
		<p style="font-size:12px;text-align:right;margin-top:10px;font-style:italic">
			Anda Sedang Menggunakan Perusahaan

			<?php
			echo "<b>".$_SESSION['perusahaan_nama']."</b>";
			?>
		</p>
		<div class="row">
			<div class="col-md-12">
				<h3 style="margin:0px;margin-top:25px;text-align:center;">
					<?php
					//tampilkan nama diagram
					echo strtoupper($dataDiagram['nama_diagram']);
					?> DIAGRAM
				</h3>
				<hr style="margin:0px;padding:10px;"/>
				<div style="text-align:right">
					<!-- <a href="exporttoxml.php?type=diagram&id=<?php echo $id; ?>" class="btn btn-success">Export to XML</a> -->
				</div>
				<div id="keterangan">
					<p>Keterangan</p>

					<table>
						<tr>
							<?php
							$queryCekKatalogs = mysql_query("select * from togaf_katalog where nama_katalog!='visi' and nama_katalog!='misi'");
							while($dataKatalogs = mysql_fetch_array($queryCekKatalogs)){

								?>
								<td>

									<img width="25px" src="images/icon/<?php echo $dataKatalogs['nama_katalog']; ?>.jpg"></a>
								</td>

								<td>


									<a href="form.php?id=
									<?php
									echo $dataKatalogs['id_katalog']; ?>"> <?php echo ucwords($dataKatalogs['nama_katalog']);
									?>
								</a>



							</td>


							<?php
						}
						?>
					</tr>
				</table>
			</div>
			<div id="diagramContainer">
				<div id="diagram" style="width:80%"></div>
			</div>

		</div>

	</div>

	<?php
	if(isset($_GET['idper']) && $_GET['idper']!=""){
		?>

		<a href="admin/model-perusahaan.php?id=<?php echo $_GET['idper'] ?>" class="btn btn-danger back">Kembali Ke Admin</a>
		<?php
	}

	else{

		?>

		<form method="POST">
			<input type="hidden" name="koordinat" id="koordinat" value="">

			<a  onclick="window.history.back(-1)" class="btn btn-danger back">Kembali</a>
			<button type="submit" class="btn btn-success back" name="Simpan Koordinat">
				Simpan Koordinat
			</button>
			<button type="button" class="btn btn-success back" name="Reset Koordinat" onclick="resetKoordinat()" >
				Reset Koordinat

			</button>
		</form>
		<?php
	}
	?>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


</body>

<!-- jQuery Version 1.11.0 -->
<script src="admin/js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="admin/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="admin/js/plugins/metisMenu/metisMenu.min.js"></script>
<!-- DataTables JavaScript -->
<script src="admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>

<script type="text/javascript" src="js/raphael-min.js"></script>
<script type="text/javascript" src="js/dracula_graffle.js"></script>
<script src="admin/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="js/dracula_graph.js"></script>
<script type="text/javascript" src="js/dracula_algorithm.js"></script>
<script type="text/javascript">


var redraw, g, renderer, resetKoordinat, isRootless=false;

/* only do all this when document has finished loading (needed for RaphaelJS) */
window.onload = function() {

	//menentukan lebar dan tinggi untuk tempat penggambaran graf
	var width = $(document).width() - 50;
	var height = $(document).height() - 60;

	//array berisi idForm dari tabel diagrams
	//melakuka method getBBox untuk mendapatkan koordinat terkini dari form
	var forms = {};

	//sets array berisi idForm dari tabel diagrams, bedanya sets digunakan untuk men-set koordinat
	var sets = {};

	//edges untuk melihat keterhubungan antar form
	var edges = {};
	var existUnmodified = false;
	g = new Graph();

	<?php

	for ($i=0; $i < count($dataParentDiagram); $i++) {
		//mengambil nama katalog gunanya untuk supaya tau mau pake icon yang mana
		$queryCekKatalog = mysql_query("select * from form join togaf_katalog using(id_katalog) where id_form='".$dataParent[$i+1]."'");
		$dataKatalog = mysql_fetch_array($queryCekKatalog);

		//perlu penjelasan
		$queryDiagram = mysql_query("select * from diagrams where id_form='".$dataParent[$i+1]."' AND `id_diagram`='$id'");
		$diagrams = mysql_fetch_array($queryDiagram);
		//jka x null atau tidak ada, maka x = 0
		//jika y null atau tidak ada, maka y=0
		if (!isset($diagrams['x']) || $diagrams['x']==null) {
			$diagrams['x'] = 0;
		}
		if (!isset($diagrams['y']) || $diagrams['y']==null) {
			$diagrams['y'] = 0;
		}

		//jika x dan y = 0, maka existUnmodified=true.
		if ($diagrams['x']==0 && $diagrams['y']==0) {
			?>
			existUnmodified = true;
			<?php
		}
		?>


		//setelah fetching array dari $queryCekKatalog(lalu FORM JOIN togaf_katalog) yang berisi id_katalog yang berasal dari array $dataParent[]
		//disamakan id_katalog nya, lalu ambil $dataKatalog['nama_katalog'] agar nama_katalog, disesuaikan dengan id_katalog nya, dan dengan file imagenya
		//contoh: nama_katalog=produksi kue, id_katalog=6, image proses memiliki id_katalog=6
		//cara buat iconnya disimpan di variable render
		var render= function(r, n) {
			console.log(r);
			console.log(n);

			var x =  <?php echo $diagrams['x']; ?>,
			y = <?php echo $diagrams['y']; ?>;

			//mengisi array forms dengan id_form yang berasal dari tabel diagrams
			//menamai 'x' dengan x, 'y' dengan y
			forms[<?php echo $diagrams['id_form'];?>]= {x:x, y:y};
			$("#koordinat").val(JSON.stringify(forms));


			//variable untuk mencocokan file images dengan nama katalog dari suatu diagram
			//x dan y berguna untuk menambahkan koordinat awal dengan koordinat yang akan di simpan
			var img = r.image("images/icon/<?php echo $dataKatalog['nama_katalog']; ?>.jpg", 0, 0, 30, 20);


			//dari raphael-min
			var txt = r.text(15, 45, n.label)
			.attr({"font-size":"11px","text-align":"center"})
			//setiap hover ke text, cursor akan berbentuk pointer
			.hover(function(){
				this.attr({"cursor":"pointer"})
			})
			//fungsi double click pada text(deskripsi) untuk melakukan edit form
			.dblclick(function(){
				window.location = "form-edit.php?id="+n.id_katalog+"&idform="+n.id_form+"&redir=<?php echo urlencode("diagram_detail.php?id=".$id); ?>";

			});

			//it just groups existing elements.
      //Sets act as pseudo elements — all methods available to an element can be used on a set
			//var st = paper.set();
      //st.push(
      //    paper.circle(10, 10, 5),
      //     paper.circle(30, 10, 5)
      // )
			//setelah function image dan text dirender
			//.set() function dari raphael
			var set = r.set().push(img).push(txt);
			//translate berguna untuk menggeser sebesar x,y
			// x dan y berasal dari atribut x dan y pada tabel diagrams
			//getBBox untuk mendapatkan informasi koordinat nodenya
			//getBBox: create the BOX  that contains that shape(disini shape nya itu set)
			//dapatkan semua yang informasi xml yang ada di box. right corner, height, width
			//getBBox berguna untuk tau ada dimana suatu objek. Ketika akan menggerakkan element, kita tahu harus kemana pindahnya
			//

			//transform:
			//rotate, scale, translate(move)
			//element.rotate(45), element.scale(0.6), translate(50,100)


			set.translate(x-set.getBBox().x,y-set.getBBox().y);
			sets[<?php echo $diagrams['id_form'];?>]= set;

			//setiap img ikon yang diklik, akan mengembalikan koordinatnya dengan memanfaatkan method getBBox
			img.click(function(){
				forms[<?php echo $diagrams['id_form']; ?>].x = set.getBBox().x;
				forms[<?php echo $diagrams['id_form']; ?>].y = set.getBBox().y;
				$("#koordinat").val(JSON.stringify(forms));
			});

			//setiap text(deskripsi ikon) yang diklik, akan mengembalikan koordinatnya dengan memanfaatkan method getBBox
			txt.click(function(){
				forms[<?php echo $diagrams['id_form']; ?>].x = set.getBBox().x;
				forms[<?php echo $diagrams['id_form']; ?>].y = set.getBBox().y;
				$("#koordinat").val(JSON.stringify(forms));
			});

console.log("box:", set);
			return set;

		};

		//add tampilan icon dan nama
		//panggil var render yang berisi fungsi rendering gambar dan teks
		//label: berisi nama dan deskripsi
		//addNode(id,content) berisi 2 parameter
		// (optional, dictionary) can contain any information that is
		//being interpreted by the layout algorithm or the graph representation
		//id: dataParentDiagram[i], content: render,label,id_form,id_katalog
		g.addNode("<?php echo  $dataParentDiagram[$i]  ?>",
		{
			render : render,
			label : "<?php echo str_replace('()','',$dataParentDiagram[$i]) ?>",
			id_form : "<?php echo $dataIDForm[$i] ?>",
			id_katalog : "<?php echo $dataIDKatalog[$i] ?>"
		});

		<?php  }//batas for utk dataParentDiagram

		//buat ngehubungin lewat link
		//untuk menghubungkan seluruh image melalui Link
		//cari $dataParent yang form_dari

		for ($i=0; $i < count($dataParentDiagram); $i++) {
			//melakukan join Link dengan FORM where id_form=link.form_ke
			$queryChild = mysql_query("
			SELECT * FROM `LINK` join FORM on(form.id_form=link.form_ke)
			WHERE type_architecture='diagram' AND
			id_architecture='$id' AND
			form_dari='".$dataParent[$i+1]."' AND
			link.id_perusahaan='$idperusahaan'");

			while($dataChild=mysql_fetch_array($queryChild)){
				//$child = $dataChild['nama']." (".$dataChild['deskripsi'].")";
				// $child = $dataChild['nama'];
				// $child =$dataChild['nama']." \\n\\r(".str_replace("<br>","\\n\\r",$dataChild['deskripsi']).")";
				$child =str_replace("%%","\\n\\r",$dataChild['nama'])." \\n\\r(".str_replace("%%","\\n\\r",$dataChild['deskripsi']).")";

				?>


				//menghubungkan satu node dengan yang lain (link)
				//menghubungkan node parent dan child
				//arah edge sudah benar dari parent ke child
				//addEdge(source,target,style) memiliki 3 parameter: source, target, style
				//source: dataParentDiagram[i]
				//target: child
				//style: directed, stroke, label
				g.addEdge("<?php echo $dataParentDiagram[$i] ?>", "<?php echo $child ?>", {
					directed: true,
					stroke : "#aaa",
					label : "<<<?php echo $dataChild['nama_link'] ?>>>",

				});


				if (edges["<?php echo $dataIDForm[$i]; ?>"]==null) {
					edges["<?php echo $dataIDForm[$i]; ?>"] = [];
				}
				edges["<?php echo $dataIDForm[$i]; ?>"].push("<?php echo $dataChild['id_form']; ?>");

				var child = ["<?php echo $dataChild['id_form']; ?>"];

				var parent=["<?php echo $dataParentDiagram[$i] ?>"];
				console.log("parent:", parent);
				var data=["<?php echo $dataChild['id_form']?>"];
				console.log("d:", data);



				<?php
			}//batas while

		}


		?>



		// var render = function(r, n) {
		//     console.log(r);
		//         console.log(n);
		//         var set = r.set().push(
		//                     r.image("aplikasi.jpg", 5,5, 20, 20)
		//                 ).push(
		//                     r.text(0, 35, n.label)
		//                     .attr({"font-size":"10px","text-align":"center"})
		//                 );

		//         return set;
		//     };



		//     g.addNode("aaa",{
		//         render : render,
		//         label : "aaa"
		//     });
		//     g.addNode("bbb",{
		//         render : render,
		//         label : "bbb"
		//     });
		//     g.addEdge("aaa","bbb",{
		//         directed:true,
		//         label : "aaa"
		//     });

		/* layout the graph using the Spring layout implementation */
		//menggunakan layout yang diambil dari dracula_graph.js

		var parents = [<?php
		$queryParent= mysql_query("
		select distinct id_architecture, form_dari
		from Link
		where
		id_perusahaan=$idperusahaan AND
		type_architecture='diagram' AND
		id_architecture=$id AND
		form_dari NOT IN
		(select distinct form_ke from Link
		where id_perusahaan=$idperusahaan AND
		type_architecture='diagram' AND
		id_architecture=$id)
		");
		$isHead = true;
		while($parent = mysql_fetch_array($queryParent)) {
			if ($isHead) {
				$isHead = false;
				echo "\"".$parent['form_dari']."\"";
			} else {
				echo ",\"".$parent['form_dari']."\"";
			}
		}
		?>];

		var childs = [<?php
		$query = mysql_query("
		SELECT distinct form_ke
		FROM `LINK` join FORM
		on(form.id_form=link.form_ke)
		WHERE type_architecture='diagram' AND
		id_architecture=$id AND
		link.id_perusahaan=$idperusahaan
		");
		$isChilds=true;
		while($childs=mysql_fetch_array($query)){
			if($isChilds){

				$isChilds=false;
				echo ",\"".$childs['form_ke']."\"";
			}
			else{
				echo ",\"".$childs['form_ke']."\"";
			}
		}
		?>
	];

	resetKoordinat = function(){


		console.log("childs:", childs);
		console.log("childslength:", childs.length);
		console.log("PARENTS:", parents);
		console.log("parentslength:", parents.length);
		console.log(forms);
		console.log("edges:", edges);

		//set koordinat Parent-nya pada awal Penggambaran
		function redraw(key, xCoord, yCoord) {
			sets[key].translate(xCoord-sets[key].getBBox().x,yCoord-sets[key].getBBox().y);
			forms[key].x = sets[key].getBBox().x;
			forms[key].y = sets[key].getBBox().y;
			$("#koordinat").val(JSON.stringify(forms));
		}
		var marginX = 20, marginY = 20;
		//margin Y + (100*i) berguna agar tiap node parent memiliki koordinat Y yang berbeda
		for (var i = 0; i < parents.length; i++) {
			//memanggil fungsi redraw
			redraw(parents[i], marginX,100*i+marginY);
		}


		//sets[key] maupun forms[key] berisi diagrams['id_form']

		function DFSCalc() {
			var width = 0;
			var height = 0;
			var visited = {};
			var origin = {};
			var availSlot = [];

			var stack = [];
			//masukkan semua parents ke dalam stack
			for (var i = 0; i < parents.length; i++) {
				stack.push(parents[i]);
			}

			//selama stack masih berisi
			while (stack.length>0) {
				//jika ada isinya, pop() masukkin ke var node
				var node = stack.pop();

				//jika kondisi node belum dikunjungi
				//maka node ditandai sudah dikunjungi
				if (visited[node]!=true) {
					visited[node] = true;
					//edges[] berisi keterhubungan parent dengan childnya
					//jika suatu node masih memiliki child
					if (edges[node]!=null) {
						for (var i = 0; i < edges[node].length; i++) {
							//untuk setiap anak-anak dari Node, mereka punya origin siapa / siapa yang menunjuk edges tersebut

							//melegitimasi  bahwa origin nya itu si Node
							//lalu men-set
							if (origin[edges[node][i]]==null) origin[edges[node][i]] = node;

							//push setiap anak-anaknya
							stack.push(edges[node][i]);
						}
					}

					//current level
					var curr = 0;

					//node yang sekarang diganti
					//node jadi currNode
					var currNode = node;
					var origins = [];

					//selama currNode punya origin, dan bukan parent
					//maka curr++(levelnya nambah karena bergeser posisi node yang ditinjau)
					while (origin[currNode]!=null && origins.indexOf(origin[currNode])==-1) {
						curr++;
						//karena prosesnya bergeser, currNode diganti jadi Origin. Udah sampai di ujung(rootnya)
						origins.push(origin[currNode]);
						currNode = origin[currNode];
					}
					//dimulai dari availSlot[0]

					if (availSlot[curr]==null) availSlot[curr] = 0;
					availSlot[curr]++;

				}
			}

			//height =0
			//jila availSlot > height
			//maka height = availSlot
			for (var i = 0; i < availSlot.length; i++) {
				if (availSlot[i]>height) {
					height = availSlot[i];
				}
			}

			width = availSlot.length;

			console.log("Width:",width);
			console.log("Height:",height);
			return {width:width, height:height};
		}


		function DFSTransform(start, availSlot, addedToGrid, height) {
			//start: awal mula menelusuri node
			var visited = {};
			var origin = {};

			//var horizontal
			var horSpacing = parseInt(($('svg').width()-marginX*2)/availSlot.length);

			//var vertical
			var verSpacing = parseInt(($('svg').height()-marginY*2)/height);

			//start itu parentsnya
			var stack = [start];

			//selama di stack masih ada
			while (stack.length>0) {
				var node = stack.pop();

				if (visited[node]!=true) {
					visited[node] = true;
					if (edges[node]!=null) {
						for (var i = 0; i < edges[node].length; i++) {

							if (origin[edges[node][i]]==null) origin[edges[node][i]] = node;
							stack.push(edges[node][i]);
						}
					}

					//current mulai dari 0 karena menentukan index
					var curr = 0;
					var origins = [];
					var currNode = node;
					//kondisi ketika origins tidak ada di origin
					while (origin[currNode]!=null && origins.indexOf(origin[currNode])==-1) {
						curr++;
						origins.push(origin[currNode]);
						currNode = origin[currNode];
					}

					//addedToGrid untuk catat node apa saja yang sudah di draw
					//kondisi jika node belum pernah di draw atau masuk ke grid, maka panggil method redraw
					//
					if (addedToGrid.indexOf(node)==-1) {
						//x: marginX + hoirzontal Spacing*currentLevel
						//current utk menentukan node berada di level berapa
						//node[i] akan sama denga curr Levelnya
						//availSlot[curr]: tinggi nya
						redraw(node, marginX+horSpacing*curr, marginY+availSlot[curr]*verSpacing);

						//availSlot[] yang sudah terpakai, node selanjutnya akan ditaruh di bawahnya
						availSlot[curr]++;
						//node yang sekarang di masukan ke dalam grid, maka di push
						addedToGrid.push(node);
					}
				}
			}
		}

		var dimension = DFSCalc();
		var availSlot = [];

		//setelah tau dimensi width
		//availSlot[] jadi 0 yang artinya grid2 tersedia untuk di draw
		for (var i = 0; i < dimension.width; i++) {
			availSlot[i] = 0;
		}

		var addedToGrid = [];

		//untuk semua parents jalankan DFSTransform
		for (var i = 0; i < parents.length; i++) {
			DFSTransform(parents[i], availSlot, addedToGrid, dimension.height);
		}


		//untuk menyambungkan lagi node dengan edgenya
		//atau dapat disebut juga untuk menyambungkan ikon-ikon dengan linknya
		for (var i = 0; i < g.edges.length; i++) {
			//mengambil method connection dari Dracula_graph
			g.edges[i].connection.draw();
		}

	};

	var layouter;
	redraw = function() {

		layouter.layout();
		renderer.draw();
	};

	//kondisi jika tidak dapat dicari parentnya
	if(parents.length==0){
		parents = [<?php
		$queryParent= mysql_query("
		select distinct id_architecture, form_dari
		from Link
		where
		id_perusahaan=$idperusahaan AND
		type_architecture='diagram' AND
		id_architecture=$id
		");
		$isHead = true;
		if($parent = mysql_fetch_array($queryParent)) {
			if ($isHead) {
				$isHead = false;
				echo "\"".$parent['form_dari']."\"";
			} else {
				echo ",\"".$parent['form_dari']."\"";
			}
		}
		?>];

		layouter = new Graph.Layout.Ordered(g);
		if (existUnmodified) {
			// Susun ulang diagram
			setTimeout(resetKoordinat,0);
			//matrix.x=1000;
			//matrix.y=-20;
		}
	} else {

		layouter = new Graph.Layout.Ordered(g);
		if (existUnmodified) {
			// Susun ulang diagram
			setTimeout(resetKoordinat,0);
			//matrix.x=1000;
			//matrix.y=-20;
		}
	}


	/* draw the graph using the RaphaelJS draw implementation */
	renderer = new Graph.Renderer.Raphael('diagram', g, width, height);



};//batas window.onload function



</script>
</html>
