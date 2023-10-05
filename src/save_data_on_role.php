<?php
    // Function to take all the post values and put them in to the session array
	function get_data(){
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    // Function to call the get_data() function and check for password mismatches
    // Redirects to the next page in the relevant occasions
    function save_data($referrer){
        get_data();

        $_passwordError = "Error. Passwords do not match.";

        // Redirects to the next page according to the referrer
        $referrer = $_SERVER['HTTP_REFERER'];

        if (substr($referrer, -21) === 'signup_patient_0.html') {
            if ($_POST['_password'] !== $_POST['re_password']) {
                exit($_passwordError);
            } else {
                header("Location: signup_patient_1.html");
            }
        } elseif (substr($referrer, -20) === 'signup_doctor_0.html') {
            if ($_POST['_password'] !== $_POST['re_password']) {
                exit($_passwordError);
            } else {
                header("Location: signup_doctor_1.html");
            }
        } elseif (substr($referrer, -29) === 'signup_insurance_agent_0.html') {
            header("Location: signup_insurance_agent_1.html");
        } elseif (substr($referrer, -20) === 'signup_broker_0.html') {
            if ($_POST['_password'] !== $_POST['re_password']) {
                exit($_passwordError);
            } else {
                header("Location: signup_broker_1.html");
            }
        }
    }
?>