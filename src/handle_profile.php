<?php
	session_start();

	// Check if $_SESSION["logged_in"] is set and has a value
	if (isset($_SESSION["logged_in"])) {
		if($_SESSION["role"] == 'patient'){
			header("Location: patient_profile.php");
		}
		else if($_SESSION["role"] == 'doctor'){
			header("Location: doctor_profile.php");
		}
		else if($_SESSION["role"] == 'broker'){
			header("Location: broker_profile.php");
		}
		else if($_SESSION["role"] == 'healthcare_provider'){
			header("Location: healthcare_profile.php");
		}
		else if($_SESSION["role"] == 'insurance_agent'){
			header("Location: insuAg_profile.php");
		}
	} else {
		session_destroy();
		header("Location: login.html");
	}
?>