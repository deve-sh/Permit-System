<?php
session_start();
// Admin Header Bar
?>
<div class="header">
	<div class="headercontainer row">
		<div class="column col-8">
				<span class='title'>
					<?php
						echo "Admin Panel";
					?>
				</span>
		</div>
		<div class="column col-4 rightcol">
			<a href="../">Home</a>

			<?php
				if($_SESSION['permitisadmin'] == true && $_SESSION['permituserid']){
					?>
						&nbsp;&nbsp;&nbsp;
						<a href="./logout.php"><i class="fas fa-door-open fa-lg"></i></a>
					<?php
				}
			?>
		</div>
	</div>
</div>