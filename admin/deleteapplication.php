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
	<title>Delete Application</title>

	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="main" style="padding: 1rem;">
		<?php
			if($_GET['pno']){
				$query = "DELETE FROM ".$config['tableprefix']."permits WHERE permitid='".$db->escape($_GET['pno'])."'";

				if($db->query($query)){
					echo "<br/><div class='alert alert-success'>The Application was successfully deleted. Close this tab now and reload the previous tab.</div><br/>";
				}else{
					echo "<br/><div class='alert alert-danger'>The Application could not be deleted for some reason. Close this tab and kindly Try Again.</div><br/>";
				}
			}
			else{
				header("refresh:0;url=./");
				exit();
			}
		?>
	</div>
</body>
</html>