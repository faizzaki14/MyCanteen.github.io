<?php
include "../config.php";

if (isset($_POST['submit'])) {
	$cantenName = $_POST['canteen_name'];
	$cantenDesc = $_POST['canten_desc'];
 
	$query = "INSERT INTO cafetaria (nama_cafet, cafet_desc) VALUES ('$cantenName', '$cantenDesc')";

	$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM cafetaria WHERE nama_cafet='$cantenName'") or die(mysqli_error()));

	if ($stat > 0) {
		echo "<script>alert('Invalid Input');document.location='../add_canten.php'</script>";
	} else {		
		mysqli_query($koneksi, $query) or die(mysqli_error());
		echo "<script>alert('Canteen Successfully Added');document.location='../index.php'</script>";
		//header('location:../login.php');
	}
}
?>