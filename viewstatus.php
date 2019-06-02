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
		</div>
	</div>

	
</body>
</html>