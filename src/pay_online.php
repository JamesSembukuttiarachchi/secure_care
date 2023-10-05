<?php
	include_once 'config.php';

	mysqli_select_db($connection, $database);

	session_start();

	if($_SERVER["REQUEST_METHOD"] === 'POST'){
		$_SESSION["select"] = $_POST['select'];
		$_SESSION["input"] = $_POST['input'];

		if(isset($_SESSION["select"])){
			if($_SESSION["select"] === 'user'){
				$input = mysqli_real_escape_string($connection, $_SESSION['input']); // Escape the input to prevent SQL injection
				$query = "SELECT * FROM patient WHERE username = '{$input}';";
			}
			else if($_SESSION["select"] === 'contact_number'){
				$input = mysqli_real_escape_string($connection, $_SESSION['input']); // Escape the input to prevent SQL injection
				$query = "SELECT * FROM patient WHERE contact_number = '{$input}';";
			}
		}

		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($result);

		if($_SESSION["select"] === 'user'){
			$user = $_SESSION["input"];
			$contact_number = $row["contact_number"];
		}
		else if($_SESSION["select"] === 'contact_number'){
			$user = $row["username"];
			$contact_number = $_SESSION["input"];
		}

		// URL-encode the variables
		$user = urlencode($user);
		$contact_number = urlencode($contact_number);

		// Construct the URL with the variables as query parameters
		$url = "pay_online_2.html?user=$user&contact_number=$contact_number";

		// Redirect to the specified URL
		header("Location: $url");
		exit();
	}
?>