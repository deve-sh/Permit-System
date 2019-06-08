<?php
	session_start();
	require_once('../inc/installchecker.php');
	require_once('../inc/connect.php');		// Database Driver
	require_once('../inc/salt.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Installing ...</title>
	<?php include '../inc/installstyles.html'; ?>
</head>
<body>
	<div id="root" class="container-fluid installpage">
		<div align="center">
			<div id="installform">
				<h3>Installing</h3>
				<?php
					// Let's start Installing

					// Creating a configuration array.

					$config = array(
						'dbhost' 		=> $_POST['dbhost'],
						'dbuser' 		=> $_POST['dbuser'],
						'dbpass' 		=> $_POST['dbpass'],
						'dbname' 		=> $_POST['dbname'],
						'appname'		=> $_POST['appname'],
						'appemail'		=> $_POST['appemail'],
						'tableprefix'	=> $_POST['tableprefix'],
						'adminname'		=> $_POST['adminname'],
						'adminpass'		=> $_POST['adminpass'],
						'adminemail'	=> $_POST['adminemail']
					);

					// Setting the autosetting fields if they were not entered.

					if(!$config['tableprefix']){
						$config['tableprefix'] = "permit_";
					}

					if(!$config['appname']){
						$config['appname'] = "Permit System";
					}

					// Checking if the user has entered everything.

					foreach ($config as $key => $value) {
						// Escaping for malicious attacks.
						
						$config[$key] = escapestr($config[$key]);

						if(strcmp($key,'dbpass')!=0){	// Data base password can be empty
							if(!$config[$key]){
								echo "<br>Insufficient data passed.<br>";
								header("refresh:2;url=./");
								exit();
							}
						}
					}

					// Now checking if the database details were correct.

					$db = new dbdriver();	// Creating a new dbdriver object.

					if(!$db->connect($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname'])){
						echo "<br>Invalid Database Credentials.";
						header("refresh:2;url=./");
						exit();
					}

					// Hashing the Admin Passwords.

					$salt = escapestr(saltgen());	// Generate a random salt.

					$config['adminpass'] = escapestr(crypt($config['adminpass'],$salt));
					$config['adminpass'] = escapestr(md5($config['adminpass']));	// Double Protection.

					// Now creating queries for insertion of details and creation of tables.

					$queries = [
						"DROP TABLE IF EXISTS ".$config['tableprefix']."pdates;",
						"DROP TABLE IF EXISTS ".$config['tableprefix']."permits;",
						"DROP TABLE IF EXISTS ".$config['tableprefix']."padmins;",
						"CREATE TABLE ".$config['tableprefix']."pdates(pdate date primary key, npermits integer check (npermits>0));",
						"CREATE TABLE ".$config['tableprefix']."permits(permitid bigint primary key auto_increment, vehicle_no varchar(255) not null, applicant_name text not null, applicant_email varchar(255) not null, applicant_phone bigint not null, approved boolean default 0, pdate date references pdates(pdate) on delete cascade on update set null, appl_time timestamp, visited boolean default 0);",
						"CREATE TABLE ".$config['tableprefix']."padmins(userid integer primary key auto_increment, username varchar(255) unique not null, password varchar(255) not null, salt varchar(245) not null default '$51@$%1$+', email varchar(255) unique not null);",
						"INSERT INTO ".$config['tableprefix']."padmins(username,password,salt,email) VALUES('".$config['adminname']."','".$config['adminpass']."','".$salt."','".$config['adminemail']."')"
					];

					// Messages to display while execution of queries.

					$messages = [
						"Dropping Permit Dates Master Table if it exists.",
						"Dropping Permits Table if it exists.",
						"Dropping Admins Table if it exists.",
						"Creating a permit date master table.",
						"Creating a permits table.",
						"Creating an admins table.",
						"Inserting Admin Details."
					];

					// Errors in case something goes wrong.

					$errors = [
						"Could not drop Permits master table.",
						"Could not drop Permits table.",
						"Could not drop Admins table.",
						"Could not create a permit date master table.",
						"Could not create a permits table.",
						"Could not create an admins table.",
						"Could not insert admin details."
					];

					// Counter Variable

					$i = 0;

					// Starting Installation

					for(;$i<sizeof($queries);$i++){
						echo "<br><br>";
						echo $messages[$i];

						if(!$db->query($queries[$i])){
							echo "<br><br><label class='label error'>".$errors[$i]."</label>";
							header("refresh: 2;url=./index.php");
							exit();
						}
					}

					// Writing the files for verification of installation.

					$configstring = "<?php\nerror_reporting(0);\n";
					$adminconfigstring = "<?php\nerror_reporting(0);\n";

					foreach ($config as $key => $value) {
						if(!strstr($key, "admin")){	
							// Not inserting Admin Details by mistake.
							$configstring .= "\t\$config['{$key}'] = '{$value}';\n";
							$adminconfigstring .= "\t\$config['{$key}'] = '{$value}';\n";
						}
					}

					$configstring .= "\tinclude('./inc/connect.php');\n\t\$db = new dbdriver();";
					$adminconfigstring .= "\tinclude('../inc/connect.php');\n\t\$db = new dbdriver();";

					$configstring .= "\n\t\$db->connect(\$config['dbhost'],\$config['dbuser'],\$config['dbpass'],\$config['dbname']);\n?>";

					$adminconfigstring .= "\n\t\$db->connect(\$config['dbhost'],\$config['dbuser'],\$config['dbpass'],\$config['dbname']);\n?>";



					// Opening and writing to files.

					$filename1 = "../inc/config.php";
					$filename2 = "../inc/lock";
					$filename3 = "../admin/config.php";

					$file1 = "";
					$file2 = "";
					$file3 = "";

					try {
						$file1 = fopen($filename1, "w");
						$file2 = fopen($filename2, "w");	
						$file3 = fopen($filename3, "w");
					} catch (Exception $e) {
						echo $e;
						exit();
					}

					try{
						// Finally Writing.

						echo "<br><br>Writing Configuration and Confirmation Files.";

						fwrite($file1, $configstring);
						fwrite($file3, $adminconfigstring);
						fwrite($file2, "1");
					}
					catch(Exception $e){
						echo $e;
						exit();
					}

					// If after all this, no error is present. Then the installation is successful.

					echo "<br><br><b>Installation Successful!</b><br>";

					echo "<br><a href='../index.php'><button class='btn btn-success successinstall'>Go see your app.</button></a>";

				?>
			</div>
		</div>
	</div>
</body>
</html>