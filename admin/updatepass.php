<?php
	session_start();
	require_once('./adminchecker.php');
	require_once('./config.php');
	require_once('../inc/salt.php');

	// Checking if the user is logged in as admin.

	if(!$_SESSION['permitisadmin'] || !$_SESSION['permituserid']){
		header("refresh:0;url=./login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Password - Admin CP</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="main adminloginpage">
		<?php include './header.php'; ?>

		<div align="center" class = "formcontainer">
			<form class="adminloginform" action="" method="POST" align='left'>
				<br/>
				<h2>Update Password</h2>
				<br/>
				New Password :<br/>
				<input type="password" required name="newpass" class="form-control" />
				<br/>
				Confirm Password : <br/>
				<input type="password" required name="confpass" class="form-control" />
				<br/>
				<button type="submit" class="btn-primary proceed btn">Update</button>
				<br/><br/>
				<a href="./"><div class="btn proceed btn-danger">Back to Admin CP</div></a>

			</form>
			<?php
				if($_POST['newpass'] && $_POST['confpass']){

					$newpass = $db->escape($_POST['newpass']);
					$confpass = $db->escape($_POST['confpass']);

					if(strcmp($newpass, $confpass) != 0){
						// Passwords don't match.

						echo "<br><div class='alert alert-danger'>Passwords do not match.</div><br>";
						exit();
					}

					// Generating a new salt.

					$newsalt = saltgen();

					// Hashing the passwords.

					$newpass = crypt($newpass,$newsalt);
					$newpass = md5($newpass);

					// Updating Password and Salt for the current user.

					$updatequery = "UPDATE ".$config['tableprefix']."padmins SET password = '".$newpass."', salt = '".$newsalt."' WHERE userid = '".$_SESSION['permituserid']."'";

					if($db->query($updatequery)){
						echo "<br><div class='alert alert-success'>Password Updated Successfully.<br/>Kindly login again.</div><br/>";
						header("refresh:2;url=./logout.php");
						exit();
					}
					else{
						echo "<br><div class='alert alert-danger'>Password could not be updated.</div><br/>";
					}
				}
			?>
	</div>
</body>
</html>