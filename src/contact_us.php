<?php
    include_once 'config.php';
    session_start();

    mysqli_select_db($connection, $database);

    $referrer = $_SERVER["HTTP_REFERER"];
    $query = "";

    if(strpos($referrer, 'patientportal.html') !== false){
        $encodedUserId = urlencode($_SESSION["user_id"]);
        $encodedFirstName = urlencode($_SESSION["first_name"]);
        $encodedLastName = urlencode($_SESSION["last_name"]);
        $encodedEmail = urlencode($_SESSION["email"]);

        // Append the encoded session variables to the link
        $link = "contact_usP.html?user_id=$encodedUserId&first_name=$encodedFirstName&last_name=$encodedLastName&email=$encodedEmail&role=patient";

        // Redirect to the encoded link
        header("Location: $link");
        exit();
    }
    else if(strpos($referrer, 'contact_us') == true){
        $message = $_POST["message"];
        $query = "INSERT INTO contact_us (role, user_id, message) VALUES (?, ?, ?)";

        // Prepare the statement
        $statement = mysqli_prepare($connection, $query);

        // Bind the parameters
        mysqli_stmt_bind_param($statement, "sis", $_SESSION["role"], $_SESSION["user_id"], $message);

        // Execute the statement
        mysqli_stmt_execute($statement);

        // Close the statement
        mysqli_stmt_close($statement);

        $link = $referrer."&show_alert=1";
        header("Location: $link");
    }
    else {
        if (isset($_SESSION["role"])) {
            $encodedRole = urlencode($_SESSION["role"]);
        
            if ($encodedRole == "patient") {
                $encodedUserId = urlencode($_SESSION["user_id"]);
                $encodedFirstName = urlencode($_SESSION["first_name"]);
                $encodedLastName = urlencode($_SESSION["last_name"]);
                $encodedEmail = urlencode($_SESSION["email"]);

                // Append the encoded session variables to the link
                $link = "contact_usP.html?user_id=$encodedUserId&first_name=$encodedFirstName&last_name=$encodedLastName&email=$encodedEmail&role=$encodedRole";

                // Redirect to the encoded link
                header("Location: $link");
            } else if ($encodedRole == "doctor") {
                // Encode the session variables in the link
                $encodedUserId = urlencode($_SESSION["user_id"]);
                $encodedFirstName = urlencode($_SESSION["first_name"]);
                $encodedLastName = urlencode($_SESSION["last_name"]);
                $encodedEmail = urlencode($_SESSION["email"]);
                $encodedHospital = urlencode($_SESSION["hospital"]);

                // Append the encoded session variables to the link
                $link = "contact_usDoc.html?user_id=$encodedUserId&first_name=$encodedFirstName&last_name=$encodedLastName&email=$encodedEmail&hospital=$encodedHospital&role=$encodedRole";

                // Redirect to the encoded link
                header("Location: $link");
            } else if ($encodedRole == "insurance_agent") {
                // Encode the session variables in the link
                $encodedUserId = urlencode($_SESSION["user_id"]);
                $encodedFirstName = urlencode($_SESSION["first_name"]);
                $encodedLastName = urlencode($_SESSION["last_name"]);
                $encodedEmail = urlencode($_SESSION["email"]);
                $encodedCompanyName = urlencode($_SESSION["company_name"]);

                // Append the encoded session variables to the link
                $link = "contact_usInsPro.html?user_id=$encodedUserId&first_name=$encodedFirstName&last_name=$encodedLastName&email=$encodedEmail&company_name=$encodedCompanyName&role=$encodedRole";

                // Redirect to the encoded link
                header("Location: $link");
            } else if ($encodedRole == "broker") {
                $encodedUserId = urlencode($_SESSION["user_id"]);
                $encodedFirstName = urlencode($_SESSION["first_name"]);
                $encodedLastName = urlencode($_SESSION["last_name"]);
                $encodedEmail = urlencode($_SESSION["email"]);

                // Append the encoded session variables to the link
                $link = "contact_usP.html?user_id=$encodedUserId&first_name=$encodedFirstName&last_name=$encodedLastName&email=$encodedEmail&role=$encodedRole";

                // Redirect to the encoded link
                header("Location: $link");
            } else if ($encodedRole == "healthcare_provider") {
                // Encode the session variables in the link
                $encodedUserId = urlencode($_SESSION["user_id"]);
                $encodedCompanyName = urlencode($_SESSION["company_name"]);
                $encodedEmail = urlencode($_SESSION["email"]);

                // Append the encoded session variables to the link
                $link = "contact_usH.html?user_id=$encodedUserId&company_name=$encodedCompanyName&email=$encodedEmail&role=$encodedRole";

                // Redirect to the encoded link
                header("Location: $link");
            }
            exit();
        } else {
            header("Location: contact_usP.html");
            exit();
        }
    }

    mysqli_close($connection);
?>
