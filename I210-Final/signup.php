<?php

//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'firstname') ||
    !filter_has_var(INPUT_POST, 'lastname') ||
    !filter_has_var(INPUT_POST, 'username') ||
    !filter_has_var(INPUT_POST, 'password')) {
    $error = "The service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}


//include code from header.php and database.php
require_once('includes/database.php');

$firstname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'firstname', FILTER_UNSAFE_RAW)));
$lastname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'lastname', FILTER_UNSAFE_RAW)));
$username = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW)));

$role = 1;  //regular user

//insert statement. The id field is an auto field.
$sql = "INSERT INTO users VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '$role')";

//execut the insert query
$query = @$conn->query($sql);

//Handle selection errors
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

//set login status to 3 since this is a new user.
$_SESSION['login_status'] = 3;

//redirect the user to the loginform.php page
header('Location: loginform.php');