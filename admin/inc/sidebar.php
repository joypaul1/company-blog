<div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href=""><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
                    <!-- inbox count -->
                <?php
                    $query ="SELECT * FROM tbl_contact where status='0'";
                    $msg =$db->select($query);
                    if ($msg){
                        $count = mysqli_num_rows($msg);
                        echo "(".$count.")";
                    }
                ?> 
                </span></a></li>
                <li class="ic-charts"><a href="postlist.php"><span>Visit Website</span></a></li>
            </ul>
        </div>
        
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>
                            </ul>
                        </li>
						
                         <li><a class="menuitem">Update Pages</a>
                            <ul class="submenu">
                                <li><a href="addpage.php">Add new page</a></li>
                                <!-- select query for new page -->
                                <?php
                                    $query    = "SELECT * FROM tbl_page_ext ";
                                    $pages    = $db->select($query);
                                    if ($pages) {
                                        while ($result = $pages ->fetch_assoc()) {
                                 ?>

                                <li><a href="page.php?id=<?php echo $result['id'];?>"><?php echo $result['name'];?></a>
                                </li>

                                <?php }} ?> <!-- End if and while conditon -->
                            </ul>
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a> </li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Slider Option</a>
                            <ul class="submenu">
                                <li><a href="addslider.php">Add Slider</a> </li>
                                <li><a href="sliderlist.php">Slider List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>