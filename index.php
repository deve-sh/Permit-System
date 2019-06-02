<?php
	session_start();					// Start a new session.
	require_once('inc/checker.php');
	require_once('inc/config.php');			// Configuration for the web app.
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
			if(isset($config['appname']))
				echo $config['appname'];
			else
				echo "Permit System";
		?>
	</title>
	<?php
		require_once('inc/styles.html');
	?>
</head>
<body>
	<div id='root' class='container-fluid'>
		<div class='indexone main'>
			<?php include './header.php'; ?>
			<div class="container">
				<div class='indexheading'>
					<?php
						if(isset($config['appname']))
							echo $config['appname'];
						else
							echo "Permit System";
					?>
				</div>
				<br/>
				<div align="center">
					<a href="./apply.php"><button class="button">Apply For a Permit</button></a>
				</div>
				<br/>
				<br/>
			</div>
		</div>
	</div>
</body>
</html>