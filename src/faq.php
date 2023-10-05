<?php
    // Start the database connection
    include_once 'config.php';

    session_start();

    // Retrieve session variables
    $variable1 = $_SESSION['user_id'];
    $variable2 = $_POST['question'];

    // Select Database
    mysqli_select_db($connection, $database);

    // Prepare SQL statement
    $sql = "INSERT INTO faq (qid, userid, question) VALUES ('', '$variable1', '$variable2')";

    //removing the question from the database
    if(isset($_POST["remove"])){
        $sql = "DELETE FROM faq";
    }

    // Execute the SQL statement
    if (mysqli_query($connection, $sql)) {
        echo "Data inserted successfully into the database.";
        header("Location: faq.html");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        header("Location: faq.html");
    }

    // Close the database connection
    mysqli_close($connection);
    exit();
?>
