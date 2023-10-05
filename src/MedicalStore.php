<?php
    function print_details(){
    // Establish connection
    include_once 'config.php';

    mysqli_select_db($connection, $database);

    // Retrieve data from the medical_store table
    $query = "SELECT item_name, price, item_img_link FROM medical_store";
    $result = mysqli_query($connection, $query);

    // Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    // Loop through each row and display the items
    while ($row = mysqli_fetch_assoc($result)) {
        if ($i % 5 === 0) {
            // Start a new row
            echo '<div style="margin-left: 14px; padding-bottom: 10px;">';
            echo '<div style="display: flex;">';
        }

        $itemName = $row['item_name'];
        $price = $row['price'];
        $imageLink = $row['item_img_link'];

        // Output the item in the desired format
        echo '<div class="catItem">';
        echo '<div>';
        echo '<img class="catImage" width="172" height="108" src="images/'.$imageLink.'" alt="">';
        echo '</div>';
        echo '<div style="text-align: center;">';
        echo '<h3 style="font-size: 16px; font-weight: 700;">'.$itemName.'</h3>';
        echo '<h4 class="price">Rs '.$price.'</h4>';
        echo '</div>';
        echo '<div>';
        echo '<button class="cartButton" onclick="addMedicine(\''.$itemName.'\', \''.$imageLink.'\', '.$price.');">Add to cart</button>';
        echo '</div>';
        echo '</div>';

        $i++;

        if ($i % 5 === 0) {
            // End the current row
            echo '</div>';
            echo '</div>';
        }
    }

    // Check if there are any remaining items to close the last row
    if ($i % 5 !== 0) {
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No items found in the medical store.';
}


    // Close the database connection
    mysqli_close($connection);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Medical Store</title>
        <link rel="stylesheet" href="styles/medStStyles.css">
        <link rel="stylesheet" href="styles/header_footer_revise.css">
        <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <li><a href="healthPlans.php">Insurance Plan</a></li>
                <li><a href="news.php">News</a></li>
                <li><a class="active" href="MedicalStore.php">Medical Store</a></li>
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
        <section class="cartSection">
            <div class="shopping">
                <form action="create_cart.php" method="POST" id="cartForm">
                    <input type="hidden" name="medicineArray" id="medicineArrayInput">
                    <button id="shopping-button" type="submit" onclick="goToCart(event);"></button>
                    <img src="images/shopping.svg">
                    
                  </form>
            </div>
        </section>
        <div>
            <div>
                <img src="images/banner.png" width="100%" alt="banner image">
            </div>
            <section style="padding: 0 40px;">
                <h2 style="font-size: 30px; font-weight: 700; border-bottom: 1px groove black; border-bottom-width: medium;">Categories</h2>
                <div style="margin-left: 14px;">
                    <div style="display: flex;">
                        <div class="catItem">
                            <div>
                                <img class="catImage" width="172" height="108" src="images/cat-1.png" alt="">
                            </div>
                            <div style="text-align: center;">
                                <h3 style="font-size: 16px; font-weight: 700;">General Health Consumables</h3>
                            </div>
                        </div>
                        <div class="catItem">
                            <div>
                                <img class="catImage" width="172" height="108" src="images/cat-2.png" alt="">
                            </div>
                            <div>
                                <h3 style="font-size: 16px; font-weight: 700;">Home Health Care Products</h3>
                            </div>
                        </div>
                        <div class="catItem">
                            <div>
                                <img class="catImage" width="172" height="108" src="images/cat-3.png" alt="">
                            </div>
                            <div>
                                <h3 style="font-size: 16px; font-weight: 700;">Health Care Items for Professionals</h3>
                            </div>
                        </div>
                        <div class="catItem">
                            <div>
                                <img class="catImage" width="172" height="108" src="images/cat-4.png" alt="">
                            </div>
                            <div>
                                <h3 style="font-size: 16px; font-weight: 700;">Products for Bulk Clinic Pharmacy  or Hospital</h3>
                            </div>
                        </div>
                        <div class="catItem">
                            <div>
                                <img class="catImage" width="172" height="108" src="images/cat-5.png" alt="">
                            </div>
                            <div>
                                <h3 style="font-size: 16px; font-weight: 700;">Miscellaneous Items</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Featured Products -->
            <section style="padding: 0 40px;">
                <h2 style="font-size: 30px; font-weight: 700; border-bottom: 1px groove black; border-bottom-width: medium;">Featured Products</h2>  
                <?php
                        print_details();
                ?>
            </section>
            <section class="services">
                <div style="display: flex;">
                    <div class="Scontainer">
                        <div>
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="Sdescription">
                            <h3 class="SmTitle">Quick Island Wide Delivery</h3>
                            <p class="Sdes">Through reliable couriers</p>
                        </div>
                    </div>
                    <div class="Scontainer">
                        <div>
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="Sdescription">
                            <h3 class="SmTitle">Trusted Services</h3>
                            <p class="Sdes">More than a decade</p>
                        </div>
                    </div>
                    <div class="Scontainer">
                        <div>
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="Sdescription">
                            <h3 class="SmTitle">Easy & Free Return Policy</h3>
                            <p class="Sdes">100% money back of the product</p>
                        </div>
                    </div>
                    <div class="Scontainer">
                        <div>
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="Sdescription">
                            <h3 class="SmTitle">Multiple Payment Methods</h3>
                            <p class="Sdes">Cash on delivery, bank transfer or card payments</p>
                        </div>
                    </div>
                    <div class="Scontainer">
                        <div>
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="Sdescription">
                            <h3 class="SmTitle">Physical Store</h3>
                            <p class="Sdes">For warranty claim, return, change or exchange the product.</p>
                        </div>
                    </div>
                </div>
            </section>
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

        <script src="scripts/home_script.js"></script>
        <script src="scripts/medical_store.js"></script>
    </body>
</html>