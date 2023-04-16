<?php

// checking to see if the required inputs are there and, if not, ending the script
if(!filter_has_var(INPUT_POST, 'category_id') ||
    !filter_has_var(INPUT_POST, 'item_name') ||
    !filter_has_var(INPUT_POST, 'item_price') ||
    !filter_has_var(INPUT_POST, 'description') ||
    !filter_has_var(INPUT_POST, 'image_url')) {
    $error = "This service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}

//include code from header.php and database.php
require_once('includes/database.php');

//retrieve user inputs from the form
$category_id = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT)));
$item_name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'item_name', FILTER_UNSAFE_RAW)));
$item_price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'item_price', FILTER_SANITIZE_NUMBER_FLOAT)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW)));

// setting the other values
$date_added = date('Y-m-d');



