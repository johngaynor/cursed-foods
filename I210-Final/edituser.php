<?php

//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'username') ||
    !filter_has_var(INPUT_POST, 'fname') ||
    !filter_has_var(INPUT_POST, 'lname') ||
    !filter_has_var(INPUT_POST, 'email') ||
    !filter_has_var(INPUT_POST, 'password') ||
    !filter_has_var(INPUT_POST, 'profile_picture') ||
    !filter_has_var(INPUT_GET, 'id') ||
    !filter_has_var(INPUT_GET, 'role')) {
    $error = "We are unable to edit your account at this time. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}

//include code from header.php and database.php
require_once('includes/database.php');

//retrieving all post variables
$user_id = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
$role = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'role', FILTER_SANITIZE_NUMBER_INT)));
$firstname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'fname', FILTER_UNSAFE_RAW)));
$lastname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'lname', FILTER_UNSAFE_RAW)));
$username = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW)));
$email = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW)));
$profile_picture = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'profile_picture', FILTER_UNSAFE_RAW)));

//insert statement
$sql = "UPDATE users SET user_name='$username', first_name='$firstname', last_name='$lastname', password='$password', user_email='$email', profile_picture='$profile_picture' WHERE user_id=$user_id";

//execute the insert query
$query = @$conn->query($sql);

//Handle insert errors
if (!$query) {
    $errno = $conn->errno;
    $error = $conn->error;
    $error = "Insertion failed with: ($errno) $error.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$conn->close();

// start session if it isn't already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// define session variables
$_SESSION['login'] = $username;
$_SESSION['name'] = "$firstname $lastname";
$_SESSION['role'] = $role;
$_SESSION['profile_picture'] = $profile_picture;

//send to success page
$success = "Your account has been successfully edited.";
header("Location: success.php?m=$success");