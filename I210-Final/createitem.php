<?php

//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'category_id') ||
    !filter_has_var(INPUT_POST, 'item_name') ||
    !filter_has_var(INPUT_POST, 'item_price') ||
    !filter_has_var(INPUT_POST, 'description')) {
    $error = "This service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}

//include code from header.php and database.php
require_once('includes/database.php');

//set all item details
$firstname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT)));
$lastname = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'item_name', FILTER_UNSAFE_RAW)));
$username = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'item_price', FILTER_SANITIZE_NUMBER_FLOAT)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW)));
