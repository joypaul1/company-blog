<?php
 include 'inc/header.php';
 include 'inc/sidebar.php';
 ?>
      
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock">
                    
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $copyright = $fm->validation($_POST['copyright']);
                $copyright = mysqli_real_escape_string($db->link,$copyright);
               
                if ($copyright == "" ) {
                    echo "<span class='error'>feild must not be empty !</span>";
                }else{
                    $query = "UPDATE tbl_copyright
                                    SET
                                    copyright   =  '$copyright'    
                                    WHERE id    =   '1' ";
                    $update_rows = $db->update($query);
                                if ($update_rows) {
                                echo "<span class='success'>copyright Updated Successfully. </span>";
                                }else {
                                    echo "<span class='error'>Updated Not Inserted !</span>";
                                }
                    }
                }

                ?>
                <?php
                    $query  = "SELECT * FROM tbl_copyright where id ='1'";
                    $copyright =$db->select($query );
                    if ($copyright) {
                     while ($result = $copyright->fetch_assoc()) {
                             
                ?>

                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['copyright']?>" name="copyright" class="large" />
                                </td>
                            </tr>
    						
    						 <tr> 
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
      