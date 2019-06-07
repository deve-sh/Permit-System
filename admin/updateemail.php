<?php
	session_start();
	require_once('./adminchecker.php');
	require_once('./config.php');

	// Checking if the user is logged in as admin.

	if(!$_SESSION['permitisadmin'] || !$_SESSION['permituserid']){
		header("refresh:0;url=./login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Email - Admin CP</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="main adminloginpage">
		<?php include './header.php'; ?>

		<div align="center" class = "formcontainer">
			<form class="adminloginform" action="" method="POST" align='left'>
				<br/>
				<h2>Update Email</h2>
				<br/>
				New Email :<br/>
				<input type="email" required name="newmail" class="form-control" />
				<br/>
				<button type="submit" class="btn-primary proceed btn">Update</button>
				<br/><br/>
				<a href="./"><div class="btn proceed btn-danger">Back to Admin CP</div></a>

			</form>
			<?php
				if($_POST['newmail']){

					$newmail = $db->escape($_POST['newmail']);

					// Checking if the new entered mail already belongs to someone or is already being used by the current user.

					$query1 = "SELECT * FROM ".$config['tableprefix']."padmins WHERE email = '".$newmail."'";

					if($db->numrows($db->query($query1)) > 0){
						echo "<br><div class='alert alert-danger'>Email is already in use. Try another one.</div><br>";
					}else{
						$updationquery = "UPDATE ".$config['tableprefix']."padmins SET email = '".$newmail."' WHERE userid = '".$_SESSION['permituserid']."'";

						if($db->query($updationquery)){
							echo "<br><div class='alert alert-success'>Email Successfully updated.<br>Kindly login again.</div><br>";

							header("refresh:2;url=./logout.php");
							exit();
						}else{
							echo "<br><div class='alert alert-danger'><div class='alert alert-danger'>Email could not be updated due to an error.</div><br>";
						}
					}
				}
			?>
	</div>
</body>
</html>