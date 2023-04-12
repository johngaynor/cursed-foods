<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
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