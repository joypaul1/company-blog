<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
		<ul>
			<?php
				$query 		= "Select * from tb_category";
				$category 	= $db->select($query);
				if($category){
					while ($result= $category->fetch_assoc()) {
			?>
			<li><a href="category.php?catagoryid=<?php echo $result ['id'] ; ?>"><?php echo $result['name'] ;?></a></li> <!-- id pass by categoryid -->
			<?php } ?><!-- end while loop -->
			<?php }else{ ?>
				<li>No catagory created !</li>
			<?php } ?>
		</ul>
	</div>
	
	
	<div class="samesidebar clear">
		<h2>Latest articles</h2>
		<div class="popular clear">
			<?php
				$query 		= "Select * from tbl_post";
				$category 	= $db->select($query);
				if($category){
					while ($result= $category->fetch_assoc()) {
			?>
			<h3><a href = "post.php?id=<?php echo $result ['id'] ; ?> "><?php echo $result ['title']; ?></a></h3>
			<a href = "post.php?id=<?php echo $result ['id'] ; ?> "><img src="admin/upload/<?php echo $result ['img']; ?>" alt="post image"/></a>
			<p><?php echo $fm -> textShorten ($result ['body'],100); ?></p>
			<?php } ?><!-- end while loop -->
			<?php }else{ header("Location:404.php") ;} ?>
		</div>
		
		
	</div>
	
</div>
</div>