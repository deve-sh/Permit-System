<?php
// PHP Page to Finalize the details entered into the Application Form.
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
				echo "Applying - ".$config['appname'];
			else
				echo "Applying - Permit System";
		?>
		</title>
		<?php include './inc/styles.html'; ?>
</head>
<body>
	<div id="root" class="container-fluid finalizeapplpage" align="center">
		<h2>
			<?php
				if(isset($config['appname']))
					echo $config['appname'];
				else
					echo "Permit System";
			?>
		</h2>
		<?php
			// -----------------------------------
			// Add your Payment Integration here.
			// -----------------------------------
		?>

		<?php
			// Variables

			$date = $db->escape($_POST['entereddate']);
			$vehiclenumber = $db->escape($_POST['vehiclenumber']);
			$applicant_name = $db->escape($_POST['applicantname']);
			$applicant_email = $db->escape($_POST['applicantemail']);
			$applicant_phone = $db->escape($_POST['applicantphone']);


			if(!$date || !$vehiclenumber || !$applicant_phone || !$applicant_name || !$applicant_email){
				// If any one of the variables wasn't entered or is invalid.

				echo "<br><br>Invalid Details Passed. Could not proceed.<br>Redirecting you to Application Page.<br>";
				header("refresh:2.5;url=./apply.php");
				exit();
			}else{
				// If all have been passed.

				// Checking if the phone number is not short.

				if(strlen($applicant_phone) < 7){
					echo "<br>Phone number too short.<br>";
					header("refresh:2;url=./apply.php");
					exit();
				}

				// Check if there is an opening on the provided day.

				$checkquery1 = "SELECT * FROM ".$config['tableprefix']."pdates WHERE pdate = '".$date."'";

				// Checking if there are openings left on the day.

				$checkquery2 = "SELECT * FROM ".$config['tableprefix']."permits WHERE pdate = '".$date."'";

				// Checking if the user has not already applied.

				$checkquery3 = "SELECT * FROM ".$config['tableprefix']."permits WHERE pdate = '".$date."' AND vehicle_no = '".$vehiclenumber."'";

				try{
					$queried1 = $db->query($checkquery1);

					if($db->numrows($queried1) > 0){
						$queried1 = $db->fetch($queried1);

						if($queried1['npermits'] >= 0){

							$queried2 = $db->query($checkquery2);

							if($db->numrows($queried2) < $queried1['npermits']){
								// If all the permits have not been occupied.

								$queried3 = $db->query($checkquery3);

								if($db->numrows($queried3) > 0){
									// If the vehicle already has a permit for the given date.

									echo "<br>A permit with this Vehicle Number has already been initiated on the given date.<br>";
									header("refresh:2;url=./apply.php");
									exit();
								}
								else{

									// Prepering the query to insert all the data.

									$insertionquery = "INSERT INTO ".$config['tableprefix']."permits(vehicle_no,applicant_name,applicant_email,applicant_phone,approved,pdate,visited) VALUES('".$vehiclenumber."','".$applicant_name."','".$applicant_email."','".$applicant_phone."',0,'".$date."',0)";

									if($db->query($insertionquery)){
										// Insertion Successful

										// Getting the permitid

										$retquery = "SELECT * FROM ".$config['tableprefix']."permits WHERE vehicle_no='".$vehiclenumber."' AND pdate = '".$date."'";

										$details = $db->fetch($db->query($retquery));

										// Printing a table as receipt.

										?>
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
														<?php echo $date; ?>
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
														<?php echo $applicant_phone; ?>
													</td>
												</tr>
												<tr>
													<th>Approved</th>
													<td><?php echo ($details['approved'] == 0)?"Not Approved":"Approved"; ?></td>
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

										// A Button to print

										?>
										<br/>
										<button onclick="window.print()" class="printbutton btn btn-info">Print</button>
										<br/>
										<br/>
										<a href="./">
											<button class="btn btn-primary">
												Home
											</button>
										</a>
										<?php

									}
									else{
										echo "<br>Sorry, we couldn't process your application due to some error. Kindly try again.<br>";
										header("refresh:2;url=./apply.php");
										exit();
									}
								}
							}
							else{
								echo "<br>Sorry, we are out of permits for this date. Kindly try another.<br>";
								header("refresh:2;url=./apply.php");
								exit();
							}

						}else{
							echo "<br>No Opening on this Date available.<br>Redirecting you to Application page.";
							header("refresh:2;url=./apply.php");
							exit();
						}
					}
					else{
						echo "<br>No Opening on this Date available.<br>Redirecting you to Application page.";
						header("refresh:2;url=./apply.php");
						exit();
					}
				}
				catch(Exception $e){
					throw new Exception($e);
					exit();
				}
			}
		?>
	</div>
</body>
</html>