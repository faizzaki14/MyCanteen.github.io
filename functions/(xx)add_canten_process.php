<?php
include "../config.php";

	if (isset($_POST['submit_add_canten'])) 
	{
		$cantenName = $_POST['nama_canten'];
		$cantenDesc = $_POST['desc_canten'];
		$idOwn = $_POST['id_owner'];
	
			// Query for data insertion
			$query = "INSERT INTO cafetaria (nama_cafet, cafet_desc, id_owner) VALUES ('$cantenName', '$cantenDesc', '$idOwn')";

			$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM cafetaria WHERE nama_cafet='$cantenName'"));

			if ($stat > 0) {
				echo "<script>alert('Data Already Exist !');document.location='../owner/add_canten.php'</script>";
			} else {		
				mysqli_query($koneksi, $query) or die(mysqli_error());
				echo "<script>alert('Canteen Successfully Added');document.location='../owner/index_owner.php'</script>";
				//header('location:../login.php');
			}
		

	} else {
		echo "<script>alert('Error Detected, Please Try Again!');document.location='../owner/add_canten.php'</script>";

	}
 
?>

