<?php
include_once 'lib/database.php';
include_once 'config/config.php';
include_once 'helpers/format.php';
?>
<?php
$db = new Database();
$fm = new format();
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- page title show -->
		<?php
			if (isset($_GET['pageid'])) {
				$title_name = ($_GET['pageid']);
				$query    = "SELECT * FROM tbl_page_ext where id='".$title_name."'";
				$pages    = $db->select($query);
				if ($pages){
				while ($result= $pages->fetch_assoc()) {
		?>

		<title><?php echo $result['name'] ;?>-<?php echo TITLE ;?></title>
		<?php }}} elseif (isset($_GET['id'])) {
				$postid = ($_GET['id']);
				$query    = "SELECT * FROM tbl_post where id='".$postid."'";
				$pages    = $db->select($query);
				if ($pages){
				while ($result= $pages->fetch_assoc()) {
		?>
		<title><?php echo $result['title'] ;?>-<?php echo TITLE ;?></title>
		<?php }}}else{ ?><!-- end here 3condition -->
		<!-- fixed names show here -->
		<title><?php echo $fm->title() ;?>-<?php echo TITLE ;?></title>
		<?php }?>
		<meta name="language" content="English">
		<meta name="description" content="It is a website about education">
		<meta name="keywords" content="blog,cms blog">
		<meta name="author" content="Delowar">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="style.css">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider({
				effect:'random',
				slices:10,
				animSpeed:500,
				pauseTime:5000,
				startSlide:0, //Set starting Slide (0 index)
				directionNav:false,
				directionNavHide:false, //Only show on hover
				controlNav:false, //1,2,3...
				controlNavThumbs:false, //Use thumbnails for Control Nav
				pauseOnHover:true, //Stop animation while hovering
				manualAdvance:false, //Force manual transitions
				captionOpacity:0.8, //Universal caption opacity
				beforeChange: function(){},
				afterChange: function(){},
				slideshowEnd: function(){} //Triggers after all slides have been shown
			});
		});
		</script>
	</head>
	<body>
		<div class="headersection templete clear">
			<a href="index.php">
				<!-- SELECT QUERY FOR SLOGAN -->
				<?php
				$query  = "SELECT * FROM title_slogan where id ='1'";
				$slogan =$db->select($query );
				if ($slogan) {
				while ($result = $slogan->fetch_assoc()) {
				
				?>
				<div class="logo">
					<img src="admin/upload/<?php echo $result['logo']?>" alt="Logo"/>
					<h2><?php echo $result['title']?></h2>
					<p><?php echo $result['slogan']?></p>
				</div>
				<?php }} ?> <!-- END HERE -->
			</a>
			<div class="social clear">
				<div class="icon clear">
					<!-- SELECT QUERY FOR social -->
					<?php
					$query  = "SELECT * FROM tbl_social where id ='1'";
					$social =$db->select($query );
					if ($social) {
					while ($result = $social->fetch_assoc()) {
					
					?>
					<a href="<?php echo $result['fb']?>" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="<?php echo $result['tw']?>" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="<?php echo $result['ln']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
					<a href="<?php echo $result['gp']?>" target="_blank"><i class="fa fa-google-plus"></i></a>
					<?php } } ?> <!-- END HERE -->
				</div>
				<div class="searchbtn clear">
					<form action="search.php" method="post">
						<input type="text" name="search" placeholder="Search keyword..."/>
						<input type="submit" name="submit" value="Search"/>
					</form>
				</div>
			</div>
		</div>
		<div class="navsection templete">
			<ul>
				<li><a id="active" href="index.php">Home</a></li>
				<!-- select query for new page -->
				<?php
				$query    = "SELECT * FROM tbl_page_ext ";
				$pages    = $db->select($query);
				if ($pages){
				while ($result = $pages ->fetch_assoc()) {
				?>
				<li><a href="about.php?pageid=<?php echo $result['id'] ; ?>">
					<?php echo $result['name'] ;?>
				</a></li>
				<?php }} ?> <!-- END HERE -->
				<li><a href="contact.php">Contact</a></li>
				<li><a href="">Iteam</a>
				<ul>
					<li><a href="">Iteam one</a></li>
					<li><a href="">Iteam three</a></li>
					<li><a href="">Iteam four</a></li>
					<li><a href="">Iteam five</a></li>
				</ul>
			</li>
		</ul>
	</div>