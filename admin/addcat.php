<?php
include 'inc/header.php';
include 'inc/sidebar.php';
 
?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">


            <?php
                if (isset($_POST['submit'])) {
                    $name = $fm->validation($_POST['catname']);
                    $name = mysqli_real_escape_string($db->link, $name);//2 arg (1.db connect   2.variable)
                    
                    if (empty( $name) ) {
                    echo "<span class='error'>feild must not be empty !</span>";
                    }else{
                    $query      = "INSERT INTO tb_category (name) VALUES ('". $name."')";
                    $catinsert  = $db->insert($query);
                    echo "<span class='success'>Data inserted successfully!</span>";
                    }
                    }
        
    


            ?>

            <form action="addcat.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="catname" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>