<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<style>
	tr.odd td, tr.even td {
    text-align: center;

}
</style>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width = "5%">Serial No.</th>
						<th width = "15%">Name</th>
						<th width = "15%">Email</th>
						<th width = "15%">Message</th>
						<th width = "10%">Date</th>
						<th width = "15%">Action</th>
					</tr>
				</thead>
				<tbody>
					<!-- delete data by query -->
						<?php
						
							if (!isset($_GET['delid']) || $_GET['delid'] == NULL ) {
								// echo "<script>window.location = 'inbox.php';</script>";
							}else{
								$delid 	= $_GET['delid'];
								$query 	= "DELETE FROM tbl_contact WHERE id='".$delid."'";
								$del_cat= $db->delete($query);
								if ($del_cat ) {
          							 echo "<span class='success'>Message deleted 	successfully!</span>";
          							 }else{
          							 echo "<span class='error'>Message not Deleted 	!</span>";
          						}

							}
						?>
					<!-- tbl_contact query -->
					<?php
						$query ="SELECT * FROM tbl_contact where status='0' ORDER BY id DESC";					
						$post  =$db-> select($query);
						if ($post) {
							$i = 00;
						while ($result=$post->fetch_assoc()) {
								$i++;
					?> 
					<tr class="odd gradeX">
						<td><?php echo $i;?></td>
						<td><?php echo $result['firstname'].' '.$result['lastname'];?></td>
						<td><?php echo $result['email'];?></td>
						<td><?php echo $fm->textShorten($result['sms'], 35);?></td>
						<td><?php echo $fm->formatDate($result['date']);?></td>
						<td>
							<a onclick ="return confirm('if seen..this msg go to seen box!');" href="viewmsg.php?viewid=<?php echo $result['id']; ?>">View</a> ||
							<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a>
							
						</td>
					</tr>
				<?php }}?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box round first grid">
		<h2>Seen Message</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width = "5%">Serial No.</th>
						<th width = "15%">Name</th>
						<th width = "15%">Email</th>
						<th width = "15%">Message</th>
						<th width = "10%">Date</th>
						<th width = "15%">Action</th>
					</tr>
				</thead>
				<!-- status 1 -->
				<?php
						$query ="SELECT * FROM tbl_contact where status='1' ORDER BY id DESC";					
						$post  =$db-> select($query);
						if ($post) {
							$i = 00;
						while ($result=$post->fetch_assoc()) {
								$i++;
					?> 
				<tbody>
					
					<td style="text-align: center;"><?php echo $i;?></td>
					<td style="text-align: center;"><?php echo $result['firstname'].' '.$result['lastname'];?></td>
					<td style="text-align: center;"><?php echo $result['email'];?></td>
					<td style="text-align: center;"><?php echo $fm->textShorten($result['sms'], 35);?></td>
					<td style="text-align: center;"><?php echo $fm->formatDate($result['date']);?></td>
					<td style="text-align: center;">
						<a onclick ="return confirm('Are you sure to Delete !');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
					</td>
				</tbody>
				<?php }}?> <!-- end -->
			</table>
		</div>
	</div>
</div>
<?php include 'inc/footer.php' ?>