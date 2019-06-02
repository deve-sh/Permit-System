<?php
session_start();
require_once('../inc/installchecker.php');  // Check if the script is already installed.
?>
<!DOCTYPE html>
<html>
<head>
	<title>Install Permit System</title>
	<?php include '../inc/installstyles.html'; ?>
</head>
<body>
	<div id='root' class="container-fluid installpage" align="center">
		<div class="heading">Install</div>
		<div align="center">
			<form id="installform" action="installer.php" method="POST">
				<h5>Database Details</h5>
				<br/>
				<input class="form-control" type="text" name="dbhost" required placeholder="Database Host"/>
				<br/>
				<input type="text" required name="dbuser" placeholder="Database User" class="form-control" />
				<br/>
				<input type="password" name="dbpass" placeholder="Database Password" class="form-control" />
				<br/>
				<input type="text" class="form-control" name="dbname" required placeholder="Database Name"/>
				<br/>
				<h5>App Details</h5>
				<br/>
				<input type="text" name="appname" placeholder="App Name (Default : Permit System)" class='form-control'/>
				<br/>
				<input type="text" name="tableprefix" placeholder="Table Prefix (Default : permit_)" class='form-control'/>
				<br/>
				<input type="email" name="appemail" placeholder="App Email" class='form-control' required/>
				<br/>
				<h5>Admin Details</h5>
				<br/>
				<input type="text" name="adminname" placeholder="Admin Username" class='form-control' required/>
				<br/>
				<input type="password" name="adminpass" placeholder="Admin Password" class='form-control' required/>
				<br/>
				<input type="email" name="adminemail" placeholder="Admin Email" class='form-control' required/>
				<br/>

				<button type="submit" class="btn btn-primary">Install</button>
			</form>
		</div>
	</div>
</body>
</html>