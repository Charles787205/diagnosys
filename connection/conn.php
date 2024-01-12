<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$db_name = "diagnosticlab";
	
	$conn = mysqli_connect(
		$hostname, $username,
		$password, $db_name
	);
	
	if (!$conn) {
		die("Database connection failed: " . mysqli_connect_error());
	} else {
		// Connection successful
	}
	

?>