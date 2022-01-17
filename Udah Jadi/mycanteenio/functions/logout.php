<?php 
	session_start();
	$_SESSION['status'] = "logout";
	session_destroy();
	header('Location:../login.php');
?>