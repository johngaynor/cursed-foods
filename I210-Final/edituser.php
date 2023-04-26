<?php

//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'username') ||
    !filter_has_var(INPUT_POST, 'fname') ||
    !filter_has_var(INPUT_POST, 'lname') ||
    !filter_has_var(INPUT_POST, 'email') ||
    !filter_has_var(INPUT_POST, 'password') ||
    !filter_has_var(INPUT_POST, 'profile_picture')) {
    $error = "We are unable to edit your account at this time. Please try again later.";
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

