<?php
    include_once 'config.php';

    session_start();

    mysqli_select_db($connection, $database);

    // Retrieve form data
    $selectedDoctor = $_POST["doctor_name"];

    // Split the selectedDoctor string into an array using ' - ' as the delimiter
    $doctorInfo = explode(' - ', $selectedDoctor);

    // Access the first element of the array, which represents $doctorName
    $doctorName = $doctorInfo[0];
    $hospitalName = $_POST['hospital_name'];
    $specialization = $_POST['specialization'];
    $dateString = $_POST['appointment_date'];
    $timeString = $_POST['appointment_time'];
    $patientId = $_SESSION["user_id"];

    // Insert data into appointments table
    $sql = "INSERT INTO appointments (patient_id, doctor_name, hospital_name, specialization, appointment_date, appointment_time) VALUES ('$patientId', '$doctorName', '$hospitalName', '$specialization', '$dateString', '$timeString')";

    if (mysqli_query($connection, $sql)) {
        // Data successfully inserted
        header("Location: channelDoctor.php");
    } else {
        // Error occurred while inserting data
        header("Location: channelDoctor.php");
    }

    // Close the database connection
    mysqli_close($connection);
    exit();
?>