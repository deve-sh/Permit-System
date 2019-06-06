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
						<br/>
						<input type="date" class="form-control" name="date" required/>
						<br/>
						Vehicle Number : 
						<br/>
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
							<br/>
							<p align='center'>Kindly Carry your Identity Proofs and Vehicle Papers if your Application is Approved.</p>
							<div align="center">
								<button onclick="window.print()" class="printbutton btn btn-info">Print</button>
								<br/>
								<br/>
								<a href="./">
									<button class="btn btn-primary">
										Home
									</button>
								</a>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>

	
</body>
</html>