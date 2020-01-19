<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Reoly Message</h2>
        <div class="block">
            <?php
            if (!isset($_GET['msgid']) || $_GET['msgid']== NULL ) {
                echo "<script>window.location = 'inbox.php';</script>";
            }else{
                $id = $_GET['msgid'];
            }
            ?>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $toEmail   = $fm->validation($_POST['toEmail']);
                $fromEmail = $fm->validation($_POST['fromEmail']);
                $subject   = $fm->validation($_POST['subject']);
                $message   = $fm->validation($_POST['message']);

                $toEmail   = mysqli_real_escape_string($db->link,$toEmail);
                $fromEmail = mysqli_real_escape_string($db->link,$fromEmail);
                $subject   = mysqli_real_escape_string($db->link,$subject);
                $message   = mysqli_real_escape_string($db->link,$message);

                $sendmail  = mail($toEmail, $subject, $message, $fromEmail);
                if ($sendmail) {
                    echo "<span class='success'>Message sent Successfully. </span>";
                }else{
                     echo "<span class='error'>Something went wrong! </span>";
                }
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
                            <label>To</label>
                        </td>
                        <td>
                            <input readonly type="text"  name="toEmail" value="<?php echo $result['email'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input  type="text" name="fromEmail" placeholder="Write here your email address..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject" placeholder="Write here subject name..." class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea name="message"  class="tinymce"></textarea>
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