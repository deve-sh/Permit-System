<?php
	session_start();
	require_once('./adminchecker.php');
	require_once('./config.php');

	if(!$_SESSION['permitisadmin'] || !$_SESSION['permituserid']){
		header("refresh:0;url=./login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Admin - Admin CP</title>

	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="root adminloginpage">
		<?php include './header.php'; ?>

		<div align="center" class = "formcontainer">
			<form class="adminloginform" action="./finalizeadmin.php" method="POST" align='left'>
				<br/>
				<h2>Add Admin</h2>
				<br/>
				Username : 
				<br/>
				<input type="text" required name="username" class="form-control" />
				<br/>
				Email :
				<br/>
				<input type="email" class="form-control" required name="email">
				<br/>
				Password :
				<br/>
				<input type="password" required name="password" class="form-control"/>
				<br/>
				<button class="btn proceed btn-primary" type="submit">Login</button>
				<br/><br/>
				<a href="./"><div class="btn proceed btn-danger">Back to Admin CP</div></a>
			</form>
		</div>
	</div>
</body>
</html>