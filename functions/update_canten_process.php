<?php 

include "../config.php";

if(isset($_POST['submitUpdateCan']))
{
	//getting the post values
	$id = $_POST['cantenName'];
	$desc=$_POST['cantenDesc'];
	$ppic=$_FILES["profilepic"]["name"];

	// get the image extension
	$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
	// allowed extensions
	$allowed_extensions = array(".jpg",".jpeg",".png",".gif");
	// Validation for allowed extensions .in_array() function searches an array for a specific value.
	if(!in_array($extension,$allowed_extensions))
	{
		echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

	}
		else
	{
		//rename the image file
		$imgnewfile=md5($imgfile).time().$extension;
		// Code for move image into directory
		move_uploaded_file($_FILES["profilepic"]["tmp_name"],"../img/".$imgnewfile);

		// Query for data insertion
		$query=mysqli_query($koneksi, "insert into tblusers(FirstName,LastName, MobileNumber, Email, Address,ProfilePic) value('$fname','$lname', '$contno', '$email', '$add','$imgnewfile' )");
		if ($query) {
		echo "<script>alert('You have successfully inserted the data');</script>";
		echo "<script type='text/javascript'> document.location ='../owner/index_owner.php'; </script>";

		} else{
			echo "<script>alert('Something Went Wrong. Please try again');</script>";

		}

	}

}

 ?>