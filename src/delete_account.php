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

    $query = "DELETE FROM $role WHERE username = '$username'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Deletion successful
        session_destroy();
        header("Location: Home.html");
    } else {
        // Deletion failed
        header("Location: Home.html");
    }

    // Close the database connection
    mysqli_close($connection);
    exit();
?>