<?php
 include 'inc/header.php';
 include 'inc/sidebar.php';
 ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">


                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $fb = $fm->validation($_POST['fb']);
                $tw = $fm->validation($_POST['tw']); 
                $ln = $fm->validation($_POST['ln']);
                $gp = $fm->validation($_POST['gp']);

                $facebook     = mysqli_real_escape_string($db->link,  $fb);
                $twitter      = mysqli_real_escape_string($db->link,  $tw);
                $linkedin     = mysqli_real_escape_string($db->link,  $ln);
                $googleplus   = mysqli_real_escape_string($db->link,  $gp);
                
                
             
                if ($facebook == "" || $twitter == "" || $linkedin == "" || $googleplus == ""  ) {
                    echo "<span class='error'>feild must not be empty !</span>";
                }else{
                    $query = "UPDATE tbl_social
                                    SET
                                    fb      =   '$facebook',
                                    tw      =   '$twitter',
                                    ln      =   '$linkedin',
                                    gp      =   '$googleplus'
                                    WHERE id=    '1' ";
                    $update_rows = $db->update($query);
                                if ($update_rows) {
                                echo "<span class='success'>Social  link Updated Successfully. </span>";
                                }else {
                                    echo "<span class='error'>Updated Not Inserted !</span>";
                                }
                    }
                }
        ?>
                <?php
                    $query  = "SELECT * FROM tbl_social where id ='1'";
                    $social =$db->select($query );
                    if ($social) {
                     while ($result = $social->fetch_assoc()) {
                             
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $result['fb']?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $result['tw']?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $result['ln']?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp"value="<?php echo $result['gp']?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
      <?php
 include 'inc/footer.php';

 ?>
