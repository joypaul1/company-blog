<?php
	include_once '../lib/session.php';
	Session :: checkLogin();
?>
<?php
	include_once '../lib/database.php';
	include_once '../config/config.php';
	include_once '../helpers/format.php';
?>
<?php
$db = new Database();
$fm = new format();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username 	=$fm->validation ($_POST['username']);
				$password 	=$fm->validation (md5($_POST['password']));

				$username 	= mysqli_real_escape_string($db->link,$username);
				$password 	= mysqli_real_escape_string($db->link,$password);

				$query 	  	= "SELECT * FROM tbl_user WHERE username = '$username' AND 
				password = '$password'";
				$result   	= $db->select($query);

				if($result  != false) {
					// $value   = mysqli_fetch_array($result);
					//$row 	= mysqli_num_row($result);
					$value   = mysqli_fetch_assoc($result); 
					if ($value  > 0){
						Session :: set("login",true); //this ->login caught for check->2 arg/here(,) is eql(=) 
						Session :: set("username",$value['username']);
						Session :: set("id",$value['id']);
						header("Location:index.php");
					}else{
						echo "<span style='color:red;font-size:18px'>Result not found !!</span>";

					}
				}else{
					echo "<span style='color:red;font-size:18px'>Username or password not matched !!</span>";
				}
			}

		

		?>

		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Company name</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>