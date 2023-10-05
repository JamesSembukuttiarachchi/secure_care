<?php
    session_start();

    function print_doctors(){
        include_once 'config.php';

        mysqli_select_db($connection, $database);

        // Fetch the doctor names from the doctor table
        $sql = "SELECT first_name, hospital, specialization FROM doctor";
        $result = mysqli_query($connection, $sql);

        // Store the rows in an array
        $doctorsArray = array();

        if ($result->num_rows > 0) {

            // Print the dropdown menu
            echo '<select class="selectDoc" name="doctor_name" id="doctor_name" oninput="checkFormCompletion()">';
            echo '<option value="">Select a doctor</option>';

            while ($row = $result->fetch_assoc()) {
                $doctorName = $row["first_name"];
                $hospital = $row["hospital"];
                $specialization = $row["specialization"];
                
                // Create a unique identifier for each row
                $rowIdentifier = $doctorName . ' - ' . $hospital . ' - ' . $specialization;

                // Store the row data in the array
                $doctorsArray[$rowIdentifier] = array(
                    'doctor_name' => $doctorName,
                    'hospital' => $hospital,
                    'specialization' => $specialization
                );

                // Print the option in the dropdown menu
                echo '<option value="' . $rowIdentifier . '">' . $doctorName . '</option>';
            }
        } else {
            echo '<option value="">No doctors found</option>';
        }

        echo '</select>';

        // Close the database connection
        mysqli_close($connection);

        // Return the array for future use
        return $doctorsArray;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Medical Services</title>
        <link rel="stylesheet" href="styles/chaneldoctor.css">
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
                <li><a href="Home.html">Home</a></li>
                <li><a class="active" href="channelDoctor.php">Medical Services</a></li>
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
    
        <div style="text-align: center;">
            <h1 style="color: white;">Channel Your Doctor</h1>
        </div>
        <!--Starting of the form-->
        <div class="formContainer">
            <form action="appointments.php" method="post">
                <div style="padding: 50px;">
                    <div style="display:flex;margin-left:-4px">
                        <?php
                            $doctorsArray = print_doctors();
                        ?>
                    </div>
                    <div>
                        <input name="hospital_name" id="hospital_name" type="text" placeholder="Hospital Name" aria-label="Hospital Name" oninput="checkFormCompletion()">
                    </div>
                    <div>
                        <input name="specialization" id="specialization" type="text" placeholder="Specialization" aria-label="Specialization" oninput="checkFormCompletion()">
                    </div>
                    <div>
                        <input name="appointment_date" type="date" id="date" oninput="checkFormCompletion()">
                    </div>
                    <div style="text-align: left; margin-top: 16px;">
                        <input name="appointment_time" type="time" min="07:00" max="23:00" id="time" oninput="checkFormCompletion()">
                    </div>
                    <div style="text-align: left; position: relative; top: 16px;">
                        <input type="hidden" name="patient_id" value="123">
                        <button id="sub-button" onclick="showCustomAlert()" disabled>Make Appointment</button>
                    </div>

                </div>
            </form>
        </div>
        <!--Alert Box-->
        <div id="customAlertBox" class="customAlert hidden">
                    <div class="customAlertContent">
                      <span class="closeButton" onclick="closeCustomAlert()">&times;</span>
                      <img class="check-mark" src="images/green-check-mark-icon.png" alt="check-mark" width="40px" height="40px">
                      <h3>Appointment Success</h3>
                      <button class="alertBtn" onclick="window.location.href = 'Home.html'">Back to Home page</button>
                    </div>
                </div>
        <!------------>

        <!--Starting of the Button Icons-->
        <section class="iconSec">
            <div class="priContainer">
                <div class="box">
                    <div class="image">
                        <img src="images/telephoneRe.png" alt="telephone">
                    </div>
                    <div style="text-align: center;">
                        <h3 class="mText">Audio/Video</h3>
                        <span class="sText">Consultation</span>
                    </div>
                </div>
                <div class="box" onclick = "location.href='MedicalStore.php'">
                    <div class="image">
                        <img src="images/pillsRe.png" alt="">
                    </div>
                    <div>
                        <h3 class="mText">Medicine</h3>
                        <span class="sText">to Your Doorstep</span>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                        <img src="images/lab-reports.png" alt="">
                    </div>
                    <div>
                        <h3 class="mText">Lab Reports</h3>
                        <span class="sText">at Your Fingertips</span>
                    </div>
                </div>
                <div class="box" onclick = "location.href='MedicalStore.php'">
                    <div class="image">
                        <img style="height: 50px; width: 92px;" src="images/pharmacy_orderRe.png" alt="">
                    </div>
                    <div>
                        <h3 class="mText">Find</h3>
                        <span class="sText">My Meds</span>
                    </div>
                </div>
            </div>
        </section>
        
        <!--Starting of the image slider-->
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="images/Slider/slider__image_74Retouch.png" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="images/Slider/slider__image_75Retouch.png" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="images/Slider/slider__image_76Retouch.png" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="images/Slider/slider__image_79Retouch.png" style="width:100%">
            </div>
        </div>
        
        <div class="dotContainer">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span>
            <span class="dot"></span>  
        </div>
        <footer>
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
        <script>
            let slideIndex = 0;
            showSlides();
            
            function showSlides() {
              let i;
              let slides = document.getElementsByClassName("mySlides");
              let dots = document.getElementsByClassName("dot");
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
              }
              slideIndex++;
              if (slideIndex > slides.length) {slideIndex = 1}    
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
              setTimeout(showSlides, 8000); // Set image changing time
            }

            function showCustomAlert() {
                var customAlertBox = document.getElementById('customAlertBox');
                customAlertBox.classList.remove('hidden');
            }

            function closeCustomAlert() {
                var customAlertBox = document.getElementById('customAlertBox');
                customAlertBox.classList.add('hidden');
            }

            function checkFormCompletion() {
                var field1 = document.getElementById('doctor_name').value;
                var field2 = document.getElementById('hospital_name').value;
                var field3 = document.getElementById('specialization').value;
                var field4 = document.getElementById('date').value;
                var field5 = document.getElementById('time').value;
                var submitButton = document.getElementById('sub-button');

                if (field1 !== '' && field2 !== '' && field3 !== '' && field4 !== '' && field5 !== '' ) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }
        </script>

        <script>
        // JavaScript code to fill the hospital name and specialization based on the selected doctor
            function fillDoctorDetails() {
                // Get the selected doctor's identifier from the dropdown menu
                var selectedDoctor = document.getElementById("doctor_name").value;

                // Access the doctor's details from the doctorsArray (generated by PHP)
                var doctorsArray = <?php echo json_encode($doctorsArray); ?>;
                var selectedDoctorDetails = doctorsArray[selectedDoctor];

                // Fill the hospital name and specialization fields with the selected doctor's details
                document.getElementById("hospital_name").value = selectedDoctorDetails.hospital;
                document.getElementById("specialization").value = selectedDoctorDetails.specialization;
            }

            // Add an onchange event listener to the doctor dropdown menu
            document.getElementById("doctor_name").onchange = fillDoctorDetails;
        </script>

    </body>
</html>