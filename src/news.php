<?php
    session_start();

    // Establish connection
    include_once 'config.php';

    mysqli_select_db($connection, $database);

    // Initialize an array to store the news data
    $newsArray = array();

    // Retrieve data from 'news' table
    $query = "SELECT news, inserted_date, valid_days, img_link FROM news";
    $result = mysqli_query($connection, $query);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row and fetch the data
        while ($row = mysqli_fetch_assoc($result)) {
            $news = $row['news'];
            $insertedDate = $row['inserted_date'];
            $validDays = $row['valid_days'];
            $imgLink = $row['img_link'];

            // Calculate the expiration date
            $expirationDate = date('Y-m-d', strtotime($insertedDate . ' + ' . $validDays . ' days'));
            $currentDate = date('Y-m-d');

            // Check if news is invalid
            if ($expirationDate < $currentDate) {
                // Delete the invalid news
                deleteNews($news);
            } else {
                // Store the news data in the array
                $newsItem = array(
                    'news' => $news,
                    'inserted_date' => $insertedDate,
                    'valid_days' => $validDays,
                    'img_link' => $imgLink
                );
                $newsArray[] = $newsItem;
            }
        }
    }

    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == 'healthcare_provider'){
            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                   write_data($connection); 
                   header("Location: news.php");
            }
        }
        else if($_SERVER["REQUEST_URI"] !== "/news.php?access=0"){
            $link = "http://localhost/news.php?access=0";
            header("Location: $link");
            exit();
        }
    }
    else{
        $link = "http://localhost/news.php?access=0";
        header("Location: $link");
        exit();
    }

    function write_data($connection){
        // Retrieve the submitted data
            $news = $_POST["news1"];
            $validDays = $_POST["valid_days"];
            $file = $_FILES["image"];
            $dir = 'images/';

            // Generate a unique filename for the uploaded file
            $filename = basename($_FILES["image"]["name"]);

            // Move the uploaded file to the desired directory
            $destination = $dir . $filename;
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // File moved successfully
                echo "File has been uploaded and saved as: " . $filename;
            } else {
                // Failed to move the file
                echo "Sorry, there was an error uploading your file.";
            }


            // Calculate the current date
            $currentDate = date("Y-m-d");

            // Prepare and execute the SQL query to insert the data into the "news" table
            $sql = "INSERT INTO news (news, inserted_date, valid_days, img_link) VALUES ('$news', '$currentDate', '$validDays', '$filename')";
            if ($connection->query($sql) === TRUE) {
                echo "Data inserted successfully.";
            } else {
                echo "Error inserting data: " . $connection->error;
        }
    }

    // Close the database connection
    mysqli_close($connection);

    // Function to delete news
    function deleteNews($news) {
        global $connection;
        $deleteQuery = "DELETE FROM news WHERE news = '$news'";
        mysqli_query($connection, $deleteQuery);
        echo "Deleted news: " . $news . "<br>";
    }

    // Function to print the news in the specified format
    function printNews($newsArray) {
        // Counter to keep track of the number of news items printed
        $counter = 0;

        // Loop through each news item
        foreach ($newsArray as $newsItem) {
            // Extract the news details
            $news = $newsItem['news'];
            $newsImg = $newsItem['img_link'];

            // Print the container for every three news items
            if ($counter % 3 == 0) {
                echo '<div class="news-container">';
            }

            // Print the news item
            echo '<div class="news1">';
            echo '<img class="coverphoto" src="images/'.$newsImg.'" alt="news cover" />';
            echo '<p class="newspara">';
            echo $news;
            echo '</p>';
            echo '</div>';

            // Increment the counter
            $counter++;

            // Close the container after every three news items
            if ($counter % 3 == 0) {
                echo '</div>';
            }
        }

        // Close any open container div
        if ($counter % 3 != 0) {
            echo '</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/cover.css" />
    <link rel="stylesheet" href="styles/header_footer_revise.css">
    <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/c0ffbede71.js"></script>
    <title>News</title>
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
                <li><a class="active" href="news.php">News</a></li>
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
    <div class="div1" style="text-align: center;">
      <h1>News and Media</h1>
    </div>
    <div class="add-news-container" style="display: flex; justify-content: flex-end;">
      <button class="add-news-button" onclick="showCustomAlert()">Add News</button>
    </div>
    <div class="news-container">
      <div class="news1">
        <img class="coverphoto" src="images/news1.jpg" alt="news cover" />
        <h3>SecureCare conferred as a Company with Great Managers for the second consecutive year</h3>
        <p id="p1" class="newspara">
            Secure Care, Sri Lanka's leading life insurance provider, has been honored at the Great Manager Awards 2023. 
            They received the coveted "Company with Great Managers" award for the second consecutive year. Seven exceptional managers were also recognized for their outstanding performance. 
            Damitha Wickramathunga and Dilukshan De Silva won in the category of "Great Managers for Driving Results and Execution Excellence," while Lachini Chithrasena and Nayana Vithanawasam were victorious in the "Great Managers for Coaching Others for Growth" category. 
            Imanthika Ranaweera, Dahami Pathirana, and Chaminda Edirisinghe secured wins in the "Great Managers for Team Effectiveness and Collaboration" category. Secure Care's CEO, Jude Gomes, expressed pride in their commitment to exceptional leadership, and the Chief People Officer, Imtiyaz Aniff, emphasized their dedication to building an engaged workforce. 
            Secure Care is a subsidiary of the John Keells Group, offering comprehensive life insurance solutions to empower the Sri Lankan Dream.
        </p>
      </div>
      <div class="news1">
        <img class="coverphoto" src="images/news2.jpg" alt="news cover" />
        <h3>Secure Care Celebrates Exceptional Q1 2023 Results, Reinforcing Unwavering Customer Focus</h3>
        <p class="newspara">
            Secure Care, Sri Lanka's premier life insurer, 
            has announced its strong financial performance for Q1 2023. 
            With a 117% increase in profit before tax and a 37% rise in total net revenue, 
            the company showcases its strategic prowess and resilience. Secure Care's net investment income 
            grew by a remarkable margin, and both gross and net written premiums experienced growth. 
            The company's operational performance also thrived, 
            with an increase in profit from operations and earnings per share. With a focus on digital transformation, 
            Secure Care is setting new industry standards through innovative initiatives like the Clicklife App. 
            CEO Jude Gomes expressed pride in the company's exceptional performance.
        </p>
      </div>
      <div class="news1">
        <img class="coverphoto" src="images/news3.jpg" alt="news cover" />
        <h3>Secure Care Becomes First in Industry to Launch Groundbreaking e-MER and Digital Medical Records to Automate Underwriting</h3>
        <p class="newspara">
            Secure Care, a trailblazing life insurance provider, 
            has introduced the e-MER (Electronic Medical Examination Report) and digital medical records in collaboration with Durdans Hospital. 
            This pioneering initiative in the Sri Lankan life insurance industry aims to streamline the policy issuance process to just 15 minutes, 
            replacing the previous time-consuming procedure. The integration of technology will enhance privacy, 
            improve the accuracy of medical examinations, and provide underwriters with instant access to comprehensive medical histories. 
            With a focus on digitization and sustainability, Secure Care continues to lead the way in simplifying insurance processes and delivering a new-age customer experience.
        </p>
      </div>
    </div>
    <?php
        printNews($newsArray);    
    ?>
    <div id="customAlertBox" class="customAlert hidden">
      <div class="customAlertContent">
        <span class="closeButton" onclick="closeCustomAlert()">&times;</span>
        <h3>Enter News Details</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <div>
                <textarea name="news1" id="" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input name="valid_days" type="number" placeholder="Enter valid days" min="1">
            </div>
            <div>
                <input type="file" id="inputFile" name="image">
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
      </div>
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
      var wordCount = 0;
      let para = document.getElementById('p1');
      var texx = para.textContent;
      var words = texx.trim().split(/\s+/);
      wordCount = words.length;
      console.log(wordCount);

      function showCustomAlert() {
        var currentURL = window.location.href;

        // Check if the URL contains the query parameter "access" with a value of 0
        if (currentURL.indexOf('?access=0') !== -1) {
            // Show a regular alert box
            alert('Access denied.');
        } else {
            // Show the custom alert box
            var customAlertBox = document.getElementById('customAlertBox');
            customAlertBox.classList.remove('hidden');
        }
    }


      function closeCustomAlert() {
            var customAlertBox = document.getElementById('customAlertBox');
            customAlertBox.classList.add('hidden');
      }
    </script>
  </body>
</html>