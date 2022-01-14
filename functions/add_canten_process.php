<?php
include "../config.php";

	if (isset($_POST['submit_add_canten'])) 
	{
		$cantenName = $_POST['nama_canten'];
		$cantenDesc = $_POST['desc_canten'];
		$idOwn = $_POST['id_owner'];
		$canPic = $_FILES["gambar_canten"]["name"];
		$imgfile = "";

		// get the image extension
		$extension = substr($canPic,strlen($canPic)-4,strlen($canPic));

		// allowed extensions
		$allowed_extensions = array(".jpg",".jpeg",".png",".gif");

		// Validation for allowed extensions .in_array() function searches an array for a specific value.
		if(!in_array($extension,$allowed_extensions)) {
			echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

		} else {
			//rename the image file
			$imgnewfile=md5($imgfile).time().$extension;

			// Code for move image into directory
			move_uploaded_file($_FILES["gambar_canten"]["tmp_name"],"../img/".$imgnewfile);

			// Query for data insertion
			$query = "INSERT INTO cafetaria (nama_cafet, cafet_desc, cafet_img, id_owner) VALUES ('$cantenName', '$cantenDesc', '$imgnewfile', '$idOwn')";

			$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM cafetaria WHERE nama_cafet='$cantenName'"));

			if ($stat > 0) {
				echo "<script>alert('Cantenn Data Already Exist !');document.location='../owner/add_canten.php'</script>";
			} else {		
				mysqli_query($koneksi, $query) or die(mysqli_error());
				echo "<script>alert('Canteen Successfully Added');document.location='../owner/index_owner.php'</script>";
				//header('location:../login.php');
			}
		}

	} else {
		echo "<script>alert('Error Detected, Please Try Again!');document.location='../owner/add_canten.php'</script>";

	}
 
?>

