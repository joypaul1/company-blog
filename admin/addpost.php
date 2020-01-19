<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $title  = $fm->validation($_POST['title']);
                $body   = $fm->validation($_POST['body']));
                $cat    = $fm->validation($_POST['cat']);
                $tag    = $fm->validation($_POST['tag']);
                $author = $fm->validation($_POST['author']);

                $title  = mysqli_real_escape_string($db->link,$title);
                $body   = mysqli_real_escape_string($db->link,$body);
                $cat    = mysqli_real_escape_string($db->link,$cat);
                $tag    = mysqli_real_escape_string($db->link,$tag);
                $author = mysqli_real_escape_string($db->link,$author);
                       
                $permited       = array('jpg', 'jpeg', 'png', 'gif');
                $file_name      = $_FILES['img']['name'];
                $file_size      = $_FILES['img']['size'];
                $file_temp      = $_FILES['img']['tmp_name'];
                $div            = explode('.', $file_name);
                $file_ext       = strtolower(end($div));
                $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;
             
                if ($title == "" || $body == "" || $cat == "" || $tag == "" || $author == "" || $file_name == "" ) {
                    echo "<span class='error'>feild must not be empty !</span>";
                }   elseif ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                }   elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                }   else{
                    move_uploaded_file($file_temp, $uploaded_image);


                    $query         = "INSERT INTO tbl_post (cat,title,body,img,author,tag) VALUES ('".$cat."','".$title."','".$body."','".$file_name."','".$author."','".$tag."')";
                    $inserted_rows = $db->insert($query);
                    if ($inserted_rows) {
                    echo "<span class='success'>Data Inserted Successfully. </span>";
                    }else {
                        echo "<span class='error'>Data Not Inserted !</span>";
                    }
                }
            }

            ?>
            
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="write down post title..." class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Category</label> <!-- this category(db--cat) will be define as forenar key {tbl_category ->id == tbl_post->cat(var not  text ) } -->
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option value="">Select Category</option>
                                <?php
                                $query = "SELECT * FROM tb_category ";
                                $category = $db->select($query);
                                if ($category) {
                                    while ($result = $category->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $result['id'] ?>">
                                    <?php echo $result['name'] ?>
                                </option>
                                <?php } } ?> <!-- End If & while loop -->
                            </select>
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="img" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Body</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                  
                    <tr>
                        <td>
                            <label>Tag</label>
                        </td>
                        <td>
                            <input type="text" name="tag"  placeholder="write tag name..."/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" placeholder="write author name..."/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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