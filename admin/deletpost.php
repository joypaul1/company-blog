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
$fm = new format();
?>
<!-- delete data by query -->
<?php

	if (!isset($_GET['postdelid']) || $_GET['postdelid'] == NULL ) {
	echo ("Location:postlist.php"); 
	}else{
	$delid 		= $_GET['postdelid'];

	$query		= "SELECT * fROM tbl_post where id = '$delid '";
	$get_img	= $db->select($query);
	if ($get_img ) {
			while ($result 	= $get_img->fetch_assoc()) {
				$dellink	= $result['img']; //image detected from database
				// unlink($dellink);
				unlink("../admin/upload/$dellink");  //image deleted from image foulder
			}
		}
		$query 	= "DELETE FROM tbl_post WHERE id = '$delid'  ";
		$del_img= $db->delete($query);
		if ($del_img) {
			// echo "<script> alert('Data deleted successfully.')</script>";
			// echo "<script> window.location ='postlist.php' ;</script>";
			echo "<span class='error'> Data deleted successfully</span>";
			echo header("Location:postlist.php");
		
		}else{
			echo "<script> alert('Data not deleted !')</script>";
			echo "<script> window.location ='postlist.php' ;</script>";
		}

	}
?>