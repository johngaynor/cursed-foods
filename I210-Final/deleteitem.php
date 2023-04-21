<?php
include 'includes/database.php';

//handling errors for id
if (!filter_has_var(INPUT_GET, 'id')) {
    $error = "We were unable to retrieve an ID to delete the item with.";
    header("Location: error.php?m=$error");
    die();
}

//getting the id variable from the url and sanitizing it
$item_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//defining and executing the query
$sql = "DELETE FROM items WHERE item_id=$item_id";
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
$conn->close();

$success = "Your item has been successfully deleted.";
header("Location: success.php?m=$success");
