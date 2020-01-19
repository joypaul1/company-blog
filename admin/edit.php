<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['catid']) || $_GET['catid']== NULL ) {
echo ("Location:catlist.php"); //"<script>window.location = 'catlist.php';</script>";
}else{
$id = $_GET['catid'];
}
?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
            <?php
            if (isset($_POST['submit'])) {
            $name = $fm->validation($_POST['catname']);
            $name = mysqli_real_escape_string($db->link, $name);//2 arg (1.db connect 2.variable)
            
            if (empty( $name) ) {
            echo "<span class='error'>feild must not be empty !</span>";
            }else{
                $query = "UPDATE tb_category
                SET
                name = '$name'
                WHERE id ='".$id."'";
                $update_cat  = $db->update($query);
                    if ( $update_cat ) {
                    echo "<span class='success'>Data updated successfully!</span>";
                    }else{
                    echo "<span class='error'>Data not updated !</span>";
                    }
                    
            }
            }
            ?>

            <?php
            $query          = " SELECT * FROM tb_category WHERE id = $id ORDER BY id DESC";
            $category       = $db->select($query );
            while ($result  = $category->fetch_assoc()) {
            
            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="catname" value="<?php echo $result['name'] ?>" placeholder="is it done...?" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>