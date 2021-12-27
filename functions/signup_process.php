<?php 
include "../config.php";

if (isset($_POST['register']))
{
	$fullname = $_POST['FullName'];
	$email = $_POST['Email'];
	$phone = $_POST['PhoneAddress'];
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$query = "INSERT INTO users (full_name, email, phone, username, password) VALUE ('$fullname', '$email', '$phone', '$user', '$pass')";

	//mysqli_query($koneksi, $query) or die(mysqli_error());
	//$stat = mysqli_query($koneksi, $query);
	$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND username='$user'"));

	// if ($stat) {
	// 	echo "<script>alert('Register Successful')</script>";
	// 	//header('location:../login.php');
	// } else {
	// 	die("<script>alert('Invalid Email or Password')</script>", mysqli_error());
	// 	//echo "<script>alert('Invalid Email or Password')</script>";
	// }

	if ($stat > 0) {
		echo "<script>alert('Invalid Email or Password');document.location='../signUp.php'</script>";
	} else {		
		mysqli_query($koneksi, $query);
		echo "<script>alert('Register Successful');document.location='../login.php'</script>";
		//header('location:../login.php');
	}
}

 ?>