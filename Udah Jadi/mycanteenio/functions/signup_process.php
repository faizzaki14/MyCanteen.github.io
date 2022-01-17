<?php 
include "../config.php";

$fullname = $_POST['FullName'];
$email = $_POST['Email'];
$phone = $_POST['PhoneAddress'];
$user = $_POST['username'];
$pass = $_POST['password'];
$confirm = $_POST['confirm_password'];

if ($confirm == $pass) {
	if (isset($_POST['registerUser']))
	{
		$query = "INSERT INTO users (full_name, email, phone, username, password, role) VALUE ('$fullname', '$email', '$phone', '$user', '$pass', 'user')";
		
		$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND username='$user'"));

		if ($stat > 0) {
			echo "<script>alert('Invalid Email or Password');document.location='../signUp.php'</script>";

		} else {		
			mysqli_query($koneksi, $query);
			echo "<script>alert('Register Successful');document.location='../login.php'</script>";
			//header('location:../login.php');

		}

		//mysqli_query($koneksi, $query) or die(mysqli_error());
		//$stat = mysqli_query($koneksi, $query);
		// if ($stat) {
		// 	echo "<script>alert('Register Successful')</script>";
		// 	//header('location:../login.php');
		// } else {
		// 	die("<script>alert('Invalid Email or Password')</script>", mysqli_error());
		// 	//echo "<script>alert('Invalid Email or Password')</script>";
		// }

	} else if (isset($_POST['registerOwner'])) {
		$query = "INSERT INTO users (full_name, email, phone, username, password, role) VALUE ('$fullname', '$email', '$phone', '$user', '$pass', 'own')";
		
		$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND username='$user'"));

		if ($stat > 0) {
			echo "<script>alert('Invalid Email or Password');document.location='../signUp.php'</script>";

		} else {		
			mysqli_query($koneksi, $query);
			echo "<script>alert('Register Successful');document.location='../login.php'</script>";
			//header('location:../login.php');

		}
		
	} else {
		echo "<script>alert('Error, Please Try Again!');document.location='../signUp.php'</script>";

	}

} else {
	echo "<script>alert('Password do not match, Please Try Again!');document.location='../signUp.php'</script>";

}

 ?>