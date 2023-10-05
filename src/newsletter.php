<?php
    // Establish connection
    include_once 'config.php';

    mysqli_select_db($connection, $database);

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check which button was clicked
        if (isset($_POST['submit']) && $_POST['submit'] == 'subscribe') {
            // Process subscription
            echo "Subscribe called";
            $email = $_POST['email'];
            subscribeEmail($email);
            echo "Subscribe done";
            exit();
        } elseif (isset($_POST['submit']) && $_POST['submit'] == 'unsubscribe') {
            // Process unsubscription
            echo "unsubscribe called.";
            $email = $_POST['email'];
            unsubscribeEmail($email);
            echo "Unsubscribe done";
            exit();
        } else {
            echo "update called";
            $old = $_POST["old_email"];
            $email = $_POST["email"];
            updateEmail($old, $email);
            echo "Update successful";
            exit();
        }
    }

    // Function to subscribe email
    function subscribeEmail($email) {
        global $connection;

        // Insert the email into the newsletter table
        $query = "INSERT INTO newsletter (email) VALUES ('$email')";
        $result = mysqli_query($connection, $query);

        // Check if the insertion was successful
        if ($result) {
            // Redirect to the homepage with success message
            header("Location: Home.html?message=Subscribed successfully");
            exit();
        } else {
            // Redirect to the homepage with error message
            header("Location: Home.html?message=Subscription failed");
            exit();
        }
    }

    // Function to unsubscribe email
    function unsubscribeEmail($email) {
        global $connection;

        // Delete the email from the newsletter table
        $query = "DELETE FROM newsletter WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        // Check if any row was affected
        if (mysqli_affected_rows($connection) > 0) {
            // Redirect to the homepage with success message
            header("Location: Home.html?message=Unsubscribed successfully");
            exit();
        } else {
            // Redirect to the homepage with error message
            header("Location: Home.html?message=Email not found");
            exit();
        }
    }

    // Function to update email
    function updateEmail($oldEmail, $newEmail) {
        global $connection;

        // Update the email in the newsletter table
        $query = "UPDATE newsletter SET email = '$newEmail' WHERE email = '$oldEmail'";
        $result = mysqli_query($connection, $query);

        // Check if any row was affected
        if (mysqli_affected_rows($connection) > 0) {
            // Redirect to the homepage with success message
            header("Location: Home.html?message=Email updated successfully");
            exit();
        } else {
            // Redirect to the homepage with error message
            header("Location: Home.html?message=Email update failed");
            exit();
        }
    }

    // Close the database connection
    mysqli_close($connection);
?>