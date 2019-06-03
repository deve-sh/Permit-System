<?php
session_start();
// Admin Header Bar
?>
<div class="header">
	<div class="headercontainer row">
		<div class="column col-10">
				<span class='title'>
					<?php
						if(isset($config['appname']))
							echo $config['appname'];
						else
							echo "Permit System";
					?>
				</span>
		</div>
		<div class="column col-2 rightcol">
			<a href="../">Home</a>

			<?php
				if($_SESSION['permitisadmin'] == true && $_SESSION['permituserid']){
					?>
						&nbsp;
						<a href="./logout.php"><i class="fas fa-door-open"></i></a>
					<?php
				}
			?>
		</div>
	</div>
</div>