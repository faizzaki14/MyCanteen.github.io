<?php 
	include "../../config.php";
  	session_start();

	$id_menu = $_GET['id_m'];
	$username = $_SESSION['username'];

	$pick=mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $fetch=mysqli_fetch_array($pick);
    $id_user=$fetch['id'];

    $stat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM favorite WHERE id_menu='$id_menu' AND id_user='$id_user'"));

	if ($stat > 0) {
		echo "<script>alert('This Menu Is Already Favorited');document.location='../../favorite_user.php'</script>";
	
	} else {		
	
		$queryFav = mysqli_query($koneksi, "INSERT INTO favorite (id_menu, id_user) VALUES ('$id_menu', '$id_user')");
	    if ($queryFav) {
	    	echo "<script>document.location='../../favorite_user.php';</script>";
	    } else {
	    	echo "<script>alert('Menu Not Favorited !');document.location='../../index.php';</script>";
	    }

	}

    
?>