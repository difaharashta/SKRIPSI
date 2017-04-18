<?php
	session_start();
	
	include 'connect.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "select * from admin where username='$username' and password=md5('$password')";

	$rows = mysql_num_rows(mysql_query($query));
	if($rows>0){
		$data = mysql_fetch_array(mysql_query($query));
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $data['name'];
		header("location:index.php");
	}else{
		header("location:login.php?error=Username atau Password Salah");
	}
?>