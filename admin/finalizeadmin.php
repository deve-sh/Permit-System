<?php
	session_start();
	require_once('./adminchecker.php');
	require_once('./config.php');

	require_once('../inc/salt.php');

	if(!$_SESSION['permitisadmin'] || !$_SESSION['permituserid']){
		header("refresh:0;url=./login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Creating Admin ... </title>
	<?php include '../inc/adminstyles.html'; ?>
</head>
<body>
	<?php
		$username = $db->escape($_POST['username']);
		$email = $db->escape($_POST['email']);
		$password = $db->escape($_POST['password']);

		// First checking if the user entered everything.

		if($username && $email && $password){
			// Now checking if the user already exists.

			if($db->numrows(
				$db->query("SELECT * FROM ".$config['tableprefix']."padmins where username = '".$username."' OR email = '".$email."'")
			) > 0){
				echo "<br>A user with the given details already exists. Kindly try again.<br>Redirecting to previous page.";
				header("refresh:2;url=./addadmin.php");
				exit();
			}
			else{
				// Preparing for insertion.

				// Generating a salt.

				$salt = saltgen();

				// Hashing password.

				$password = crypt($password,$salt);

				$password = md5($password);

				// Insertion Query

				$insertionquery = "INSERT INTO ".$config['tableprefix']."padmins(username, password, salt, email) VALUES('".$username."','".$password."','".$salt."','".$email."')";

				if($db->query($insertionquery)){
					echo "<br>Admin with the details created.<br> Redirecting to dashboard.";
					header("refresh:2;url=./");
					exit();
				}
				else{
					echo "<br>Could not complete the process due to a database error.<br>";
					header("refresh:2;url=./addadmin.php");
					exit();
				}
			}
		}
		else{
			echo "<br>Not enough information passed.<br>";
			header("refresh:2;url=./addadmin.php");
			exit();
		}
	?>
</body>
</html>