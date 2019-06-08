<?php
session_start();
// Admin Header Bar
?>
<div class="header">
	<div class="headercontainer row">
		<div class="column col-7">
				<span class='title'>
					<?php
						echo "<a href='./'>Admin Panel</a>";
					?>
				</span>
		</div>
		<div class="column col-5 rightcol">
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