<?php
	// API to fetch all the further dates permits are open for.

	require_once('./adminchecker.php');
	require_once('./config.php');

	if(!$_SESSION['permitisadmin'] || !$_SESSION['permituserid']){
		echo "[{
			\"status\":401
		}]";	// Unauthorised

		exit();
	}

	$toady = date("Y-m-d");

	$query = "SELECT * FROM ".$config['tableprefix']."pdates WHERE pdate >= '".$today."'";

	$queryob = "";

	try{
		$queryob = $db->query($query);
	}
	catch(Exception $e){
		echo "{\"status\":501}";	// Some internal server error.
		exit();
	}

	$numrows = $db->numrows($queryob);

	if($numrows <= 0){
		echo "{\"status\":200,
				\"numrows\":0}";
	}
	else{
		$number = 0;

		echo "{\"status\":200,\"numrows\":".$numrows.",\"dates\":[";
				
		while($date = $db->fetch($queryob)){
			// Printing all fields per application.
			echo '{
				"pdate":"'.$date['pdate'].'",
				"npermits":'.$date['npermits'].'
			}';

			if($number < $numrows - 1 && $numrows != 1){
				// Add a comma in case there are more applications.
				// And the number of applications is not one, in that case, there is no need for a comma.
				echo ",";
			}

			$number++;
		}

		echo "]}";
	}
?>