<?php 

// Start session to be able to pull data from other scripts and tabs
session_start();

// Connect to mysql database
$db = mysqli_connect("localhost","root","","gibjohn");
if (!$db) {
    echo "MySQL Error: " . mysqli_connect_error();
}

// Get individual activities done
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE useremail='$email'";
$row = mysqli_fetch_assoc(mysqli_query($db, $sql));

// Set result as session variable to be displayed at user dashboard
$_SESSION['activities']  = $row['act_done'];

// Sum all activities done for overall activities done
$sql2 = "SELECT SUM(act_done) AS total FROM users";
$row2 = mysqli_fetch_assoc(mysqli_query($db, $sql2));

// Set result as a session varibale to be displayed in teacher stats
$_SESSION['totalactivities']  = $row2['total'];

// If question is submitted (this is only made to process 1 question for prototyping reasons)
if (isset($_POST['submit_q'])) {

    // Get answer from POST request sent by form, mysqli_real_escape_string sanitises values for use with a database
    $result = $_POST['answer'];

    // If the name of the radio clicked is "incorrect" set score to 0
    if ($result == "incorrect") {
        $_SESSION['score'] = "0%";
    } 

    // If the name of the radio is "correct" set score to 100
    if ($result == "correct") {
        $_SESSION['score'] = "100%";
    }

    // Get user ID by email
    // Get email from POST request sent by form, mysqli_real_escape_string sanitises values for use with a database
    $email = $_SESSION['email'];

    // Get user ID from email
    $sql = "SELECT idusers FROM users WHERE useremail='$email'";
    $row = mysqli_fetch_assoc(mysqli_query($db, $sql));
    $userid = $row['idusers'];

    // Increase activities done by 1 by updating the field
    $sql = "UPDATE users 
    SET act_done = act_done + 1
    WHERE idusers ='$userid'";
    mysqli_query($db, $sql);
}

?>