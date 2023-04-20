<?php

//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'username') ||
    !filter_has_var(INPUT_POST, 'fname') ||
    !filter_has_var(INPUT_POST, 'lname') ||
    !filter_has_var(INPUT_POST, 'email') ||
    !filter_has_var(INPUT_POST, 'password') ||
    !filter_has_var(INPUT_POST, 'profile_picture')) {
    $error = "We are unable to create your account at this time. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}


//include code from header.php and database.php
require_once('includes/database.php');

$firstname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'fname', FILTER_UNSAFE_RAW)));
$lastname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'lname', FILTER_UNSAFE_RAW)));
$username = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW)));
$email = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW)));
$profile_picture = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'profile_picture', FILTER_UNSAFE_RAW)));

$role = 1;  //regular user

//insert statement. The id field is an auto field.
$sql = "INSERT INTO users VALUES (NULL, '$username', '$firstname', '$lastname', NULL, '$email', '$password', '$role', '$profile_picture')";

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
$_SESSION['role'] = 2;
$_SESSION['profile_picture'] = $profile_picture;

//set login status to 1 since a user is now logged in
$_SESSION['login_status'] = 1;

//send to success page
$success = "Your account has been successfully created.";
header("Location: success.php?m=$success");