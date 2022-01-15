<?php
include "../../config.php";
session_start();

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
				echo "<script>alert('Cantenn Data Already Exist !');document.location='../../owner/add_canten.php'</script>";
			} else {		
				mysqli_query($koneksi, $query) or die(mysqli_error());
				echo "<script>alert('Canteen Successfully Added');document.location='../../owner/index_owner.php'</script>";
				//header('location:../login.php');
			}
		}

	} //else {
		//echo "<script>alert('Error Detected, Please Try Again!');document.location='../../owner/add_canten.php'</script>";

	//}



	//==============
	//==============
	//==============



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

	} //else {

		//echo "<script>alert('Error Detected, Please Try Again!');document.location='../owner/add_canten.php'</script>";

	//}



	//
	//
	//



	if (isset($_GET['submitCheckout'])) {

		$id = $_GET['id_user'];
		$id_menu = $_GET['id_menu'];
		$price = $_GET['price'];
		

		//x $query=mysqli_query($koneksi, "INSERT INTO checkout (id_menu, id_user, total, status) VALUES ('$id_menu', '$id', '$total', 'view')");
		$query=mysqli_query($koneksi, "INSERT INTO checkout (id_menu, id_user, status) VALUES ('$id_menu', '$id', 'view')");

		 $total = $_SESSION['total'];
		
		 $total= $total + $price;
		 $_SESSION['total'] = $total;

		if($query) {

			echo "<script>alert('Menu Added to Checkout');document.location='../../checkout_user.php'</script>";

		} else {

			echo "<script>alert('Menu Added to Checkout FAILED');document.location='../../index.php'</script>";

		}

		// $id_menu = $_GET['id_menu'];
		// $price = $_GET['price'];

		// $_SESSION['checkMenu'] = $id_menu;
		// $_SESSION['total'] = $_SESSION['total'] + $price;

		// echo "<script>alert('Menu Added to Checkout');document.location='../../checkout_user.php'</script>";


	} //else {*

		//echo "<script>alert('Error Detected, Please Try Again!');document.location='../../index.php'</script>";

	//}
 	


	//
	//
	//

	if (isset($_POST['submitPay'])) {
		$id = $_POST['id_user'];
		$total = $_SESSION['total'];

		$query = mysqli_query($koneksi, "INSERT INTO transaction_log (id_user, total, finished_at) VALUES ('$id', '$total', now())");

		if ($query) {

			$del1 = mysqli_query($koneksi, "DELETE FROM transaction WHERE id_user = '$id'");
			$del2 = mysqli_query($koneksi, "DELETE FROM checkout WHERE id_user = '$id'");
			$_SESSION['total']=0;

			echo "<script>alert('PAYMENT SUCCESSFULL, YOUR ORDER WILL BE DELIVERED. THANK YOU');document.location='../../index.php'</script>";
		}
	}



	//
	//
	//

?>

