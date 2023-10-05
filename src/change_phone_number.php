<?php
    include_once 'config.php';
    
    // Assuming you have already started the session
    session_start();

    // Retrieve the current username from the session
    $user = $_SESSION["user"];

    // Validate the input value (numberValue)
    if (isset($_POST["numberValue"])) {
        $numberValue = $_POST["numberValue"];
    } else {
        // Handle the case when the numberValue is not set
        header("Location: patientportal.html?user=" . urlencode($user));
        exit("Invalid input");
    }

    mysqli_select_db($connection, $database);

    // Prepare the SQL statement to update the contact_number field
    $sql = "UPDATE patient SET contact_number = '$numberValue' WHERE username = '$user'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the query was successful
    if ($result) {
        header("Location: patientportal.html?user=" . urlencode($user));
    } else {
        header("Location: patientportal.html?user=" . urlencode($user));
    }

    // Close the database connection
    mysqli_close($connection);
?>