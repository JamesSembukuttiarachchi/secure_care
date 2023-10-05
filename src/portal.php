<?php
    // Establish the connection with the database
    include_once 'config.php';

    // Select the database
    mysqli_select_db($connection, $database);

    // Retrieve the form data
    $nicNumber = $_POST['nicnumber'];
    $phoneNumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $query = "SELECT contact_number, _password, username FROM patient WHERE contact_number = '$phoneNumber'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
      // User exists, check the password
      $row = mysqli_fetch_assoc($result);
      $user = $row['username'];
      $storedPassword = $row['_password'];

      if ($password == $storedPassword) {
        // Passwords match, user authenticated
        header("Location: patientportal.html?user=" . urlencode($user));
        exit();
        // Proceed with further actions or redirection
      } else {
        // Passwords don't match
        echo "Incorrect password. Please try again.";
      }
    } else {
      // User does not exist
      echo "User not found. Please check your NIC number and phone number.";
    }

    // Close the database connection
    mysqli_close($connection);
?>
