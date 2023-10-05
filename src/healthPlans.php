<?php
    include_once 'config.php';
    
    mysqli_select_db($connection, $database);

    function print_table($table_name, $connection){
        $query = "SELECT * FROM " . $table_name;
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $description = $row['description'];
                $exclusive = $row['exclusive'];
                $special = $row['special'];
                $essential = $row['essential'];

                echo '<tr>';
                echo '<td>'.$description.'</td>';
                if($exclusive == 'Limited'){
                    echo '<td>';
                    echo '<div class="imgContainer"><img src="images/check-circle.png" alt=""></div>';
                    echo '</td>';
                }
                else{
                    echo '<td>'.$exclusive.'</td>';
                }
                if($special == 'Limited'){
                    echo '<td>';
                    echo '<div class="imgContainer"><img src="images/check-circle.png" alt=""></div>';
                    echo '</td>';
                }
                else if($special == 'Not Covered'){
                    echo '<td>';
                    echo '<div class="imgContainer"><img src="images/remove-circle.png" alt=""></div>';
                    echo '</td>';
                }
                else{
                    echo '<td>'.$special.'</td>';
                }
                if($essential == 'Limited'){
                    echo '<td>';
                    echo '<div class="imgContainer"><img src="images/check-circle.png" alt=""></div>';
                    echo '</td>';
                }
                else if($essential == 'Not Covered'){
                    echo '<td>';
                    echo '<div class="imgContainer"><img src="images/remove-circle.png" alt=""></div>';
                    echo '</td>';
                }
                else{
                    echo '<td>'.$essential.'</td>';
                }
                echo '</tr>';
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Insurance Plans</title>
        <link rel="stylesheet" href="styles/healthPlans.css">
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
                <li><a href="channelDoctor.php">Medical Services</a></li>
                <li><a class="active" href="healthPlans.php">Insurance Plan</a></li>
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
            <h1 style="margin-bottom: 0;">Health Insurance</h1>
            <span style="font-size: 50px;font-weight: bold;">Plans in Details</span>
        </div>
        <div class="plan-buttons">
            <ul>
                <li id="list-1" class="liss act" onclick="changePage(1)">Plan1</li>
                <li id="list-2" class="liss" onclick="changePage(2)">Plan2</li>
                <li id="list-3" class="liss" onclick="changePage(3)">Plan3</li>
                <li id="list-4" class="liss" onclick="changePage(4)">Plan4</li>
                <li id="list-5" class="liss" onclick="changePage(5)">Plan5</li>
                <li id="list-6" class="liss" onclick="changePage(6)">Plan6</li>
            </ul>
            <table id="table-page-1" class="page active">
                <tbody>
                    <tr>
                        <th style="width: 40%;">
                            <div class="legend">
                                <div>
                                    <img src="images/check-circle.png" alt="">
                                    <span class="descrip" style="color: darkblue;">Covered</span>
                                </div>
                                <div>
                                    <img src="images/remove-circle.png" alt="">
                                    <span class="descrip" style="color:#E46668ed;">Not Covered</span>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 1</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 2</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 3</span>
                            </div>
                        </th>
                    </tr>
                    <?php print_table('additional_assistance', $connection); ?>
                </tbody>
            </table>
            <table id="table-page-2" class="page" style="width: 100%;">
                <tbody>
                    <tr>
                        <th style="width: 40%;">
                            <div class="legend">
                                <div>
                                    <img src="images/check-circle.png" alt="">
                                    <span class="descrip" style="color: darkblue;">Covered</span>
                                </div>
                                <div>
                                    <img src="images/remove-circle.png" alt="">
                                    <span class="descrip" style="color:#E46668ed;">Not Covered</span>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 1</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 2</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 3</span>
                            </div>
                        </th>
                    </tr>
                    <?php print_table('basic_dental_services', $connection); ?>
                </tbody>
            </table>
            <table id="table-page-3" class="page">
                <tbody>
                    <tr>
                        <th style="width: 40%;">
                            <div class="legend">
                                <div>
                                    <img src="images/check-circle.png" alt="">
                                    <span class="descrip" style="color: darkblue;">Covered</span>
                                </div>
                                <div>
                                    <img src="images/remove-circle.png" alt="">
                                    <span class="descrip" style="color:#E46668ed;">Not Covered</span>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 1</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 2</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 3</span>
                            </div>
                        </th>
                    </tr>
                    <?php print_table('inpatient_treatment', $connection); ?>
                </tbody>
            </table>
            <table id="table-page-4" class="page">
                <tbody>
                    <tr>
                        <th style="width: 40%;">
                            <div class="legend">
                                <div>
                                    <img src="images/check-circle.png" alt="">
                                    <span class="descrip" style="color: darkblue;">Covered</span>
                                </div>
                                <div>
                                    <img src="images/remove-circle.png" alt="">
                                    <span class="descrip" style="color:#E46668ed;">Not Covered</span>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 1</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 2</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 3</span>
                            </div>
                        </th>
                    </tr>
                    <?php print_table('major_dental_services', $connection); ?>
                </tbody>
            </table>
            <table id="table-page-5" class="page">
                <tbody>
                    <tr>
                        <th style="width: 40%;">
                            <div class="legend">
                                <div>
                                    <img src="images/check-circle.png" alt="">
                                    <span class="descrip" style="color: darkblue;">Covered</span>
                                </div>
                                <div>
                                    <img src="images/remove-circle.png" alt="">
                                    <span class="descrip" style="color:#E46668ed;">Not Covered</span>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 1</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 2</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 3</span>
                            </div>
                        </th>
                    </tr>
                    <?php print_table('outpatient_treatment', $connection); ?>
                </tbody>
            </table>
            <table id="table-page-6" class="page">
                <tbody>
                    <tr>
                        <th style="width: 40%;">
                            <div class="legend">
                                <div>
                                    <img src="images/check-circle.png" alt="">
                                    <span class="descrip" style="color: darkblue;">Covered</span>
                                </div>
                                <div>
                                    <img src="images/remove-circle.png" alt="">
                                    <span class="descrip" style="color:#E46668ed;">Not Covered</span>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 1</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 2</span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Package 3</span>
                            </div>
                        </th>
                    </tr>
                    <?php print_table('medical_assistance', $connection); ?>
                </tbody>
            </table>
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
             function changePage(pageNumber) {
                // Hide all table pages
                const tablePages = document.getElementsByClassName('page');
                const Plans = document.getElementsByClassName('liss');
                for (let i = 0; i < tablePages.length; i++) {
                    tablePages[i].classList.remove('active');
                    //selectedPlan.classList.remove('act');
                }
                for(let i = 0; i < Plans.length; i++){
                    Plans[i].classList.remove('act');
                }
                // Show the selected table page
                const selectedTablePage = document.getElementById('table-page-' + pageNumber);
                const selectedPlan = document.getElementById('list-' + pageNumber)
                
                    selectedTablePage.classList.add('active');
                    selectedPlan.classList.add('act');
                
            }


            function showChangeEmail() {
                                document.getElementById("emailInput").placeholder = "New Email";
                                document.getElementById("subscribeButton").style.display = "none";
                                document.getElementById("unsubscribeButton").style.display = "none";
                                document.getElementById("updateButton").style.display = "none";
                                document.getElementById("changeEmail").style.display = "block";
                            }

                            function validateAndSubmit() {
                                var oldEmail = document.getElementById("oldEmailInput").value;
                                var newEmail = document.getElementById("emailInput").value;

                                if (oldEmail && newEmail) {
                                    document.getElementById("oldEmailInput").value = ""; // Clear old email input
                                    document.getElementById("emailInput").placeholder = "Enter your email"; // Reset placeholder
                                    document.getElementById("updateButton").style.display = "inline-block"; // Show update button
                                    document.getElementById("changeEmail").style.display = "none"; // Hide changeEmail div
                                    document.forms[0].submit(); // Submit the form
                                }
                            }
        </script>
    </body>
</html>