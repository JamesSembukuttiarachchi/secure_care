<?php
    session_start();    

    include_once 'config.php';

    mysqli_select_db($connection, $database);

    function print_details($connection)
    {
        // Fetch data from the appointments table
        $sql = "SELECT * FROM appointments WHERE doctor_name = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 's', $_SESSION["first_name"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);


        // Print the data using HTML
        while ($row = mysqli_fetch_assoc($result)) {
            $appointmentId = $row['appointment_id'];
            $patientId = $row['patient_id'];
            $doctorName = $row['doctor_name'];
            $hospitalName = $row['hospital_name'];
            $specialization = $row['specialization'];
            $appointmentDate = $row['appointment_date'];
            $appointmentTime = $row['appointment_time'];
            $status = $row["status"];

            $statusText = $status ? 'Pending' : 'Approved';

            echo '<form action="handle_appointment.php" method="post">';
            echo '<div class="table-template">';
            echo '<div>';
            echo $status ? '<h3><button type="submit" name="confirm" value="' . $appointmentId . '">Confirm</button></h3>' : '';
            echo '</div>';
            echo '<div>';
            echo $status ? '<h3><button type="submit" value="' . $appointmentId . '" id="cancel' . $appointmentId . '" name="cancel">Cancel</button></h3>' : '';
            echo '</div>';
            echo '<div>';
            echo '<h3>' . $doctorName . '</h3>';
            echo '</div>';
            echo '<div>';
            echo '<h3>' . $hospitalName . '</h3>';
            echo '</div>';
            echo '<div>';
            echo '<h3>' . $appointmentDate . '</h3>';
            echo '</div>';
            echo '<div>';
            echo '<h3>' . $appointmentTime . '</h3>';
            echo '</div>';
            echo '<div id="status_' . $appointmentId . '">';
            echo '<h3>' . $statusText . '</h3>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
        }

        // Close the database connection
        mysqli_close($connection);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Doctor's Portal</title>
        <link rel="stylesheet" href="styles/doctorApo.css">
        <link rel="stylesheet" href="styles/header_footer_revise.css">
        <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
        <script src="https://kit.fontawesome.com/c0ffbede71.js"></script>
        
    </head>
    <body>
    <header>
        <div class="logo">
            <!-- Logo image or text -->
            <img src="images/logo.jpeg" alt="Logo" width="100" height="100" />
        </div>

        <div class="navigation">
            <ul>
                <!-- First row of navigation tabs -->
                <li><a class="active" href="Home.html">Home</a></li>
                <li><a href="channelDoctor.php">Medical Services</a></li>
                <li><a href="healthPlans.php">Insurance Plan</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="MedicalStore.php">Medical Store</a></li>
            </ul>
            <ul class="header_nav">
                <!-- Second row of navigation tabs -->
                <li><a href="patientlogin.html">Customer Portal</a></li>
                <li><a href="pay_online.html">Pay Online</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
                <li><a href="about_us.html">About Us</a></li>
            </ul>
        </div>

        <div class="search-bar">
            <!-- Search bar -->
            <input type="text" placeholder="Search..." />
            <button type="submit">Search</button>
            <!--<button type="submit" class="sign">Sign Up/Login</button>-->
            <button id="profile" name="profile" onclick="redirectToProfile()">
                <i class="fa-solid fa-user"></i> 
                <a href="handle_profile.php" style="text-decoration: none;">Profile</a>
            </button>
        </div>

        <div style="clear: both;"></div> <!-- Clear float -->
    </header>
        <h1 style="margin-left: 12px; color: #e7efee;">My Appointments</h1>
        <div style="width:75%; margin-left:200px">
            <div class="table-template">
                <div>
                    <h3>Confirm Appointment</h3>
                </div>
                <div>
                    <h3>Cancel Appointment</h3>
                </div>
                <div>
                    <h3>Patient Name</h3>
                </div>
                <div>
                    <h3>Hospital Name</h3>
                </div>
                <div>
                    <h3>date</h3>
                </div>
                <div>
                    <h3>time</h3>
                </div>
                <div>
                    <h3>Status</h3>
                </div>
            </div>
            <?php
                print_details($connection);
            ?>
        </div>
        <footer style="position: relative; top: 43px;">
        <div class="row">
            <div class="col">
                <img src="images/logo.jpeg" alt="Logo" style="width: 100px; height: 100px;" />
                <p>"SecureCare: Your Health, Our Priority"</p>
            </div>
            <div class="col">
                <h3>Links</h3>
                
                <div class="footer-link-buttons">
                    <div><a href="contact_us.php">Contact Us</a></div>
                    <div><a href="">Terms & Conditions</a></div>
                    <div><a href="">Privacy & Cookies Policy</a></div>
                    <div><a href="faq.html">FAQ's</a></div>
                </div>
            </div>
            <div class="col">
                <h3>Newsletter</h3>
                <form action="newsletter.php" method="post" id="newsletterForm">
                    <div style="width: 88%; margin-top: 10px;">
                        <input type="email" id="emailInput" name="email" placeholder="Enter your email" required>
                    </div>

                    <div>
                        <button id="subscribeButton" name="submit" value="subscribe">Subscribe</button>
                        <button id="unsubscribeButton" name="submit" value="unsubscribe">Unsubscribe</button>
                        <button type="button" id="updateButton" name="submit" value="update">Update</button>
                    </div>

                    <div class="social-icons">
                        <a href="www.facebook.com"><i class="fa-brands fa-facebook"></i></a>
                        <a href="www.instagram.com"><i class="fa-brands fa-instagram"></i></a>
                        <a href="www.linkedin.com"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="www.twitter.com"><i class="fa-brands fa-twitter"></i></a>
                        <a href="www.dribble.com"><i class="fa-brands fa-dribbble"></i></a>
                    </div>

                    <!-- Hidden dialog box -->
                    <div id="changeEmail" style="display: none;">
                        <input type="email" id="oldEmailInput" name="old_email" placeholder="Old Email">
                        <button type="submit" name="confirm_update" onclick="validateAndSubmit()">OK</button>
                    </div>

                    <script>
                        function showChangeEmail(event) {
                            event.preventDefault(); // Prevent form submission

                            document.getElementById("emailInput").placeholder = "New Email";
                            document.getElementById("subscribeButton").style.display = "none";
                            document.getElementById("unsubscribeButton").style.display = "none";
                            document.getElementById("updateButton").style.display = "none";
                            document.getElementById("changeEmail").style.display = "block";
                        }

                        function validateAndSubmit(event) {
                            event.preventDefault(); // Prevent form submission

                            var oldEmail = document.getElementById("oldEmailInput").value;
                            var newEmail = document.getElementById("emailInput").value;

                            if (oldEmail && newEmail) {
                                document.getElementById("newsletterForm").submit(); // Submit the form
                            }
                        }

                        document.getElementById('updateButton').addEventListener('click', showChangeEmail);
                    </script>
                </form>
            </div>
        </div>
        <div><p class="copyright">&copy 2023 All rights reserved.</p></div>
        </footer>
    </body>
</html>