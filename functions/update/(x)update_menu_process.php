<?php 

include "../../config.php";

if(isset($_POST['submitUpdate']))
{
	//getting the post values
	$id = $_POST['id_menu'];
	$nama = $_POST['menuName'];
	$desc=$_POST['menuDesc'];
	$ppic=$_FILES["profilepic"]["name"];
	$oldppic=$_POST['oldpic'];
	$oldprofilepic="../"."../"."img"."/".$oldppic;
	$imgfile = "";

	// get the image extension
	$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
	// allowed extensions
	$allowed_extensions = array(".jpg",".jpeg",".png",".gif");
	// Validation for allowed extensions .in_array() function searches an array for a specific value.
	if(!in_array($extension, $allowed_extensions)) {

		echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";

	}
		else {

			//rename the image file
			$imgnewfile=md5($imgfile).time().$extension;
			// Code for move image into directory
			move_uploaded_file($_FILES["profilepic"]["tmp_name"],"../../img/".$imgnewfile);

			// Query for data insertion
			$query=mysqli_query($koneksi, "UPDATE menu SET nama_menu='$nama', desc_menu='$desc', img_menu='$imgnewfile' WHERE id_menu='$id'");

		if ($query) {

			unlink($oldprofilepic);
			echo "<script>alert('Menu Successfully Updated');document.location ='../../owner/index_owner.php';</script>";

		} else{

			echo "<script>alert('Something Went Wrong. Please try again');document.location ='../../owner/index_owner.php';</script>";

		}

	}

}

 ?>