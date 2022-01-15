<?php 

include "../../config.php";
session_start();

if (isset($_POST['deleteMenu'])) {

	$idc=$_POST['id_menu'];

	$delete=mysqli_query($koneksi, "DELETE FROM menu WHERE id_menu = '$idc'");

	If ($delete) {

		echo "<script>alert('You have successfully delete the menu');document.location ='../../owner/index_owner.php';</script>";

	} else {

		echo "<script>alert('Menu unsuccesfully deleted');document.location ='../../owner/index_owner.php';</script>";

	}

 } //else {

 // 	echo "<script>alert('Menu Delete Process Error');document.location ='../../owner/index_owner.php';</script>";

 // }


//=============
//===========
//============



if (isset($_POST['deleteFavorite'])) {

	$id = $_POST['id_favo'];

	$delete = mysqli_query($koneksi, "DELETE FROM favorite WHERE id = '$id'");

	if ($delete) {

		echo "<script>alert('Menu Removed From Favorite');document.location ='../../favorite_user.php';</script>";

	} else {

		echo "<script>alert('Delete Process Unsuccessfull, Please Try Again !');document.location ='../../favorite_user.php';</script>";

	}

} //else {

// 	echo "<script>alert('Favorite Delete Process Error');document.location ='../../index.php';</script>";

// }




//
//
//




if (isset($_POST['deleteCheck'])) {

	$id = $_POST['id'];

	$delete = mysqli_query($koneksi, "DELETE FROM checkout WHERE id = '$id'");

	if ($delete) {

		echo "<script>alert('Menu REMOVED From Checkout');document.location ='../../checkout_user.php';</script>";

	} else {

		echo "<script>alert('Delete Process Unsuccessfull, Please Try Again !');document.location ='../../checkout_user.php';</script>";

	}

} //else {

// 	echo "<script>alert('Checkout Delete Process Error');document.location ='../../index.php';</script>";

// }


?>