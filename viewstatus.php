<?php
session_start();
// PHP File to find out the status of a permit. Approved or Declined and Visited or Not.

require_once('./inc/checker.php');
require_once('./inc/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>
	<?php
		echo isset($config['appname'])?$config['appname']:"Permit System";
	?>
	</title>
	<?php
		include './inc/styles.html';
	?>
</head>
<body>
	<div id="root" class="container-fluid viewstatuspage">
		<div class="main">
			<?php include './header.php'; ?>
			<div class="viewcontainer">
				<div class="view">
					<h2>View Application Status</h2>
					<br/>
					<form action="" method="POST" align='left'>
						Date : 
						<input type="date" class="form-control" name="date" required/>
						<br/>
						Vehicle Number : 
						<input type="text" name="vehicleno" class="form-control" required/>
						<br/>
						<button type="submit" class="proceed btn btn-success">View Status</button>
					</form>
				</div>
			</div>
			<div class="statusviewer">
				<?php
					if(!$_POST['date'] || !$_POST['vehicleno']){
						echo "<br><div align='center'>View Status Here.<br></div>";
					}
					else{
						// If the user entered all the details.

						
					}
				?>
			</div>
		</div>
	</div>

	
</body>
</html>