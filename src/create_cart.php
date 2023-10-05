<?php
    // Establish connection
    include_once 'config.php';
    mysqli_select_db($connection, $database);

    // Check if the cart table exists, create it if necessary
    $createTableQuery = "CREATE TABLE IF NOT EXISTS cart (
        id INT AUTO_INCREMENT PRIMARY KEY,
        medicine_name VARCHAR(255) NOT NULL,
        medicine_img_link VARCHAR(255) NOT NULL,
        medicine_price DECIMAL(10, 2) NOT NULL
    )";
    mysqli_query($connection, $createTableQuery);

    // Check if there are medicine items to insert
    if (!empty($_POST['medicineArray'])) {
        $medicineArray = json_decode($_POST['medicineArray'], true);

        // Ensure that the decoding was successful
        if ($medicineArray !== null) {

            // Prepare the INSERT statement
            $insertQuery = "INSERT INTO cart (medicine_name, medicine_img_link, medicine_price) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($connection, $insertQuery);
            mysqli_stmt_bind_param($stmt, 'ssd', $medicineName, $medicineImgLink, $medicinePrice);

            // Iterate over the medicineArray and insert each item into the cart table
            foreach ($medicineArray as $medicine) {
                $medicineName = $medicine['name'];
                $medicineImgLink = $medicine['img_link'];
                $medicinePrice = $medicine['price'];
                mysqli_stmt_execute($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close the database connection
    mysqli_close($connection);
    header("Location: cart.php");
    exit();
?>
