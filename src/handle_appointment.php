<?php
    include_once 'config.php';

    mysqli_select_db($connection, $database);

    if (isset($_POST['confirm'])) {
        $appointmentId = $_POST['confirm'];

        // Update the status to "Approved" in the database
        $updateSql = "UPDATE appointments SET status = 0 WHERE appointment_id = '$appointmentId'";
        mysqli_query($connection, $updateSql);

        header("Location: doctorAppointments.php");
    } elseif (isset($_POST['cancel'])) {
        $appointmentId = $_POST['cancel'];

        // Delete the record from the appointments table
        $deleteSql = "DELETE FROM appointments WHERE appointment_id = '$appointmentId'";
        mysqli_query($connection, $deleteSql);

        header("Location: doctorAppointments.php");
    }

    // Close the database connection
    mysqli_close($connection);
?>