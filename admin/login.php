<?php
	session_start();
	require_once('./adminchecker.php');
	require_once('./config.php');
	if($_SESSION['permitisadmin'] && $_SESSION['permituserid']){
		header("refresh:0;url=./");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Admin - Login
	</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="main adminloginpage">
		<?php include './header.php'; ?>

		<div align="center" class = "formcontainer">
			<form class="adminloginform" action="" method="POST" align='left'>
				<br/>
				<h2>Login</h2>
				<br/>
				Username or Email : 
				<br/>
				<input type="text" required name="username" class="form-control" />
				<br/>
				Password :
				<br/>
				<input type="password" required name="password" class="form-control"/>
				<br/>
				<button class="btn proceed btn-success" type="submit">Login</button>
			</form>

			<?php
				// Login Script


				if($_POST['username'] && $_POST['password']){
					// If user entered both the username/email and password.

					$username = $db->escape($_POST['username']);
					$password = $db->escape($_POST['password']);

					$query1 = "SELECT * FROM ".$config['tableprefix']."padmins WHERE username = '".$username."' OR email = '".$username."'";

					$queried1 = $db->query($query1);

					if($db->numrows($queried1) > 0){

						$userdet = $db->fetch($queried1);

						$salt = $userdet['salt'];

						$password = crypt($password, $salt);
						$password = md5($password);

						$query2 = "SELECT * FROM ".$config['tableprefix']."padmins WHERE password = '".$password."' AND (username = '".$username."' or email = '".$username."')";

						$queried2 = $db->query($query2);

						if($db->numrows($queried2) > 0){
							// Successful login

							echo "<br>Successfully Logged In.<br>";

							$_SESSION['permituserid'] = $userdet['userid'];
							$_SESSION['permitisadmin'] = true;

							header("refresh:1.5;url=./index.php");
							exit();
						}
						else{
							// Wrong Password

							echo "<br>Wrong Password Entered.<br>";
						}

					}else{
						// No such user exists.

						echo "<br>No user with the given email or username found.<br>";
					}
				}
			?>
		</div>
	</div>
</body>
</html>