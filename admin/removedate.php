<?php
	// File to remove an opening
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
	<title>Remove Date - Admin CP</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="root" style="padding: 1rem;">
		<?php
			if(!$_GET['date']){
				header("refresh:0;url=./");
				exit();
			}
			else{
				$query1 = "DELETE FROM ".$config['tableprefix']."pdates WHERE pdate = '".$db->escape($_GET['date'])."'";

				$query2 = "DELETE FROM ".$config['tableprefix']."permits WHERE pdate = '".$db->escape($_GET['date'])."'";

				if($db->query($query1) && $db->query($query2)){
					echo "<br><div class='alert alert-success'>Successfully deleted the opening and all applications associated with it. You may close this tab now.</div>";
				}
				else{
					echo "<br><div class='alert alert-danger'>Could not delete the opening due to an internal database problem.</div><br/>";
				}
			}
		?>
	</div>
</body>
</html>