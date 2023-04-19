<?php
//including header and database
include 'includes/header.php';
include 'includes/database.php';

//check to see if the user has permission to access this page
if (isset($_SESSION['role'])) {
    if (!$_SESSION['role'] == 2) {
        $error = "You do not have permission to access this page (not admin).";
        header("Location: error.php?m=$error");
        die();
    }
} else {
    $error = "You do not have permission to access this page (not signed in).";
    header("Location: error.php?m=$error");
    die();
}

//retrieving and setting variables for each thing
$item_id = $name = $price = $category_id = $description = '';
if (filter_has_var(INPUT_POST, 'item_id') && filter_has_var(INPUT_POST, 'name') &&
    filter_has_var(INPUT_POST, 'price') && filter_has_var(INPUT_POST, 'category') &&
    filter_has_var(INPUT_POST, 'description')) {
    $item_id = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT)));
    $name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW)));
    $price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));
    $category_id = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT)));
    $description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW)));
} else {
    $error = "We are unable to edit your item at this time. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}

//defining statement to update the item and executing it
$sql = "UPDATE items SET
        item_name='$name',
        category_id=$category_id,
        item_price=$price,
        description='$description'
        WHERE item_id=$item_id";
$query = @$conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}

$success = "Your item has been successfully edited.";
header("Location: success.php?m=$success");

//add functionality to add a link to view the new item?
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

