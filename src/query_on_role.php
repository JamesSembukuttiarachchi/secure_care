<?php

/*		Determines the SQL query depending on the role of the user choice		*/

	function my_query($select_role){
		// Establish a connection with the database
		include_once 'config.php';

		// Create a connection to the database
		mysqli_select_db($connection, $database);

		$query = "";

		// Query for existing username
		$check = "SELECT * FROM $select_role WHERE username = '{$_SESSION['user']}'";

		// Run the query to check for existing usernames
		$check_results = mysqli_query($connection, $check);

		// Check if the row count is greater than 0
		$row_count = mysqli_num_rows($check_results);
		if ($row_count > 0) {
			$alertMessage = "That username already exists.";
			header("Location: signup.html?alert=" . urlencode($alertMessage));
			die();
		}


		// Construct the query according to the role
		if($select_role == 'patient'){
			$query = "INSERT INTO patient (patient_id, username, _password, first_name, last_name, email, age, gender, contact_number, _address)
				VALUES ('', '{$_SESSION['user']}', '{$_SESSION['_password']}', '{$_SESSION['first_name']}', '{$_SESSION['last_name']}', '{$_SESSION['email']}', '{$_SESSION['age']}', '{$_SESSION['gender']}', '{$_SESSION['contact_number']}', '{$_SESSION['_address']}')";
		}
		else if($select_role == 'doctor'){
			$query = "INSERT INTO doctor (doctor_id, username, _password, first_name, last_name, email, DIN, specialization, hospital, contact_number, _address)
				VALUES ('', '{$_SESSION['user']}', '{$_SESSION['_password']}', '{$_SESSION['first_name']}', '{$_SESSION['last_name']}', '{$_SESSION['email']}', '{$_SESSION['din']}', '{$_SESSION['specialization']}', '{$_SESSION['hospital']}', '{$_SESSION['contact_number']}', '{$_SESSION['_address']}')";
		}
		else if($select_role == 'insurance_agent'){
			$query = "INSERT INTO insurance_agent (employee_id, company_reg_no, company_name, company_email, first_name, last_name, contact_number, branch, username, _password)
				VALUES ('', '{$_SESSION['employee_id']}', '{$_SESSION['company_reg_no']}', '{$_SESSION['company_name']}', '{$_SESSION['company_email']}', '{$_SESSION['first_name']}', '{$_SESSION['last_name']}', '{$_SESSION['contact_number']}', '{$_SESSION['branch']}', '{$_SESSION['user']}', '{$_SESSION['_password']}')";
		}
		else if($select_role == 'healthcare_provider'){
			$query = "INSERT INTO healthcare_provider (company_reg_no, company_name, company_email, username, _password)
				VALUES ('{$_SESSION['company_reg_no']}', '{$_SESSION['company_name']}', '{$_SESSION['company_email']}', '{$_SESSION['user']}', '{$_SESSION['_password']}')";
		}
		else if($select_role == 'broker'){
			$query = "INSERT INTO broker (broker_id, username, _password, email, first_name, last_name, contact_number, age, _address)
				VALUES ('', '{$_SESSION['user']}', '{$_SESSION['_password']}', '{$_SESSION['email']}', '{$_SESSION['first_name']}', '{$_SESSION['last_name']}', '{$_SESSION['contact_number']}', '{$_SESSION['age']}', '{$_SESSION['_address']}')";
		}

		// Execute the query
		$result = mysqli_query($connection, $query);

		// Check for the succession of the query
		if (!$result) {
			echo "Error: " . mysqli_error($connection);
			exit();
		} else {
			echo "Success";
		}

		// Close the database connection
		mysqli_close($connection);
	}
?>