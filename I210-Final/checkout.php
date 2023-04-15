<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// prompting user to log in if they aren't already
if (!isset($_SESSION['login'])) {
    header('Location: loginform.php');
    exit();
}


// empty the shopping cart
$_SESSION['cart'] = [];

// display the header
require_once ('includes/header.php');
?>

    <h2>Thank you for shopping with us!</h2>


<?php
include ('includes/footer.php');
?>