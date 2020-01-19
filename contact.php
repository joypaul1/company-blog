<?php
include 'inc/header.php';
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			<!-- this validation & query for contact form -->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $firstname = $fm->validation ($_POST['firstname']);
                    $lastname  = $fm->validation ($_POST['lastname']);
                    $email 	   = $fm->validation ($_POST['email']);
                    $sms       = $fm->validation ($_POST['sms']);
                    
                    $firstname = mysqli_real_escape_string($db->link,$firstname);
                    $lastname  = mysqli_real_escape_string($db->link,$lastname);
                    $email 	   = mysqli_real_escape_string($db->link,$email);
                    $sms       = mysqli_real_escape_string($db->link,$sms);
                    if (empty($firstname)) {
                        echo "<span style='color:#9F7D67;font-size:18px'>Firstname must not be empty !</span>";
               		}elseif(!filter_var($firstname ||$lastname,FILTER_SANITIZE_SPECIAL_CHARS)){
               			echo "<span style='color:#9F7D67;font-size:18px'>Invalid email !";
               		}elseif(empty($email)){
                        echo "<span style='color:#9F7D67;font-size:18px'>Email must not be empty !</span>";
                    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        echo "<span style='color:#9F7D67;font-size:18px'>Invalid email !";
					}elseif(empty($sms)){
                        echo "<span style='color:#9F7D67;font-size:18px'>Message should be write here!</span>";
                    }else{
                        echo"<span style='color:#9F7D67;font-size:18px'>Thanks for contact us </span>";
                        $query ="INSERT Into tbl_contact(firstname,lastname,email,sms)VALUES ('".$firstname."','".$lastname."','".$email."','".$sms."')";
                                                
                        $insert_row = $db->insert($query);
                            if ($insert_row) {
                            echo "<span style='color:green;font-size:18px'> & Contact Successfully.</span>";
                            }else {
                                echo "<span style='color:red;font-size:18px'> & Contact Not Successfully!</span>";
                            } 
                    	}
                    }
                        ?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name"/>
						</td>
					</tr>
					
					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address"/>
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="sms"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit"/>
						</td>
					</tr>
				</table>
				<form>
				
				</div>
			</div>

			<?php
				include_once'inc/sidebar.php';
				include_once'inc/footer.php';
			?>
			