<?php 

include "../../config.php";

if(isset($_POST['submitUpdatePro']))
{
	//getting the post values
	$id = $_POST['id'];
	$username = $_POST['userName'];
	$name=$_POST['nama'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$oldppic=$_POST['oldpic'];
	$oldprofilepic="../"."../"."img"."/".$oldppic;
	$ppic=$_FILES["profilepic"]["name"];
	$imgfile = "";

	// get the image extension
	$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
	// allowed extensions
	$allowed_extensions = array(".jpg",".jpeg",".png",".gif");
	// Validation for allowed extensions .in_array() function searches an array for a specific value.
	if(!in_array($extension,$allowed_extensions)) {

		echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

	}
		else { 

		//rename the image file
		$imgnewfile=md5($imgfile).time().$extension;
		// Code for move image into directory
		move_uploaded_file($_FILES["profilepic"]["tmp_name"],"../../img/".$imgnewfile);

		// Query for data insertion
		$query=mysqli_query($koneksi, "UPDATE users SET username='$username', full_name='$name', email='$email', password='$pass', img='$imgnewfile' WHERE id = '$id'");
		
		if ($query) {

			unlink($oldprofilepic);
			echo "<script>alert('Profile Info Successfully Updated');document.location ='../../owner/update_profile_own.php';</script>";

		} else{

			echo "<script>alert('Something Went Wrong. Please try again');document.location ='../../owner/update_profile_own.php';</script>";

		}

	}

} else {

	echo "<script>alert('Something Went Wrong. Please try again');document.location ='../owner/index_owner.php';</script>";

}



//
//
//



if(isset($_POST['submitUpdateCan']))
{
	//getting the post values
	$id = $_POST['id_owner'];
	$name = $_POST['cantenName'];
	$desc=$_POST['cantenDesc'];
	$oldppic=$_POST['oldpic'];
	$oldprofilepic="../"."../"."img"."/".$oldppic;
	$ppic=$_FILES["profilepic"]["name"];
	$imgfile = "";

	// get the image extension
	$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
	// allowed extensions
	$allowed_extensions = array(".jpg",".jpeg",".png",".gif");
	// Validation for allowed extensions .in_array() function searches an array for a specific value.
	if(!in_array($extension,$allowed_extensions)) {

		echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

	}
		else { 

		//rename the image file
		$imgnewfile=md5($imgfile).time().$extension;
		// Code for move image into directory
		move_uploaded_file($_FILES["profilepic"]["tmp_name"],"../../img/".$imgnewfile);

		// Query for data insertion
		$query=mysqli_query($koneksi, "UPDATE cafetaria SET nama_cafet='$name', cafet_desc='$desc', cafet_img='$imgnewfile' WHERE id_owner = '$id'");
		
		if ($query) {

			unlink($oldprofilepic);
			echo "<script>alert('Canteen Info Successfully Updated');document.location ='../../owner/index_owner.php';</script>";

		} else{

			echo "<script>alert('Something Went Wrong. Please try again');document.location ='../../owner/index_owner.php';</script>";

		}

	}

} else {

	echo "<script>alert('Something Went Wrong. Please try again');document.location ='../owner/index_owner.php';</script>";

}



//===============
//===============
//===============



if(isset($_POST['submitUpdate']))
{
	//getting the post values
	$id = $_POST['id_menu'];
	$nama = $_POST['menuName'];
	$desc=$_POST['menuDesc'];
	$ppic=$_FILES["profilepic"]["name"];
	$oldppic=$_POST['oldpic'];
	$oldprofilepic="../img"."/".$oldppic;
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
			move_uploaded_file($_FILES["profilepic"]["tmp_name"],"../img/".$imgnewfile);

			// Query for data insertion
			$query=mysqli_query($koneksi, "UPDATE menu SET nama_menu='$nama', desc_menu='$desc', img_menu='$imgnewfile' WHERE id_menu='$id'");

		if ($query) {

			unlink($oldprofilepic);
			echo "<script>alert('You have successfully inserted the data');document.location ='../owner/index_owner.php';</script>";

		} else{

			echo "<script>alert('Something Went Wrong. Please try again');</script>";

		}

	}

} else {

	echo "<script>alert('Something Went Wrong. Please try again');document.location ='../owner/index_owner.php';</script>";
	
}

 ?>