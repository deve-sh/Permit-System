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
	<div id="root" class="container-fluid">
		
		<?php
			if($_POST['permitid'] && $_POST['permitdate']){
				$permitid = $db->escape($_POST['permitid']);
				$pdate = $_POST['permitdate'];

				$query = "SELECT * FROM ".$config['tableprefix']."permits WHERE permitid = '".$permitid."' AND pdate = '".$pdate."'";

				if($db->numrows($db->query($query))==0){
					echo "<br>Nothing found.<br>";
				}
				else{
					$details = $db->fetch($db->query($query));

					// Printing details.

					
				}
			}
		?>
	</div>

	
</body>
</html>