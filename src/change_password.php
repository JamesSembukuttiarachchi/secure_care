<?php
    include_once 'config.php';

    mysqli_select_db($connection, $database);

    session_start();

    // Check if the user is logged in and has a role assigned
    if (!isset($_SESSION["role"])) {
        exit("Unauthorized access!");
    }

    // Get the role from the session
    $role = $_SESSION["role"];

    // Get the username from the session
    $username = $_SESSION["user"];

    if (isset($_POST["submitPass"])) {
        // Retrieve the submitted new password
        $newPassword = $_POST["new_password"];

        // Perform the password update query
        $query = "UPDATE $role SET _password = '$newPassword' WHERE username = '$username'";

        // Execute the query
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Password update successful
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        } else {
            // Password update failed
            header("Location: login.php");
            exit();
        }
    }

    // Close the database connection
    mysqli_close($connection);
?>