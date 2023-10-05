<?php
    // Function for sql queries
    include_once 'query_on_role.php';

    // Function for saving form details in the session array
    include_once 'save_data_on_role.php';

    // Start a session so previous form details are saved at the next form
    session_start();

    // If the form submit method is post 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the link of the webpage from where signup.php was directed to
        $referrer = $_SERVER['HTTP_REFERER'];

        // If the previous login page is the signup page
        if (substr($referrer, -11) === "signup.html" || substr($referrer, -47) === "signup.html?alert=That+username+already+exists.") {

            // Set the session variable role so it won't be lost between scripts
            $_SESSION['role'] = $_POST['select_role'];

            // Check for the rola and direct the user to the relevant page
            switch ($_SESSION['role']) {
                case 'patient':
                    header("Location: signup_patient_0.html");
                    break;
                case 'doctor':
                    header("Location: signup_doctor_0.html");
                    break;
                case 'insurance_agent':
                    header("Location: signup_insurance_agent_0.html");
                    break;
                case 'healthcare_provider':
                    header("Location: signup_healthcare_provider.html");
                    break;
                case 'broker':
                    header("Location: signup_broker_0.html");
                    break;
                default:
                    echo "Invalid Role A.";
            }
        } else {

            // If signup page wasn't the previous page, 
            if (isset($_SESSION['role'])) {
                save_data($referrer);

                if(isset($_SESSION['hiddenField'])){
                    my_query($_SESSION['role']);
                    header("Location: login.html");
                    session_destroy();
                }
            } else {
                echo "Invalid Role.";
            }
        }
    }
?>