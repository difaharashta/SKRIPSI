<?php
    include 'header.php';
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
                    <h1 class="page-header">Tambah Arsitek</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                        <div id="form-box" style="padding:25px 0px">
                            <form role="form" method="post" action="architect-insert.php">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama"/>
                                        </div>
                                       <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" type="text" name="username" placeholder="Masukkan Username"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" name="password" placeholder="Masukkan Password"/>
                                        </div>
                                     <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input class="form-control" type="password" name="konf_password" placeholder="Ulangi Password"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" placeholder="Masukkan Email"/>
                                        </div>
                                      <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Lengkap"></textarea>
                                        </div>
                                      <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="form-control" name="provinsi">
                                             <option value="aceh">Aceh</option>
                                             <option value="Sumut">Sumatera Utara</option>
                                             <option value="sumbar">Sumatera Barat</option>
                                             <option value="Riau">Riau</option>
                                             <option value="Jambi">Jambi</option>
                                             <option value="Sumsel">Sumatera Selatan</option>
                                             <option value="Bengkulu">Bengkulu</option>
                                             <option value="Lampung">Lampung</option>
                                             <option value="BaBel">Kep. Bangka Belitung</option>
                                             <option value="kepRiau">Kepulauan Riau</option>
                                             <option value="Jakarta">Jakarta</option>
                                             <option value="Jabar">Jawa Barat</option>
                                             <option value="Banten">Banten</option>
                                             <option value="Jateng">Jawa Tengah</option>
                                             <option value="Yogyakarta">Yogyakarta</option>
                                             <option value="Jatim">Jawa Timur</option>
                                             <option value="Kalbar">Kalimantan Barat</option>
                                             <option value="Kalteng">Kalimantan Tengah</option>
                                             <option value="Kalsel">Kalimantan Selatan</option>
                                             <option value="Kaltim">Kalimantan Timur</option>
                                             <option value="Kaltra">Kalimantan Utara</option>
                                             <option value="Bali">Bali</option>
                                             <option value="NTT">Nusa Tenggara Timur</option>
                                             <option value="NTB">Nusa Tenggara Barat</option>
                                             <option value="Sulut">Sulawesi Utara</option>
                                             <option value="Sulteng">Sulawesi Tengah</option>
                                             <option value="Sulsel">Sulawesi Selatan</option>
                                             <option value="Sultengg">Sulawesi Tenggara</option>
                                             <option value="Sulbar">Sulawesi Barat</option>
                                             <option value="Gorontalo">Gorontalo</option>
                                             <option value="Maluku">Maluku</option>
                                             <option value="Maluku Utara">Maluku Utara</option>
                                             <option value="Papua">Papua</option>
                                             <option value="Papua Barat">Papua Barat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input class="form-control" type="text" name="kota" placeholder="Masukkan Kota Asal"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon/Hp</label>
                                            <input class="form-control" type="number" name="hp" placeholder="Masukkan Nomor Telepon/Handphone"/>
                                        </div>
                                        <button type="submit" class="form-control btn btn-success">Submit</button>
                                        
                                    </form>
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

