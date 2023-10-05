<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "group project";
	
	// Create connection
	$connection = new mysqli($servername, $username, $password);
	
	// Check connection
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error."<br>x");
	}
?>