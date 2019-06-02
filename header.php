<!-- Modularized Header Component -->

<!-- Sidenav -->
<div id="sidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="./apply.php">Apply</a>
  <a href="./about.php">About</a>
  <a href="./viewstatus.php">View Status</a>
  <a href="./admin">Admin</a>
  <a href="./contact.php">Contact</a>

  <br>

  <div align="center"><div class="bar"></div></div>

  <br/>
  ❤ <a href='https://deve-sh.github.io/' target="_blank">Devesh Kumar</a>
</div>

<div class="header">
	<div class="row headercontainer">
		<div class="column col-10">
			<a href='./'>
				<span class='title'>
					<?php
						if(isset($config['appname']))
							echo $config['appname'];
						else
							echo "Permit System";
					?>
				</span>
			</a>
		</div>

		<div class="column col-2 rightcol">
			<span onclick="openNav()"><i class="fas fa-bars fa-lg" style="cursor: pointer;"></i></span>
		</div>
	</div>
</div>

<!-- Script for sidenav -->

<script type="text/javascript" src="./js/sidenavScript.js"></script>