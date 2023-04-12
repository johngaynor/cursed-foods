<?php
// starting the session if it doesn't exist already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// retrieving session cart and storing it, if it doesn't exist creating an empty array
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
}

// if item id cannot be found, terminate script.
if (!filter_has_var(INPUT_GET, 'id')) {
    $error = "Item id not found. Operation cannot proceed.<br><br>";
    header("Location: error.php?m=$error");
    die();
}

// retrieve item id and make sure it is a numeric value.
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!is_numeric($id)) {
    $error = "Invalid item id. Operation cannot proceed.<br><br>";
    header("Location: error.php?m=$error");
    die();
}

// if qty cannot be found, terminate script.
if (!filter_has_var(INPUT_GET, 'qty')) {
    $error = "Quantity not found. Operation cannot proceed.<br><br>";
    header("Location: error.php?m=$error");
    die();
}

// retrieve qty and make sure it is a numeric value.
$qty = filter_input(INPUT_GET, 'qty', FILTER_SANITIZE_NUMBER_INT);
if (!is_numeric($qty)) {
    $error = "Invalid quantity. Operation cannot proceed.<br><br>";
    header("Location: error.php?m=$error");
    die();
}

// checking to see if id already exists in cart--if so, increase by qty, otherwise set it to qty.
if (array_key_exists($id, $cart)) {
    $cart[$id] = $cart[$id] + $qty;
} else {
    $cart[$id] = $qty;
}

// update session variable cart.
$_SESSION['cart'] = $cart;

// redirect to showcart.php page.
header('Location: showcart.php');
?>