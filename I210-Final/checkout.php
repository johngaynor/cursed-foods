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
    $total_price = filter_input(INPUT_GET, 'total_price', FILTER_SANITIZE_NUMBER_FLOAT);
} else {
    echo "Error: no order total found.";
    include ('includes/footer.php');
    exit;
}

$sql1 = "SELECT user_id FROM users WHERE user_name='$login'";
$query1 = $conn->query($sql1);

$user_id = '';
while ($row = $query1->fetch_assoc()) {
    $user_id = $row['user_id'];
}

//echo $user_id;
$query1->close();

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

$last_order_id = mysqli_insert_id($conn);
echo $last_order_id;

//$sql3 = "SELECT LAST_INSERT_ID()";
//$query3 = $conn->query($sql3);
//echo $query3;

// orderDetails stores the orderID(foreign), item_id(foreign), and qty

// empty the shopping cart
$_SESSION['cart'] = [];
?>

    <h2>Thank you for shopping with us!</h2>


<?php
include ('includes/footer.php');
//$query2->close();
$conn->close();
?>