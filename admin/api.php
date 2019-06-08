<?php
	// PHP File for API Usage with React or front end components.

	require_once('./adminchecker.php');
	require_once('./config.php');

	if(!$_SESSION['permitisadmin'] || !$_SESSION['permituserid']){
		echo "[{
			\"status\":401
		}]";	// Unauthorised

		exit();
	}

	function JSONPrinter($querystring){
		// A function to retreive/fetch data from a query string and then print it in JSON Format. Since, there are two cases in which the process has to be repeated. Hence, using a function to reduce the amount of repetition of code.

		global $db;		// Functions operate on a local scope, hence reminding the function that the var $db is a global database driver.

		if($querystring){

			$queried = "";

			try{
				$queryob = $db->query($querystring);
			}
			catch(Exception $e){
				echo "{\"status\":500}";	// Some internal server error.
				exit();
			}

			if($db->numrows($queryob) <= 0){
				echo "{\"status\":200,\"numrows\":0}";
			}
			else{
				$numrows = $db->numrows($queryob);
				$number = 0;	// Variable to keep track of current application.

				// Printing JSON.

				echo "{\"status\":200,\"numrows\":".$numrows.",\"applications\":[";
				
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
				echo "]}";
			}
		}
		else{
			echo '{"status":404}';	// Nothing found if nothing passed.
		}
	}

	$date = $db->escape($_GET['date']);

	if(!$date){
		// Return a dump of all the applications of the upcoming days.

		$today = date("Y-m-d");

		$query = "SELECT * FROM ".$config['tableprefix']."permits WHERE pdate >= '".$today."'";

		JSONPrinter($query);
	}
	else{
		// If date has been passed.

		// Print all the applications that have been applied for on that particular date.

		$query = "SELECT * FROM ".$config['tableprefix']."permits WHERE pdate = '".$date."'";

		JSONPrinter($query);		
	}
?>