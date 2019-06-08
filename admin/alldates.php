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
	<title>All Openings - Admin CP</title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body onload='renderDates()'>
	<div class="main adminloginpage allopeningspage">
		<?php include './header.php'; ?>
		<div class="formcontainer">
			<h3>All Openings</h3>
			<div id="dates">
				<!-- To be filled in with JS -->
			</div>
			<br/>
			<div align="center"><a href='./' title='Back to Admin CP' class='btn btn-info'>Back to Admin CP</a></div>
		</div>
	</div>

	<script type="text/javascript" src="../js/adminOpenings.js"></script>
	<script type="text/javascript" src="../js/adminActionMaker.js"></script>
</body>
</html>