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
	<title>All Applications - Admin CP</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<div class="main adminloginpage allapplicationspage">
		<?php include './header.php'; ?>

		<div align="center" class = "formcontainer">
			<form onsubmit="setDate(event)" class="adminloginform" align='left' method="POST">
				<h3>All Applications</h3>
				<br/>
				<label for="date">Date</label> : <br/>
				<input type="date" name="date" id="date" class="form-control" required/>
				<br/>
				<button type="submit" class="btn proceed btn-primary">Set Date</button>
				<br/><br/>
				<a href="./"><div class="btn proceed btn-danger">Back to Admin CP</div></a>
			</form>
			<hr/>
			<div id="applications">
				<!-- To be filled in with JavaScript post an XML Http Request -->
			</div>
		</div>
	</div>

	<!-- Scripts to add interactivity -->
	<script type="text/javascript" src="../js/adminRequestMaker.js"></script>
</body>
</html>