<?php
session_start();

require_once('./inc/checker.php');
require_once('./inc/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
			if(isset($config['appname']))
				echo "Contact - ".$config['appname'];
			else
				echo "Contact - Permit System";
		?>
	</title>
	<?php
		require_once('inc/styles.html');
	?>
</head>
<body>
	<div class="container-fluid" id="root">
		<!-- Enter Your Own About Text Here -->
		<div class="aboutpage main">	<!-- Visual Style same as the About Page -->
			<?php include './header.php'; ?>
			<div class="about">
				<h2>Contact Us</h2>

				<div class="row">
					<div class="col-sm-6">
						<div align="center">
							<img src="./files/contact_us.png" class="colimg" />
							<br/>
						</div>
					</div>
					<div class="col-sm-6">
						<!-- Add your Contact Details Here -->
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Etiam sit amet nisl purus in. Sagittis aliquam malesuada bibendum arcu vitae. Purus viverra accumsan in nisl nisi. Et odio pellentesque diam volutpat. Pretium fusce id velit ut. Id interdum velit laoreet id. Ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a. Est sit amet facilisis magna etiam tempor orci.
						</p>
					</div>
				</div>
				<br/><br/>
				<!-- Contact Options Tray -->

				<div class="contacttray">
					<div class="row">
						<div class="col-md-4">
							<div class="contacttile" align="center">
								<i class="fas fa-phone fa-3x phoneicon"></i><br/><br/> +91 - 1234567890
							</div>
						</div>
						<div class="col-md-4">
							<div class="contacttile" align="center">
								<i class="fas fa-envelope fa-3x emailicon"></i><br/><br/> permits@permits.com
							</div>
						</div>
						<div class="col-md-4">
							<div class="contacttile" align="center">
								<i class="fab fa-whatsapp fa-3x whatsappicon"></i><br/><br/> +91 - 9876543210
							</div>
						</div>
					</div>
				</div>
				<br/>
				<div align="center">
					<a href="./"><button class="btn btn-primary">Home</button></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>