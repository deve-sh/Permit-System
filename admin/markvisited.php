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
	<title>Mark Visited - Admin CP</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body class="container-fluid" style="padding: 1rem;">
	<?php
		if(!$_GET['pno']){
			header("refresh:0;url=./");
			exit();
		}
		else{

			$pno = $db->escape($_GET['pno']);

			// Check if an application with the passed pno exists.

			$query = "SELECT * FROM ".$config['tableprefix']."permits WHERE permitid = '".$pno."'";

			$queried = $db->query($query);

			if($db->numrows($queried) > 0){
				$details = $db->fetch($queried);

				if($details['approved'] == 0){
					echo "<br><div class='alert alert-danger'>
							The application has not been approved yet.
						</div><br>";
					header("refresh:2;url=./verifyappl.php");
					exit();
				}

				if($details['visited'] == 1){
					echo "<br><div class='alert alert-danger'>
							The application has already been marked visited.
						</div><br>";
					header("refresh:2;url=./verifyappl.php");
					exit();
				}

				// Setting the application to visited.

				$query1 = "UPDATE ".$config['tableprefix']."permits SET visited = 1 WHERE permitid = '".$details['permitid']."'";

				if($db->query($query1)){
					echo "<br><div class='alert alert-success'>Application marked successfully.</div><br>";
					header("refresh:2;url=./verifyappl.php");
					exit();
				}
				else{
					echo "<br><div class='alert alert-info'>Application could not be marked visited. Kindly try again later.</div><br>";
					header("refresh:2;url=./verifyappl.php");
					exit();
				}
			}
			else{
				echo "<br><div class='alert alert-danger'>No such application.</div><br>";
				header("refresh:2;url=./verifypermit.php");
				exit();
			}
		}
	?>
</body>
</html>