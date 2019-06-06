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
	<title>Verify Permit - Admin CP</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="main adminloginpage">
		<?php include './header.php'; ?>

		<div align="center" class = "formcontainer">
			<form class="adminloginform" action="" method="POST" align='left'>
				<h2>Verify Permit</h2>
				Date : 
				<br/>
				<input type="date" class="form-control" name="date" required/>
				<br/>
				Vehicle Number : 
				<br/>
				<input type="text" name="vehicleno" class="form-control" required/>
				<br/>
				<button type="submit" class="proceed btn btn-info">View Status</button>
				<br/><br/>
				<a href="./"><div class="btn proceed btn-danger">Back to Admin CP</div></a>
			</form>

			<?php
				// Printing the details.

				if($_POST['date'] && $_POST['vehicleno']){
					$date = $db->escape($_POST['date']);
						$vehicleno = $db->escape($_POST['vehicleno']);

						$query = "SELECT * FROM ".$config['tableprefix']."permits WHERE pdate = '".$date."' AND vehicle_no = '".$vehicleno."'";

						$queried = $db->query($query);

						if($db->numrows($queried) <= 0){
							echo "<br><div align='center'>Application Not Found.</div><br>";
						}
						else{
							$details = $db->fetch($queried);

							// Printing a table of details.

							?>
							<div align="center" class="printheading">
								<h2>Application Details</h2>
							</div>
							<br/>
							<div class="tablecontainer" align="center">
								<table id='applicationtable'>
									<tr>
										<th class="headingfields">Fields</th>
										<th class="headingfields">Details</th>
									</tr>
									<tr>
										<th>Permit Number</th>
										<td><?php echo $details['permitid']; ?></td>
									</tr>
									<tr>
										<th>Date</th>
										<td>
											<?php echo $details['pdate']; ?>
										</td>
									</tr>
									<tr>
										<th>Vehicle No</th>
										<td><?php echo $details['vehicle_no'];?></td>
									</tr>
									<tr>
										<th>Name</th>
										<td><?php echo $details['applicant_name']; ?></td>
									</tr>
									<tr>
										<th>Email</th>
										<td><?php echo $details['applicant_email']; ?></td>
									</tr>
									<tr>
										<th>Phone</th>
										<td>
											<?php echo $details['applicant_phone']; ?>
										</td>
									</tr>
									<tr>
										<th>Approved</th>
										<td><?php echo ($details['approved'] == 0)?"Not Approved":"Approved"; ?></td>
									</tr>
									<tr>
										<th>Visited</th>
										<td><?php echo ($details['visited'] == 0)?"Not Visited":"Visited"; ?></td>
									</tr>
									<tr>
										<th>Application Time</th>
										<td><?php
											echo $details['appl_time']
										?></td>
									</tr>
								</table>
							</div>
					<?php
							if($details['approved'] == 0){
								// If application is not approved.
								?>
								<br/>
								<a href="./approveappl.php?pno=<?php echo $details['permitid']; ?>">
									<div class="btn btn-success">Approve Application</div>
								</a>
								<?php
							}

							if($details['visited'] == 0 && $details['approved'] == 1){
								// If application has not been marked as visited after being approved.

								?>
								<br/>
								<a href="./markvisited.php?pno=<?php echo $details['permitid']; ?>">
									<div class="btn btn-success">Mark Visited</div>
								</a>
								<?php
							}
						}
				}
			?>
		</div>
	</div>
</body>
</html>