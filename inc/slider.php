<div class="slidersection templete clear">
	
	<div id="slider">
		<?php
			$query ="SELECT * FROM tbl_slider";
			$post  =$db->select($query);
			if ($post) {
			while ($result=$post->fetch_assoc()) {
		?>
		<<a href="#"><img src="images/slider/<?php echo $result['img']; ?>" alt="nature 1" title="This is slider one Title or Description" /></a>
		<?php }} ?> <!-- end here -->
		
	</div>
	
</div>