<?php
 include 'inc/header.php';
 include 'inc/sidebar.php';
 ?>
 <style>
     .leftside      {float: left;width: 70%;}
     .rightside     {float: left;width: 20%}
     .rightside img {height: 150px;width: 150px;}
 </style>
       

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                 <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $title  = $fm->validation($_POST['title']);
                $slogan = $fm->validation($_POST['slogan']);

                $title          = mysqli_real_escape_string($db->link,  $title);
                $slogan         = mysqli_real_escape_string($db->link,  $slogan);
                
                       
                $permited       = array( 'png');
                $file_name      = $_FILES['logo']['name'];
                $file_size      = $_FILES['logo']['size'];
                $file_temp      = $_FILES['logo']['tmp_name'];
                $div            = explode('.', $file_name);
                $file_ext       = strtolower(end($div));
                $unique_image   = "logo".'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;
             
                if ($title == "" || $slogan == ""  ) {
                    echo "<span class='error'>feild must not be empty !</span>";
                }else{
                    if (!empty( $file_name)) {
                        if ($file_size >1048567) {
                             echo "<span class='error'>Image Size should be less then 1MB!</span>";
                        }elseif (in_array($file_ext, $permited) === false) {
                            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        }else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = "UPDATE title_slogan
                                    SET
                                    title       =   '$title',
                                    slogan      =   '$slogan',
                                    logo        =   '$uploaded_image'
                                    WHERE id    =    '1' ";


                            $update_rows = $db->update($query);
                                if ($update_rows) {
                                echo "<span class='success'>Title post Updated Successfully. </span>";
                                }else {
                                    echo "<span class='error'>Updated Not Inserted !</span>";
                                }
                        }
                    }else{

                         $query = "UPDATE  title_slogan
                                    SET
                                    title       =   '$title',
                                    slogan      =   '$slogan'
                                    WHERE id    = '1' ";

                            $update_rows = $db->update($query);
                                if ($update_rows) {
                                echo "<span class='success'>Title post Updated Successfully. </span>";
                                }else {
                                    echo "<span class='error'>Updated Not Inserted !</span>";
                                }
                    }
                }
            }

        ?>
                <?php
                    $query  = "SELECT * FROM title_slogan where id ='1'";
                    $slogan =$db->select($query );
                    if ($slogan) {
                     while ($result = $slogan->fetch_assoc()) {
                             
                ?>

                <div class="block sloginblock">
                <div class="leftside">             
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">                    
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title']?>"  name="title" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text"  value="<?php echo $result['slogan']?>"  name="slogan" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Upload logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo"  />
                            </td>
                        </tr>
                         <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    </div> 
                
                    <div class="rightside">
                        <img src="../admin/upload/<?php echo $result['logo']?>" alt="logo">
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
<?php
 include 'inc/footer.php';

 ?>



</script>
<?php
include 'inc/footer.php';
?>
