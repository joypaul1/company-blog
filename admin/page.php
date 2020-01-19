<?php
 include 'inc/header.php';
 include 'inc/sidebar.php';
 ?>
 <style>
     .leftside      {float: left;width: 70%;}
     .rightside     {float: left;width: 20%}
     .rightside img {height: 150px;width: 150px;}
     .delete a {
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
        background: #ff0000b3;
}
 </style>
<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL ) {
   echo "<script>window.location = 'index.php';</script>";
}else{
    $id=$_GET['id'];
}
?>       

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update page</h2>
                 <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $name           = mysqli_real_escape_string($db->link, $_POST['name']);
                $body           = mysqli_real_escape_string($db->link, $_POST['body']);
                
                if($name == "" || $body == " ") {
                    echo "<span class='error'>feild must not be empty !</span>";
                }else{
                    if (!empty( $file_name)) {
                        if ($file_size >1048567) {
                             echo "<span class='error'>Image Size should be less then 1MB!</span>";
                        }elseif (in_array($file_ext, $permited) === false) {
                            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        }else{
                            move_uploaded_file($file_temp, $uploaded_image);
                           $query ="UPDATE tbl_page_ext
                                SET
                                name     ='".$name."',
                                body     ='".$body."',
                                img      ='".$uploaded_image."'  
                                WHERE id ='".$id."'";


                            $update_rows = $db->update($query);
                            if ($update_rows){
                                echo "<span class='success'>Page Updated Successfully. </span>";
                            }else {
                                echo "<span class='error'>Updated Not successfully !</span>";
                            }
                        }
                    }else{

                        $query = "UPDATE  tbl_page_ext
                               SET
                               name     ='".$name."',
                               body     ='".$body."'
                               WHERE id = '".$id."' ";
                        $update_rows = $db->update($query);
                           if ($update_rows) {
                           echo "<span class='success'>Page Updated Successfully.</span>";
                            }else {
                               echo "<span class='error'>Updated Not successfully!</span>";
                            }
                        }
                    }
                }
                
         
        ?>
        <!-- select here -->
            <?php
            $query          = " SELECT * FROM tbl_page_ext WHERE id='".$id."'";
            $pages          = $db->select($query );
            if ($pages) {
                while ($result  = $pages->fetch_assoc()) {
            
            ?>

            <div class="block sloginblock">
                <div class="leftside">             
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">                    
                            <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']?>" class="medium" />
                            </td>
                        </tr>
                        
                     
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="img"  />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" width name="body" >
                                    <?php echo $result['body'] ; ?>
                                </textarea>
                            </td>
                        </tr>
                    
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="delete">
                                    <a onclick ="return confirm('Are you sure to Delete !');" href="delpage.php?delpage=<?php echo $result['id'] ;?>">Delete</a>
                                </span>
                                
                            </td>
                        </tr>
                        </table>
                    </form>
                </div> 
                
                    <div class="rightside">
                        <img src="../admin/upload/<?php echo $result ['img']; ?>"height="80px" weight = "200px" alt="post image"/>
                    </div>
                </div>
                <?php }} ?>
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
