<?php 
include "../config.php";

if (isset($_POST['submitAdd']))
	{	
		$nama = $_POST['menuName'];
		$desc = $_POST['menuDesc'];
		$type = $_POST['menuType'];
		$price = $_POST['menuPrice'];
		$idOwn = $_POST['id_owner'];
		$ppic=$_FILES["menuPic"]["name"];
		$imgfile="";

		// get the image extension
		$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
		// allowed extensions
		$allowed_extensions = array(".jpg",".jpeg",".png",".gif");
		// Validation for allowed extensions .in_array() function searches an array for a specific value.
		if(!in_array($extension,$allowed_extensions))
		{
			echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
		
		} else {
			//rename the image file
			$imgnewfile = md5($imgfile).time().$extension;
			// Code for move image into directory
			move_uploaded_file($_FILES["menuPic"]["tmp_name"],"../img/".$imgnewfile);

			$query = "INSERT INTO menu (nama_menu, desc_menu, img_menu, price_menu, id_canteen, type) VALUE ('$nama', '$desc', '$imgnewfile', '$price', '$idOwn', '$type')";
		
			$stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM menu WHERE nama_menu='$nama'"));

			if ($stat > 0) {
				echo "<script>alert('Menu Is Already Exist');document.location='../owner/add_canten.php'</script>";

			} else {		
				mysqli_query($koneksi, $query);
				echo "<script>alert('Menu Data Successfully Added');document.location='../owner/index_owner.php'</script>";

			}
		}

	} else {
		echo "<script>alert('Error Detected, Please Try Again!');document.location='../owner/add_canten.php'</script>";
	}

 ?>