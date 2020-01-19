<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <?php
            if (!isset($_GET['viewid']) || $_GET['viewid']== NULL ) {
                echo "<script>window.location = 'inbox.php';</script>";
            }else{
                $id = $_GET['viewid'];
                $query ="UPDATE tbl_contact
                        SET
                        status ='1'
                        WHERE id ='".$id."'";
                     $update_cat  = $db->update($query);
                    if ($update_cat) {
                    echo "<span class='success'>This message went to seen box.</span>";
                    }else{
                    echo "<span class='error'>Something is wrong!</span>";
                    }
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                echo "<script>window.location = 'inbox.php';</script>";
                
            }
            ?>
            <?php
                $query ="SELECT * FROM tbl_contact where id='$id'";
                $post  =$db->select($query);
                if ($post) {
                while ($result=$post->fetch_assoc()) {
            ?>
            <form action="" method="post" >
                <table class="form">
                    
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input readonly type="text" value="<?php echo $result['firstname'].' '.$result['lastname'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input readonly type="text" value="<?php echo $result['email'];?>" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea  class="tinymce"><?php echo $result['sms'];?></textarea>
                        </td>
                    </tr>
                  
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input readonly type="text" value="<?php echo $fm->formatDate($result['date']);?>" class="medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href="inbox.php"><input type="submit" name="submit" Value="Ok" /></a>
                        </td>
                    </tr>
                </table>
            </form>
        <?php }} ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
setupTinyMCE();
setDatePicker('date-picker');
$('input[type="checkbox"]').fancybutton();
$('input[type="radio"]').fancybutton();
});
</script>
<?php
include 'inc/footer.php';
?>