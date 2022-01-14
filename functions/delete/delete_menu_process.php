<?php 

include "../../config.php";
$idc=$_GET['id_c'];

$delete=mysqli_query($koneksi, "DELETE FROM menu WHERE id_menu = '$idc'");

If ($delete) {

	echo "<script>alert('You have successfully delete the menu');document.location ='../owner/index_owner.php';</script>";

} else {

	echo "<script>alert('Menu unsuccesfully deleted');document.location ='../owner/index_owner.php';</script>";

}

?>