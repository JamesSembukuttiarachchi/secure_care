<?php
	// Start the connection to the database server
	include_once 'config.php';

	// Start the session so the login credentials are saved through multiple pages
	// will be used to access the portal at some point
	session_start();

	// Select the relevant database
	mysqli_select_db($connection, $database);

	// Save the details from the form submission
	$user = $_POST["user"];
	$pass = $_POST["_password"];
	$role = $_POST["select_role"];
	$remember = isset($_POST["save_details"]) ? $_POST["save_details"] : "";

	/* Save details for the portal */
	$_SESSION["user"] = $user;
	$_SESSION["_password"] = $pass;
	$_SESSION["role"] = $role;

	// Create and execute the query 
	$query = "SELECT * FROM $role WHERE username = '$user'";
	$result = mysqli_query($connection, $query);

	// Get the corresponding row of the selected username
	$row = mysqli_fetch_assoc($result);

	// Get the user id to be used in the faq
	if ($role == "patient") {
		$_SESSION["user_id"] = $row["patient_id"];
		$_SESSION["first_name"] = $row["first_name"];
		$_SESSION["last_name"] = $row["last_name"];
		$_SESSION["email"] = $row["email"];
	} elseif ($role == "doctor") {
		$_SESSION["user_id"] = $row["doctor_id"];
		$_SESSION["first_name"] = $row["first_name"];
		$_SESSION["last_name"] = $row["last_name"];
		$_SESSION["email"] = $row["email"];
		$_SESSION["hospital"] = $row["hospital"];
	} elseif ($role == "broker") {
		$_SESSION["user_id"] = $row["broker_id"];
		$_SESSION["first_name"] = $row["first_name"];
		$_SESSION["last_name"] = $row["last_name"];
		$_SESSION["email"] = $row["email"];
	} elseif ($role == "insurance_agent") {
		$_SESSION["user_id"] = $row["employee_id"];
		$_SESSION["first_name"] = $row["first_name"];
		$_SESSION["last_name"] = $row["last_name"];
		$_SESSION["email"] = $row["company_email"];
		$_SESSION["company_name"] = $row["company_name"];
	} elseif ($role == "healthcare_provider") {
		$_SESSION["user_id"] = $row["company_reg_no"];
		$_SESSION["company_name"] = $row["company_name"];
		$_SESSION["email"] = $row["company_email"];
	}

	// Check if the query results are true
	if (mysqli_num_rows($result) == 1) {
		// Get the password saved inside the server database to pair with the user entered password
		$_passwordFromDB = $row['_password'];

		if ($pass == $_passwordFromDB) {
			// Check if "save_details" checkbox is checked
			if ($remember) {
				// Set cookies with the login details
				setcookie("user", $user, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
				setcookie("_password", $pass, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
			} else {
				// Delete any existing cookies
				setcookie("user", "", time() - 3600, "/"); // Set expiry time in the past
				setcookie("_password", "", time() - 3600, "/"); // Set expiry time in the past
			}

			// If passwords match, redirect to the homepage
			header("Location: Home.html");
			$_SESSION["logged_in"] = true;
		} else {
			// If the password is invalid, prompt to re-enter
			echo "<script> alert('Invalid Password.') </script>";
			header("Location: login.html");
		}
	} else {
		// If no user with the entered name is found, print an error
		echo "No user with the corresponding name has been found.";
		session_destroy();
		header("Location: login.html");
	}

	// Table name to be deleted
	$tableName = "cart";

	// Check if the table exists
	$checkTableQuery = "SHOW TABLES LIKE '$tableName'";
	$result = mysqli_query($connection, $checkTableQuery);

	if (mysqli_num_rows($result) == 1) {
		// Table exists, delete it
		$dropTableQuery = "DROP TABLE $tableName";
		mysqli_query($connection, $dropTableQuery);
		echo "Table $tableName has been deleted.";
	} else {
		echo "Table $tableName does not exist.";
	}

	// Close the database connection
	mysqli_close($connection);
	exit();
?>