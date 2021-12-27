<?php
	include "../config.php";

	// mengaktifkan session php
	session_start();

	if (isset($_POST['submit_login'])) {
		// menangkap data yang dikirim dari form
		$username = $_POST['username'];
		$password = $_POST['password'];
		 
		// menyeleksi data admin dengan username dan password yang sesuai
		$data = mysqli_query($koneksi,"select * from users where username='$username' and password='$password'");
		 
		// menghitung jumlah data yang ditemukan
		$cek = mysqli_num_rows($data);
		 
		if($cek > 0){
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";

			echo "<script>alert('Login Successful');document.location='../index.html'</script>";
			//header("location:../index.html");
		}else{
			echo "<script>alert('Invalid Username or Password');document.location='../login.php'</script>";
			//header("location:../login.php?pesan=gagal");
		}
	}

	/*
	// menangkap data yang dikirim dari form
	$username = $_POST['username'];
	$password = $_POST['password'];
		 
	// menyeleksi data admin dengan username dan password yang sesuai
	$data = mysqli_query($koneksi,"select * from users where username='$username' and password='$password'");
		 
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($data);
		 
	if($cek > 0){
		$_SESSION['username'] = $username;
		$_SESSION['status'] = "login";

		echo "<script>alert('Login Successful')</script>";
		header("location:../index.html");
	}else{
		echo "<script>alert('Invalid Username or Password')</script>";
		header("location:../login.php");
	}
	*/
?>