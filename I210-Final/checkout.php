<?php

// including the database and header
include 'includes/database.php';
require_once ('includes/header.php');

// starting the session if it isn't already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// prompting user to log in if they aren't already
if (!isset($_SESSION['login'])) {
    header('Location: loginform.php');
    exit();
} else {
    $login = $_SESSION['login'];
}

// retrieving the order total
if (filter_has_var(INPUT_GET, 'total_price')) {
    $total_price = filter_input(INPUT_GET, 'total_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
} else {
    echo "Error: no order total found.";
    include ('includes/footer.php');
    exit;
}

// retrieving the user's id
$sql1 = "SELECT user_id FROM users WHERE user_name='$login'";
$query1 = $conn->query($sql1);

$user_id = '';
while ($row = $query1->fetch_assoc()) {
    $user_id = $row['user_id'];
}

$query1->close();

// creating an order
$sql2 = "INSERT INTO orders VALUES (NULL, $user_id, $total_price, CURRENT_TIMESTAMP)";
$query2 = $conn->query($sql2);

// Handle selection errors
if (!$query2) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}

// retrieve the order_id (that was auto incremented)
$last_order_id = mysqli_insert_id($conn);
$cart = $_SESSION['cart'];

// inserting a row for each item to be stored in orderDetails
foreach(array_keys($cart) as $item_id) {
    $sql3 = "INSERT INTO orderDetails VALUES (NULL, $last_order_id, $item_id, $cart[$item_id])";
    $query3 = $conn->query($sql3);
}

// empty cart
$_SESSION['cart'] = [];
?>

    <h2>Thank you for shopping with us!</h2>


<?php
include ('includes/footer.php');
$conn->close();
?>