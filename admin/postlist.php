<?php
 include 'inc/header.php';
 include 'inc/sidebar.php';
 ?>
      
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width = "5%" >	serial No. 	</th>
							<th width = "15%">	Post Title	</th>
							<th width = "15%">	Body		</th>  
							<th width = "10%">	Img			</th>  
 							<th width = "10%">	Cat			</th>
							<th width = "10%">	Tag			</th>
							<th width = "10%">	Author		</th>
							<th width = "10%">	Date		</th>
							<th width = "15%">	Action		</th>
						</tr> 
					</thead> 
					<tbody>
						
					<?php
						// $query	= " SELECT tbl_post.*, tb_category.name FROM tbl_post INNER JOIN tb_category ON tbl_post.cat = tb_category.id ORDER BY tbl_post.title DESC";
						$query = "SELECT * FROM tbl_post ORDER BY id DESC ";					
						$post 	= $db-> select($query);
						if ($post ) {
							$i = 0;
						while ($result = $post->fetch_assoc()) {
								$i++;
						?> 
						<tr class="odd gradeX">
							<td>	<?php echo $i ?></td>
							<?php
							
							?>
							
							<td><?php echo $result ['title'];?></td>
							<td><?php echo $fm->textshorten($result ['body'],50);?></td>
							<td><img src="../admin/upload/<?php echo $result ['img']; ?>"height="40px" weight = "50px" alt="post image"/></td>
							<td><?php echo $result ['cat'] ;?>	</td>
							<td><?php echo $result ['tag'] ;?>	</td>
							<td><?php echo $result ['author'];?></td>
							<td><?php echo $fm->formatDate($result ['date']);?></td>
							
							<td>
								<a href="editpost.php?postid=<?php echo  $result ['id']; ?>" > Edit </a>
								|| 
								<a onclick ="return confirm('Are you sure to Delete !');" 
							       href=deletpost.php?postdelid=<?php echo  $result ['id']; ?>" > Delete	</a>
							</td>
						</tr>

					<?php }   }?> <!-- End if & while loop -->
					</tbody>
				</table>
               </div>
            </div>
        </div>
    </div>
    
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    <div id="site_info">
      <p>
         &copy; Copyright <a href="http://trainingwithliveproject.com">company name</a>. All Rights Reserved.
        </p>
    </div>
	   
</body>
</html>
