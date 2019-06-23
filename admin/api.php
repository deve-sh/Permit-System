<?php
	// PHP File for API Usage with Front End JS.
	// Now with support for pagination.

	require_once('./adminchecker.php');
	require_once('./config.php');

	if(!$_SESSION['permitisadmin'] || !$_SESSION['permituserid']){
		echo "{\"status\":401, \"error\" : \"Internal Server Error.\"}";	// Unauthorised

		exit();
	}

	$date = $db->escape($_GET['date']);

	$offset = $db->escape($_GET['page']);	// Offset from page number.

	$previous = false;	// Variable to return in case there are previous logs.

	$next = false;		// Variable to return in case there are further logs.

	$totallogs = "";
	$rowsperpage = 10;
	$number = 0;

	$today = date("Y-m-d");

	if(!$offset){
		$offset = 1;
	}

	$superquery = "SELECT * FROM ".$config['tableprefix']."permits";	// Query for calculating the number of logs in total compared to where we are right now.

	$query = $superquery;

	$query .= ($date)?" WHERE pdate = '$date'":" WHERE pdate >= '$today'";

	$query .= (" LIMIT $rowsperpage OFFSET ".(($offset - 1) * $rowsperpage)." ;");

	try{
		$totallogs = $db->numrows($db->query($superquery));
	}
	catch(Exception $e){
		echo "{\"status\":500, \"error\" : \"Internal Server Error.\"}";
		exit();
	}

	if($offset * $rowsperpage > $rowsperpage){
		$previous = true;
	}

	if($offset * $rowsperpage < $totallogs){
		$next = true;	// More logs remaining.
	}

	$queryob = $db->query($query);

	$numrows = $db->numrows($queryob);

	echo "{\"status\":200,\"numlogs\":$numrows,\"applications\":[";;

	while($application = $db->fetch($queryob)){
		// Printing all fields per application.

		echo '{
			"permit_id":'.$application['permitid'].',
			"applicant_name":"'.$application['applicant_name'].'",
			"vehicle_no":"'.$application['vehicle_no'].'",
			"applicant_email":"'.$application['applicant_email'].'",
			"applicant_phone":"'.$application['applicant_phone'].'",
			"approved":'.$application['approved'].',
			"pdate":"'.$application['pdate'].'",
			"appl_time":"'.$application['appl_time'].'",
			"visited":'.$application['visited'].'
		}';

		if($number < $numrows - 1 && $numrows != 1){
			// Add a comma in case there are more applications.
			// And the number of applications is not one, in that case, there is no need for a comma.
			echo ",";
		}

		$number++;
	}

	$previous = ($previous)?"true":"false";
	$next = $next?"true":"false";

	echo "],\"previous\": ".$previous.",\"next\":".$next."}";
?>