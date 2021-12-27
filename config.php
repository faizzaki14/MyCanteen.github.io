<?php
	$DBhost = "localhost";
	$DBuser = "root";
	$DBpass = "";
	$DBname = "my_canteen";

	$koneksi = mysqli_connect($DBhost, $DBuser, $DBpass, $DBname);

	// Check connection
	if($koneksi === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
    	exit();
	}

	// $koneksi = new mysqli($DBhost, $DBuser, $DBpass, $DBname);
	// If ($koneksi->connect_error) {
	// 	die('Error connection: '.$koneksi->connect_error);
	// };

?>