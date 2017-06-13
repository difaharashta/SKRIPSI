<?php
session_start();
if(isset($_SESSION['art_username'])){
    header("location:index.php");
}
	$provinsi =  array("Aceh", "Sumatera Utara", "Sumatera Barat", "Riau", "Jambi", "Sumatera Selatan", "Lampung", "Bengkulu", "Bangka Belitung", "Kepulauan Riau", "Jakarta", "Jawa Barat", "Jawa Tengah", "Yogyakarta", "Jawa Timur", "Banten", "Bali", "Nusa Tenggara Barat", "Nusa Tenggara Timur", "Kalimantan Barat", "Kalimantan Timur", "Kalimantan Tengah", "Kalimantan Selatan", "Sulawesi Utara", "Sulawesi Tengah", "Sulawesi Selatan", "Sulawesi Tenggara", "Gorontalo", "Sulawesi Barat", "Maluku", "Maluku Utara", "Papua", "Papua Barat");

?>
<!DOCTYPE html>
    <html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TOGAF</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin/css/sb-admin-2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default" style="margin-top:10%">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center">Register</h3>
                    </div>
                    <div class="panel-body">
                          <div class="col-lg-12 col-md-12">
                        <div id="form-box" style="padding:25px 0px">
                            <form role="form" method="post" action="signup-insert.php">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input required class="form-control" type="text" name="nama" placeholder="Masukkan Nama"/>
                                        </div>
                                       <div class="form-group">
                                            <label>Username</label>
                                            <input required class="form-control" type="text" name="username" placeholder="Masukkan Username"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Password</label>
                                            <input required class="form-control" type="password" name="password" placeholder="Masukkan Password"/>
                                        </div>
                                     <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input required class="form-control" type="password" name="konf_password" placeholder="Ulangi Password"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Email</label>
                                            <input required class="form-control" type="email" name="email" placeholder="Masukkan Email"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea  required class="form-control" name="alamat" placeholder="Masukkan Alamat Lengkap"></textarea>
                                        </div>
                                      <div class="form-group">
                                            <label>Provinsi</label>
											 <select required class="form-control" name="provinsi">
                                            <?php
											for($i=0;$i<count($provinsi);$i++){
												?>
												<option <?php
												if($provinsi[$i]==$data['architect_provinsi']){
													echo "selected";
												}
												?>
												value="<?php
												echo $provinsi[$i]; ?>"><?php echo $provinsi[$i]; ?></option>
												<?php
											}
											?>
                                            </select>
                                            </div>
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input required class="form-control" type="text" name="kota" placeholder="Masukkan Kota Asal"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon/Hp</label>
                                            <input required class="form-control" type="number" name="hp" placeholder="Masukkan Nomor Telepon/Handphone"/>
                                        </div>
                                        <button type="submit" class="form-control btn btn-success">Register </button>

                                    </form>
                                     <p class="error">
                                <?php
                                if(isset($_GET['error'])){
                                    echo $_GET['error'];
                                }
                                ?>
                                </p>
                        </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="admin/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin/js/sb-admin-2.js"></script>

</body>

</html>
