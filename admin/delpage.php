<?php
    include_once '../lib/session.php';
    Session :: checkSession();              //session start here and check login session by this method
?>
<?php
include_once '../lib/database.php';
include_once '../config/config.php';
?>
<?php
$db = new Database();
?>
<!-- delete data by query -->
<?php

	if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL ) {
		echo "<script>window.location = 'index.php';</script>"; 
	}else{
		$delid =$_GET['delpage'];

	 $query		= "SELECT * fROM tbl_page_ext where id='".$delid."'";
	 $get_img	= $db->select($query);
	 if ($get_img ) {
	 		while ($result 	= $get_img->fetch_assoc()) {
	 			$dellink	= $result['img']; //image detected from database
	 			// unlink($dellink);
	 			unlink("../admin/upload/$dellink");  //image deleted from image foulder
	 		}
	 	}
		$query 	= "DELETE FROM tbl_page_ext WHERE id='".$delid."'";
		$del_page= $db->delete($query);
		if ($del_page) {
			 echo "<script> alert('Page deleted successfully.')</script>";
			 echo "<script> window.location ='Page.php' ;</script>";
			// echo "<span class='error'> Page deleted successfully</span>";
			// echo header("Location:index.php");
		
		}else{
			echo "<script> alert('Data not deleted !')</script>";
			echo "<script> window.location ='page.php' ;</script>";
		}

	}
?>