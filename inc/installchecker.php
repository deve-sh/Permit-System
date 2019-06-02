<?php
	// File to check if the script is already installed for the /install route.

	$filename1 = "../inc/lock";
	$filename2 = "../inc/config.php";

	$file1 = fopen($filename1, "r");
	$file2 = fopen($filename2, "r");

	$string1 = fread($file1, filesize($filename1));
	$string2 = fread($file2, filesize($filename2));

	if($string1[0] != '0' && $string2[0] != '0'){
		// Meaning the script is already installed.

		header("refresh:0;url=../");	// Redirect to home.
		exit();
	}
?>