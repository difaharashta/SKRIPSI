<?php
	session_start();
	include 'admin/connect.php'; //include file connect.php untuk connect to databse

	$username = $_POST['username']; //mengambil variable input dari user berupa data username yang di input di form
	$password = $_POST['password'];
 $query = "select * from architect where architect_username='$username' and architect_password=md5('$password')";
	//query untuk mengecek kecocokan data username dan password yang ada di database

	$rows = mysql_num_rows(mysql_query($query)); //fungsi untuk mendapatkan berapa banyak baris data yang di hasilkan dari query diatas
	if($rows>0){ //mengecek jika barisnya lebih dari 0 maka berhasil login dan jika tidak maka gagal
		$data = mysql_fetch_array(mysql_query($query)); //mem fetching data atau mengambil data dari database berdasarkan user yang loign
		if($data['architect_status']==1){
			$_SESSION['art_username'] = $username; //membuat session yang diisikan username 
			$_SESSION['art_nama'] = $data['architect_nama']; //membuat session yang diisikan username 
			$_SESSION['art_id'] = $data['architect_id']; //membuat session yang diisikan username 
			header("location:perusahaan.php"); //redirect ke halaman perusahaan .php
			
		}else{
			header("location:login.php?error=Akun Anda Belum Di Aktifkan"); //redirect ke login.php dengan pesan error
			
		}
	}else{
		header("location:login.php?error=Username atau Password Salah"); //redirect ke login.php dengan pesan error
	}
?>