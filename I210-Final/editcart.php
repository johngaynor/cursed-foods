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

// if edit action cannot be found, terminate script.
if (!filter_has_var(INPUT_GET, 'type')) {
    $error = "Edit action not found. Operation cannot proceed.<br><br>";
    header("Location: error.php?m=$error");
    die();
}

// setting action variable to determine what action needs to be taken.
$action = filter_input(INPUT_GET, 'type', FILTER_UNSAFE_RAW);

// first checking to see if the item exists, then running code based on the action.
if (array_key_exists($id, $cart)) {
    if ($action == 'increment') {
        $cart[$id] = $cart[$id] + 1;
    } else if ($action == 'decrement') {
        $cart[$id] = $cart[$id] - 1;

        if ($cart[$id] == 0) {
            unset($cart[$id]);
        }
    } else if ($action == 'delete') {
        unset($cart[$id]);
    }
}

// update session variable cart.
$_SESSION['cart'] = $cart;

// redirect to showcart.php page.
header('Location: showcart.php');
