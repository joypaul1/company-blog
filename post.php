<?php
include 'inc/header.php';
?>
<?php
	if (!isset($_GET['id']) || ($_GET['id']) == NULL ){
		header("Location:404.php");
	}else{
		$id = $_GET['id'];
	}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<!-- select query for post -->
			<?php
			$query = "SELECT * from tbl_post where id =$id ";
			$post  = $db->select($query);
			if($post){
			while ($result = $post->fetch_assoc()) {
				
			?>
			<h2><a href = "post.php?id=<?php echo $result ['id'] ; ?>"> <?php echo $result ['title']; ?> </a></h2>
			<h4><?php echo $fm->formatDate($result ['date']); ?>, By <a href="#"><?php echo $result ['author']; ?></a></h4>
			<img src="admin/upload/<?php echo $result ['img']; ?>" alt="post image"/>
			<p><?php echo $result ['body']; ?></p>
			
			
			
			<div class="relatedpost clear">
				<h2>Related articles</h2>
				<?php
					$catid 			= $result ['cat']; //that's row catagory 
					$query			= "SELECT * from tbl_post where cat='$catid' order by rand() limit 6"; //check it-->that's row catagory such full table catagory where r same catagory in this case..&and show result limit 6
					$relatedpost	= $db->select($query);
					if($relatedpost){
					while ($rresult = $relatedpost->fetch_assoc()) {

				?>
				<a href="post.php?id=<?php echo $rresult ['id'] ;?>">
				<img src="admin/upload/<?php echo $rresult ['img']; ?>" alt="post image"/></a>
				
			
			<?php } ?><!-- 2nd while loop end -->
			<?php } else{
				echo "NO related post is now available!";
			}?>
			</div>
			<?php } ?><!--1st while loop end -->
			<?php }else{
					header("Location:404.php");
				} // End
			?>
		</div>
	</div>
	<?php
			include_once'inc/sidebar.php';
			include_once'inc/footer.php';
	?>