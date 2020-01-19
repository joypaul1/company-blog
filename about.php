<?php
include 'inc/header.php';
?>
<!-- pageid selected -->
<?php
	if (!isset($_GET['pageid']) || $_GET['pageid']== NULL ) {
	    header ("Location:404.php"); //"<script>window.location ='catlist.php';</script>";
	}else{
    	$id=$_GET['pageid'];
}
?>

<!-- select query for new page -->
<?php
    $query          = " SELECT * FROM tbl_page_ext WHERE id='".$id."'";
    $pages          = $db->select($query );
    if ($pages) {
    	while ($result  = $pages->fetch_assoc()) {
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2><?php echo $result['name'] ;?></h2>
			<p><?php echo  $result['body'] ;?></p>
			
			<img src="images/software-developer.jpg" alt="">
			<img src="images/what-is-a-web-developer.jpg" alt="">
			<img src="images/Blog-Cover-image-Fullstack-Highres.jpg" alt="">
			<img src="images/software-developer.jpg" alt="">
			<img src="images/what-is-a-web-developer.jpg" alt="">
			<img src="images/Blog-Cover-image-Fullstack-Highres.jpg" alt="">
		</div>
	</div>
	<?php }} else{ 
		header ("Location:404.php");
	} //end loop
	?>
<?php
	include_once 'inc/sidebar.php';
	include_once 'inc/footer.php';
?>
	