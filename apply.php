<?php
	session_start();
	require_once('./inc/checker.php');
	require_once('./inc/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
			if(isset($config['appname']))
				echo "Apply - ".$config['appname'];
			else
				echo "Apply - Permit System";
		?>
	</title>
	<?php include './inc/styles.html'; ?>
</head>
<body>
	<div id='root' class="container-fluid">
		<div class="main applicationmain">
			<?php include './header.php' ?>
			<div class="applypagecontainer">
				<div class="applicationpage">
					<h2>Apply For Permit</h2>
					<br/>
					<form class="applicationform" action="" method="POST">
						Check Date :<br/><br/>
						<input name="datetocheck" class='form-control' type="date" required/>
						<br/>
						<div class="row">
							<div class="col-6">
								<button class="proceed btn btn-primary" type="submit">Check</button>
							</div>
							<div class="col-6">
								<a href="./"><button class="cancel btn btn-danger">Home</button></a>
							</div>
						</div>
					</form>
					<?php
						if($_POST['datetocheck']){

							$datetocheck = $db->escape($_POST['datetocheck']);

							echo "<div class='applicationfiller'>";

							// Checking if a permit is available on the given date.

							$checkdate = "SELECT * FROM ".$config['tableprefix']."pdates WHERE pdate = '".$datetocheck."';";

							$queried = $db->query($checkdate);

							if($db->numrows($queried) > 0){
								// If there is an opening for the date.

								$dateinfo = $db->fetch($queried);

								$checkdate1 = "SELECT * FROM ".$config['tableprefix']."permits WHERE pdate = '".$datetocheck."';";

								// Check if there is vacancy on the date.

								$queried1 = $db->query($checkdate1);

								if($db->numrows($queried1) >= $dateinfo['npermits']){
									// If there is no vacancy.

									echo "<br><br>No vacancy on this date.";
								}
								else{
									// Render a form to proceed further.

									?>
									<br/>
										<form action="finalizeappl.php" class="furtherdetails" method="POST">
											<h4>
												Enter Your Details
											</h4>
											<br/>
											Date Entered : 
											<br/>
											<input type="date" readonly="true"name="entereddate"  value="<?php echo $datetocheck ?>" required class='form-control'/>
											<br/>
											<label for='vehiclenumber'>Vehicle Number</label> : <br/>
											<input type="text" title="Enter your Vehicle Number" name="vehiclenumber" required class="form-control" />
											<br/>
											<label for='applicantname'>Name</label> : <br/>
											<input title="Enter Your Name" type="text" name="applicantname" required class="form-control">
											<br/>
											<label for='applicantemail'>Email</label> : <br/>
											<input title="Enter Your Email" type="email" requied name="applicantemail" class="form-control">
											<br/>
											<label for='applicantphone'>Phone</label> :
											<br/>
											<input title="Enter Your Phone Number" type="number" min="0" class="form-control" name="applicantphone" required/>
											<br/>
											<button type="submit" class="submitdetails">Apply For Permit</button>
										</form>
									<?php
								}
							}
							else{
								echo "<br><br>No permits on this date available.<br><br/>";
							}

							echo "</div>";
						}
					?>
				</div>
				<div class="procedure">
					<br/>
					<div align="center">
						<h3>The Process</h3>
					</div>
					<div class="row">
						<div class="col-md-4" align="center">
							<i class="fas fa-calendar-day fa-3x processicon"></i>
							<br/><br/>
							Select a date.
						</div>
						<br/><br/>
						<div class="col-md-4" align="center">
							<i class="fas fa-table fa-3x processicon"></i>
							<br/><br/>
							Check availability.
						</div>
						<br/><br/>
						<div class="col-md-4" align="center">
							<i class="fas fa-clipboard-check fa-3x processicon"></i>
							<br/>
							<br/>
							Apply for the Permit.
						</div>
					</div>
					<br/>
				</div>
			</div>
		</div>
	</div>
</body>
</html>