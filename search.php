<?php
include 'inc/header.php';
?>
<!-- searchid selected -->
<?php
	if (!isset($_REQUEST['search']) || ($_REQUEST['search']) == NULL ){ //category(category.php?category=) pass 																from sidebar.php  and caught
		header("Location:404.php");
	}else{
		$search = $_REQUEST['search'];
	}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<?php
			$query	= "SELECT * FROM tbl_post WHERE title LIKE '%$search%' || body LIKE '%$search%' ";
			$post 	= $db->select($query);
			if($post){
			while ($result = $post->fetch_assoc()) {
		?>
		<div class="samepost clear">
			<h2><a href = "post.php?id=<?php echo $result ['id'] ; ?> "><?php echo $result ['title']; ?></a></h2>
			<h4><?php echo $fm->formatDate($result ['date']); ?>, By <a href="#"><?php echo $result ['author']; ?></a></h4>
			<a href = "post.php?id=<?php echo $result ['id'] ; ?> "><img src="admin/upload/<?php echo $result ['img']; ?>" alt="post image"/></a>
			<p>
				<?php echo $fm -> textShorten ($result ['body']); ?>
			</p>
			<div class="readmore clear">
				<a href ="post.php?id= <?php echo $result ['id'] ;?>">Read More</a>
			</div>
		</div>
		
		<?php } ?><!--while loop end -->
		<?php }else { ?>
			<P>Your such query is not found !!</P>
		<?php } ?>
	</div>
<?php
	include_once'inc/sidebar.php';
	include_once'inc/footer.php';
?>