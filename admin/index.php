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
	<title>
		<?php
			if(isset($config['appname']))
				echo "Admin - ".$config['appname'];
			else
				echo "Admin - Permit System";
		?>
	</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="main adminmainpage">
		<?php 
			include './header.php';

			// Retreiving the User Details

			?>
			<div class="admindetails">
				<div class="datacontainer">
				<?php

					$userquery = "SELECT * FROM ".$config['tableprefix']."padmins WHERE userid = '".$_SESSION['permituserid']."'";

					try{
						$userqueried = $db->query($userquery);

						if($db->numrows($userqueried) <= 0){
							// If someone manipulated the session variables.
							// Log them out before they reach any information.
							header("refresh:0;url=./logout.php");
							exit();
						}

						$userdetails = $db->fetch($userqueried);

						echo "<h3>".$userdetails['username']."</h3>";
						echo $userdetails['email'];
					}
					catch(Exception $e){
						throw new Exception($e, 1);
						exit();
					}

					// Now the Options Tray.
				?>
				<br/><br/>
					<div class="row">
						<div class="col-md-3" align="center">
							<a href="./allapplications.php">
								<div class="tile">
									All Applications
								</div>
							</a>
						</div>
						<div class="col-md-3" align="center">
							<a href="./alldates.php">
								<div class="tile">
									All Openings
								</div>
							</a>
						</div>
						<div class="col-md-3" align="center">
							<a href='./verifyappl.php'>
								<div class="tile">
									Verify A Permit
								</div>
							</a>
						</div>
						<div class="col-md-3" align="center">
							<a href="./addadmin.php">
								<div class="tile">
									Add an Admin
								</div>
							</a>
						</div>
						<div class="col-md-3" align="center">
							<a href="./adddate.php">
								<div class="tile">
									Add an Opening
								</div>
							</a>
						</div>
						<div class="col-md-3" align="center">
							<a href="../viewstatus.php">
								<div class="tile">
									View Status
								</div>
							</a>
						</div>
						<div class="col-md-3" align="center">
							<a href="./updatepass.php">
								<div class="tile">
									Update Password
								</div>
							</a>
						</div>
						<div class="col-md-3" align="center">
							<a href="./updateemail.php">
								<div class="tile">
									Update Email
								</div>
							</a>
						</div>
					</div>

					<br/><br/>
				</div>
		</div>
		<div class="adminstats">
			<br/>
			<div class="statscontainer">
				<div class="row">
					<?php
						// Running more queries to populate the stats.

						$today = date("Y-m-d");

						$statquery1 = "SELECT * FROM ".$config['tableprefix']."permits WHERE approved = 0 AND pdate >= '".$today."'";

						$numunapproved = $db->numrows($db->query($statquery1));

						echo "
						<div class='col-md-4'>
							<div class='unapproved'>
								<span class='heading'>
									{$numunapproved}
								</span>
								<br/>
								Unapproved Permits
							</div>
						</div>";

						$statquery2 = "SELECT * FROM ".$config['tableprefix']."pdates WHERE pdate >= '".$today."'";

						$numdates = $db->numrows($db->query($statquery2));

						echo "
						<div class='col-md-4'>
							<div class='furtherdates'>
								<span class='heading'>
									{$numdates}
								</span>
								<br/>
								Further Openings
							</div>
						</div>";

						$statquery3 = "SELECT * FROM ".$config['tableprefix']."permits";

						$numtotalapps = $db->numrows($db->query($statquery3));

						echo "
						<div class='col-md-4'>
							<div class='totalapplications'>
								<span class='heading'>
									{$numtotalapps}
								</span>
								<br/>
								Total Served
							</div>
						</div>";
					?>
				</div>
				<br/>
				<div align='center'>That's all folks!</div>
			</div>
		</div>
</body>
</html>