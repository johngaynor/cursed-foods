<?php
//include the header and database
include 'includes/header.php';
require_once('includes/database.php');

//start session if it has not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//check to see if the user has permission to access this page
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 2) {
        $error = "You do not have permission to access this page (not admin).";
        header("Location: error.php?m=$error");
        die();
    }
} else {
    $error = "You do not have permission to access this page (not signed in).";
    header("Location: error.php?m=$error");
    die();
}

//checking to see if the required inputs are there and, if not, ending the script
if(!filter_has_var(INPUT_POST, 'category_id') ||
    !filter_has_var(INPUT_POST, 'item_name') ||
    !filter_has_var(INPUT_POST, 'item_price') ||
    !filter_has_var(INPUT_POST, 'description') ||
    !filter_has_var(INPUT_POST, 'image_url')) {
    $error = "We are unable to create your item at this time. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}

//retrieve user inputs from the form
$category_id = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT)));
$item_name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'item_name', FILTER_UNSAFE_RAW)));
$item_price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'item_price', FILTER_SANITIZE_NUMBER_FLOAT)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW)));
$image_url = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'image_url', FILTER_UNSAFE_RAW)));

//setting the other values
$date_added = date('Y-m-d');

//defining the insert query and executing it
$sql = "INSERT INTO items (item_id, category_id, date_added, item_name, item_price, description, image) 
        VALUES (NULL, $category_id, $date_added, $item_name, $item_price, $description, $image_url)";
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

// close query/connection
$query->close();
$conn->close();

// display the content on the page
//echo "Your item has been created. View it in the gallery below:<br>";
//echo "<a href='menu.php'>click here</a>";
//include 'includes/footer.php';

$success = "Your item has been successfully created.";
header("Location: success.php?m=$success");

