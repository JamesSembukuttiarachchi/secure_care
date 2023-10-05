<?php
    include_once 'config.php';

    mysqli_select_db($connection, $database);

    function displayCartData($connection) {
        // Fetch data from the cart table
        $query = "SELECT DISTINCT medicine_name, medicine_img_link, medicine_price FROM cart";
        $result = mysqli_query($connection, $query);

        // Process the result set
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the product name, link, and price from each row
                $product = $row['medicine_name'];
                $link = $row['medicine_img_link'];
                $price = $row['medicine_price'];

                // Print the table row for the current product
                echo '<tr>
                    <td>
                        <div class="cart-info">
                            <img src="images/' . $link . '">
                            <div>
                                <p>' . $product . '</p>
                                <small>Price: $</small><small id="' . $product . '_price" data-value="'.$price.'">'.$price.'</small>
                            </div>
                        </div>
                    </td>
                    <td><input id="quantity_'.$product.'" type="number" value="1" min="1"></td>
                    <td><label id="calc_'.$product.'">' . $price . '</label></td>
                </tr>';
            }
        }
    }
?>

<!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="styles/cart.css">
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
        <div class="small-container cart-page">

            <table>

                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
                <?php
                    displayCartData($connection);
                ?>
            </table>
            <div class="calc-total">
                <button id="calculate" onclick="calculateTotal()">Calculate Total</button>
            </div>

            <div class="total-price">
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td class="subtotal">Rs. 0</td>
                    </tr>

                    <tr>
                        <td>Discount</td>
                        <td class="discount">00</td>
                    </tr>

                    <tr>
                        <td>Net Amount</td>
                        <td class="net-amount">Rs. 0</td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="checkOut">
                <button id="proceed" onclick="checkout()">Procced to Check Out</button>
            </div><br>
                
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
            // Get the quantity input elements dynamically
            var quantityInputs = document.querySelectorAll('input[id^="quantity_"]');

            // Loop through each quantity input element
            quantityInputs.forEach(function(quantityInput) {
                // Get the final price element based on the current quantity input element
                var productId = quantityInput.id.replace('quantity_', '');
                var finalPriceLabel = document.getElementById("calc_" + productId);

                // Get the price element based on the current quantity input element
                var priceElement = document.getElementById(productId + '_price');

                // Get the original price
                var originalPrice = parseFloat(priceElement.getAttribute("data-value"));

                // Function to calculate and update the final price
                function updateFinalPrice() {
                    // Get the current quantity value
                    var quantity = parseInt(quantityInput.value);

                    // Calculate the new price
                    var newPrice = originalPrice * quantity;

                    // Update the final price element with the new value
                    finalPriceLabel.innerHTML = newPrice.toFixed(2);
                }

                // Add an event listener to listen for changes in the quantity input
                quantityInput.addEventListener("input", updateFinalPrice);
            });

            function calculateTotal() {
                // Get all the label elements
                var priceLabels = document.querySelectorAll('label[id^="calc_"]');

                // Initialize subtotal to 0
                var subtotal = 0;

                // Loop through each label element and sum up the values
                priceLabels.forEach(function(label) {
                    subtotal += parseFloat(label.innerHTML);
                });

                // Calculate the discount based on the subtotal
                var discount = 0;
                if (subtotal > 100 && subtotal <= 500) {
                    discount = subtotal * 0.05; // 5% discount
                } else if (subtotal > 500 && subtotal <= 1000) {
                    discount = subtotal * 0.1; // 10% discount
                } else if (subtotal > 1000) {
                    discount = subtotal * 0.2; // 20% discount
                }

                // Apply the discount to the subtotal
                var netAmount = subtotal - discount;

                // Update the Subtotal and Discount fields with the calculated values
                var subtotalField = document.querySelector('.subtotal');
                var discountField = document.querySelector('.discount');
                var netAmountField = document.querySelector('.net-amount');

                subtotalField.innerHTML = 'Rs. ' + subtotal.toFixed(2);
                discountField.innerHTML = 'Rs. ' + discount.toFixed(2);
                netAmountField.innerHTML = 'Rs. ' + netAmount.toFixed(2);
            }

            function checkout(){
                window.location.href="payment_portal.html";
            }

        </script>
        
    </body>
</html>