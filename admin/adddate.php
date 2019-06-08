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
	<title>Add Opening - Admin CP</title>

	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="root adminloginpage">
		<?php include './header.php'; ?>
		<?php $today = date("Y-m-d"); ?>
		<div align="center" class = "formcontainer">
			<form class="adminloginform" action="" method="POST" align='left'>
				<h2>Add an Opening</h2>

				Date :
				<br/>
				<input type="date" min="<?php echo $today; ?>" class="form-control" name="openingdate"  required/>
				<br/>
				Number of Permits :
				<br/>
				<input type="number" class="form-control"  min="1" name="npermits" required/>
				<br/>
				Be careful, the date once registered cannot be modified later.
				<br/>
				<button type="submit" class="btn proceed btn-primary">Add Opening</button>
				<br/><br/>
				<a href="./"><div class="btn proceed btn-danger">Back to Admin CP</div></a>
			</form>
			<br/>
			<br/>
			<?php
				if($_POST['openingdate'] && $_POST['npermits']){
					// Only activate this block if the user has entered both the details.

					$openingdate = $db->escape($_POST['openingdate']);

					$npermits = $db->escape($_POST['npermits']);

					// Checking if there is already an opening for this date.

					$check = "SELECT * FROM ".$config['tableprefix']."pdates WHERE pdate = '".$openingdate."'";

					if($npermits < 1){
						echo ("Invalid Number of permits passed.");
						exit();
					}

					if($db->numrows($db->query($check)) > 0){
						echo "<br>An opening on this date already exists. Kindly try another date.<br>";
					}
					else{
						// Preparing for insertion.
						
						$insertion = "INSERT INTO ".$config['tableprefix']."pdates VALUES('".$openingdate."','".$npermits."')";

						if($db->query($insertion)){
							echo "<br>Opening Successfully Added!<br>";
						}
						else{
							echo "<br>Could not add an opening on this date due to a database error. Kindly Try Again.<br>";
						}
					}
				}
			?>
		</div>		
	</div>
</body>