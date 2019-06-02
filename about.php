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
				echo "About - ".$config['appname'];
			else
				echo "About - Permit System";
		?>
	</title>
	<?php
		require_once('inc/styles.html');
	?>
</head>
<body>
	<div class="container-fluid" id="root">
		<!-- Enter Your Own About Text Here -->
		<div class="aboutpage main">
			<?php include './header.php'; ?>
			<div class="about">
				<h2>About</h2>
				<div align="center">
					<img src="./files/natureimage.png" class="img" />
					<br/>
				</div>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Etiam sit amet nisl purus in. Sagittis aliquam malesuada bibendum arcu vitae. Purus viverra accumsan in nisl nisi. Et odio pellentesque diam volutpat. Pretium fusce id velit ut. Id interdum velit laoreet id. Ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a. Est sit amet facilisis magna etiam tempor orci. Sit amet dictum sit amet. Eget duis at tellus at. Vestibulum morbi blandit cursus risus. Lectus nulla at volutpat diam.
				</p>

				<p>
					Molestie at elementum eu facilisis sed odio morbi. Ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Aliquam faucibus purus in massa tempor nec feugiat nisl pretium. Sit amet tellus cras adipiscing enim. Eget est lorem ipsum dolor sit amet consectetur adipiscing elit. Pulvinar elementum integer enim neque volutpat ac. Interdum velit laoreet id donec ultrices tincidunt arcu non sodales. Fermentum iaculis eu non diam phasellus vestibulum lorem sed risus. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Velit dignissim sodales ut eu sem integer vitae justo.
				</p>

				<p>
					Quam id leo in vitae turpis massa sed. Commodo nulla facilisi nullam vehicula. Morbi tristique senectus et netus et malesuada fames ac. Sed sed risus pretium quam vulputate. Ut etiam sit amet nisl purus in. Diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Facilisi etiam dignissim diam quis. Pharetra massa massa ultricies mi quis hendrerit. Fringilla ut morbi tincidunt augue. Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Nisi est sit amet facilisis magna etiam tempor orci eu. Integer feugiat scelerisque varius morbi enim. Scelerisque viverra mauris in aliquam sem fringilla. Sit amet aliquam id diam.
				</p>

				<p>
					Ut tristique et egestas quis ipsum. Aliquam nulla facilisi cras fermentum odio eu feugiat pretium nibh. Ullamcorper eget nulla facilisi etiam. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo. Faucibus in ornare quam viverra. Sed adipiscing diam donec adipiscing tristique. Scelerisque eleifend donec pretium vulputate sapien. Amet venenatis urna cursus eget nunc. A cras semper auctor neque vitae tempus quam pellentesque. In cursus turpis massa tincidunt dui ut. In tellus integer feugiat scelerisque. Non nisi est sit amet facilisis magna. Mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget. Vitae turpis massa sed elementum tempus egestas sed. Nullam ac tortor vitae purus faucibus ornare suspendisse sed.
				</p>

				<div align="center">
					<a href="./"><button class="btn btn-primary">Home</button></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>