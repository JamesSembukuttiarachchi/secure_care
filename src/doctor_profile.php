<?php
    session_start();
    $user_id = $_SESSION["user_id"];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];
	$email = $_SESSION["email"];
    $hospital = $_SESSION["hospital"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Profile</title>
    <link rel="stylesheet" type="text/css" href="styles/profile.css">
    <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
    <script>
        function deleteAccount() {
            var result = confirm("Are you sure you want to delete your account?");
            if (result) {
                window.location.href = "delete_account.php";
            }
        }
    </script>
</head>
<body>
    <header>
        <h1 style="color: #fff"><center>Doctor Profile</center></h1>
    </header>
    <main>
        <div class="details-container">
            <img src="images/profile_pic.jpg" id="profile_pic">
            <p><strong>Doctor ID:</strong><?php echo $user_id;?></p>
            <p><strong>First Name:</strong><?php echo $first_name;?></p>
            <p><strong>Last Name:</strong><?php echo $last_name;?></p>
            <p><strong>Email: </strong><?php echo $email;?></p>
            <p><strong>Affilaited Hospital: </strong><?php echo $hospital;?></p>
            <button id="appointments" name="appointments" onclick="appointments()">Appointments</button>
        </div>

        <div class="change-pwd">
            <form action="change_password.php" method="post" onsubmit="return validatePassword()">
                <label for="chng-pwd">New Password: </label>
                <input type="text" id="new-pwd" name="new_password"><br><br>
                <label for="chng-pwd">Confirm New Passwaord: </label>
                <input type="text" id="confirm-pwd" name="confirm_password">
                <button name="submitPass" id="sumbit">Submit</button>
            </form>
        </div>

        <div class="delete">
            <p>Once you delete your account, there's no getting it back.</p>
            <p><center>Make sure you want to do this.</center></p>
            <button onclick="deleteAccount()">Delete</button>
        </div>
    </main>

    <script>
        function validatePassword() {
            var newPassword = document.getElementById('new-pwd').value;
            var confirmNewPassword = document.getElementById('confirm-pwd').value;

            if (newPassword !== confirmNewPassword) {
                alert("New password and confirm new password do not match.");
                document.getElementById('new-pwd').value = "";
                document.getElementById('confirm-pwd').value = "";
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }

        function appointments(){
            window.location.href = "doctorAppointments.php";
        }
    </script>
</body>
</html>