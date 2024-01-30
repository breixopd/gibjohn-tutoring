<?php

// Start session to be able to pull data from other scripts and tabs
session_start();

// Start an error array to keep track of errors happening while script runs, this array is then used by errors.php to display the errors to the user
$errors = array(); 

// Connect to mysql database
$db = mysqli_connect("hostname","username","password","table");
if (!$db) {
    echo "MySQL Error: " . mysqli_connect_error();
}

// If user registering
if (isset($_POST['reg_user'])) {

    // Valid codes for user
    $codes = array("AABBCC1", "AABBCC2", "AABBCC3");

    // Get variables from POST request sent by form, mysqli_real_escape_string sanitises values for use with a database
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);
    $pass2 = mysqli_real_escape_string($db, $_POST['password_repeat']);
    $code = mysqli_real_escape_string($db, $_POST['code']);

    // If passwords don't match tell user and add to error list
    if ($pass != $pass2) {

        // Send error to array to be displayed later
        array_push($errors, "The 2 passwords must match!");
    }

    // If code is not empty run code below
    if ($code != "") {

        // If the code is not in the codes array, tell the user the code is invalid
        if (!in_array($code, $codes)) {
            array_push($errors, "Teacher code not valid!");
        } else {

            // If code is valid set it as a session variable and as a normal PHP variable to be inserted into database
            $checked_code = $code;
            $_SESSION['code'] = $checked_code;
        }
    }

    // Check if user already exists in database, if they exist send message to user and add to errors array
    $user_check_query = "SELECT * FROM users WHERE useremail='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        array_push($errors, "User already in system!");
    }

    // If there are no errors in array finish registration
    if (count($errors) == 0) {

        // Hash password with default PHP encryption
        $userpass = password_hash($pass, PASSWORD_DEFAULT);

        // Insert details into database
        $sql = "INSERT INTO users (username, useremail, userpass, teachcode)
        VALUES ('$name','$email','$userpass','$checked_code')";
        mysqli_query($db, $sql);

        // Check if there is a name associated with account, if not, set it to their email
        if ($name == "") {
            $name = $email;
        }
        
        // Make a session with unique values so user can log into their own area
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now logged in";

        // Send user a welcome email (not working as SMTP server not configured)
        mail($email, "Welcome to GibJohn Tutuoring!", "Your account has been registered successfully! Feel free to look around!");

        // Redirect user to dashboard
        header('location: dashboard.php');
    }
}

// If user logging in
if (isset($_POST['log_user'])) {

    // Get variables from POST request sent by form, mysqli_real_escape_string sanitises values for use with a database
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);

    // Query to select user with email written in login 
    $sql = "SELECT * FROM users WHERE useremail='$email'";
    $row = mysqli_fetch_assoc(mysqli_query($db, $sql));

    // If there is a row meaning user exists, carry on
    if ($row) {

        // Check that password hashes match meaning that they are the same pasword
        if (password_verify($pass, $row['userpass'])) {
            
            // If there are no errors in array finish login
            if (count($errors) == 0) {

                // Check if there is a name associated with account, if not, set it to their email
                if (is_null($row['username'])) {
                    $name = $email;
                } else {
                    $name = $row['username'];
                }

                // Make a session with unique values so user can log into their own area
                // and so data can be used later
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;

                $teachcode = $row["teachcode"];
                $_SESSION['code'] = $teachcode;
                //$_SESSION['activities']  = $row['act_done'];


                $_SESSION['success'] = "You are now logged in";
                
                // Redirect user to dashboard
                header('location: dashboard.php');
            }
        } else{

            // If the details are wrong send error to user, errors are kept generic to keep malicious parties from guessing details and doing other social enginnering attacks
            array_push($errors, "Incorrect email/password combination!");
        }

    } else {

        // If the user doesnt exist send error to user
        array_push($errors, "Email does not match our records");
    }
}

// If user clicked "Forgot password" button
if (isset($_POST['forg_pass'])) {

    // Get email from POST request sent by form, mysqli_real_escape_string sanitises values for use with a database
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Query to select user with email written in login 
    $sql = "SELECT * FROM users WHERE useremail='$email'";
    $row = mysqli_fetch_assoc(mysqli_query($db, $sql));

    // If there is a row meaning user exists, carry on
    if ($row) {

        // Send email with instructions to reset password (not working as SMTP server not configured)
        mail($email, "Password reset", "To change password please contact support");
    } else {

        // If the user doesnt exist send error to user
        array_push($errors, "Email does not match our records");
    }
}
?>