<?php
 include 'inc/header.php';
 include 'inc/sidebar.php';
 ?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- delete data by query -->
						<?php
						
							if (!isset($_GET['delcat']) || $_GET['delcat'] == NULL ) {
							echo ("Location:catlist.php"); 
							}else{
							$delid 		= $_GET['delcat'];
							$query 		= "DELETE FROM tb_category WHERE id = $delid ";
							$del_cat	= $db->delete($query);
							if ($del_cat ) {
          						 echo "<span class='success'>Data deleted successfully!</span>";
          						 }else{
          						 echo "<span class='error'>Data not Deleted !</span>";
          					}

							}
						?>

		
						<!-- select data by query -->
						<?php
						$query 		= "SELECT * FROM tb_category ORDER BY id DESC";
						$category 	= $db->select($query);
						if ($category) {
							$i 		= 0;
							while ($result = $category ->fetch_assoc()) {
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result ['name']?></td>
							<td>
								<a href="edit.php?catid  <?php echo  $result ['id']; ?>" > Edit 	</a> || 
								<a onclick ="return confirm('Are you sure to Delete !');" 
								href="?delcat=<?php echo  $result ['id']; ?>" > Delete	</a>
							</td>
						</tr>
						<?php } } ?>	<!-- End if & while condition -->
					</tbody>
				</table>
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
      <?php
 include 'inc/footer.php';
 ?>