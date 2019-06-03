<?php
	// Logout Admin.
	// Doesn't matter if anyone is logged in or not. Just Do It!

	session_start();

	require_once('./adminchecker.php');
	require_once('./config.php');

	$_SESSION['permitisadmin'] = false;
	$_SESSION['permituseradmin'] = false;

	header("refresh:0;url=./");
	exit();
?>