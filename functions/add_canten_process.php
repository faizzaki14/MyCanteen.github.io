<?php 
include "../config.php";

if (isset($_POST['submitAdd']))
	{	
		$nama = $_POST['cantenName'];
		$desc = $_POST['cantenDesc'];
		$idOwn = $_POST['id_owner'];

		$query = "INSERT INTO cafetaria (nama_cafet, cafet_desc, id_owner) VALUE ('$nama', '$desc', '$idOwn')";
		
		$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE nama_cafet='$nama'"));

		if ($stat > 0) {
			echo "<script>alert('Canteen Name Is Already Exist');document.location='../add_canten.php'</script>";

		} else {		
			mysqli_query($koneksi, $query);
			echo "<script>alert('Data Successfully Added');document.location='../index_owner.php'</script>";

		}

	} else {
	echo "<script>alert('Error Detected, Please Try Again!');document.location='../add_canten.php'</script>";

}

 ?>