<?php
    // Establish the connection between the database server
    include_once 'config.php';

    // Select the database
    mysqli_select_db($connection, $database);

    // Get the number of claims passed through URL parameters
    $claims = $_GET["claims_value"];

    // Query to fetch random claims from the database
    $query = "SELECT * FROM claims ORDER BY RAND() LIMIT $claims";
    $result = mysqli_query($connection, $query);

    // Function to format the date as dd-mm-yyyy
    function formatDate($date) {
        return date("d-m-Y", strtotime($date));
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Claims</title>
    <link rel="stylesheet" href="styles/trackmyclaimsstyles.css">
</head>
<body>
    <div class="container">
        <div>
            <h2>My Claims</h2>
        </div>
        <div>
            <table>
                <tr>
                    <th>Claim ID</th>
                    <th>Status</th>
                    <th>Date Submitted</th>
                    <th>Date Resolved</th>
                </tr>
                <?php
                    // Display the claims in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        $claimID = $row['claim_id'];
                        $status = $row['status'];
                        $submittedDate = formatDate($row['submitted_date']);
                        $resolvedDate = formatDate($row['resolved_date']);

                        echo "
                        <tr>
                            ";
                            echo "
                            <td>$claimID</td>";
                            echo "
                            <td>$status</td>";
                            echo "
                            <td>$submittedDate</td>";
                            echo "
                            <td>$resolvedDate</td>";
                            echo "
                        </tr>";
                        }
                ?>
            </table>
        </div>
    </div>
</body>
</html>