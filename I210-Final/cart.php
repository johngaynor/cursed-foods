<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';

//checking to see if cart is empty.
if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    $error = "Your cart is empty. Please add at least one item before attempting to checkout.";
    header("Location: error.php?m=$error");
    die();
}

//proceed since the cart is not empty--store all session data in cart variable
$cart = $_SESSION['cart'];
?>

<h1 class="cartHeader">Cart</h1>
<section class="cart">
    <?php

    // building and executing sql statement to retrieve all cart items
    $sql = "SELECT item_id, item_name, item_price, image FROM items WHERE 0";
    foreach(array_keys($cart) as $id) {
        $sql .= " OR item_id=$id";
    }
    $query = $conn->query($sql);

    //Handle selection errors
    if (!$query) {
        $errno = $conn->errno;
        $errmsg = $conn->error;
        $error = "Selection failed with: ($errno) $errmsg";
        $conn->close();
        header("Location: error.php?m=$error");
        die();
    }

    //initialize total_price variable
    $total_price = 0;

    // loop through all items and display them
    while($row = $query->fetch_assoc()) {
        echo "<div class='cart-item'>";
        echo "<div class='cart-desc'>";
        echo "<img src='", $row['image'], "' alt='' />";
        echo "<div class='cart-item-total'>";
        echo "<h2>", $row['item_name'], "</h2>";
        echo "<h3><span>$</span>", $row['item_price'], "</h3>";
        echo "</div>";
        echo "</div>";
        echo "<div class='amount'>";
        echo "<a class='delete' href='editcart.php?type=decrement&id=", $row['item_id'], "'>-</a>";
        echo "<input class='number' type='number' readonly value='", $cart[$row['item_id']], "' />";
        echo "<a class='add' href='editcart.php?type=increment&id=", $row['item_id'], "'>+</a>";
        echo "<a href='editcart.php?type=delete&id=", $row['item_id'], "'><i class='fa-regular fa-trash-can'></i></a>";
        echo "</div>";
        echo "</div>";

        // calculating item_total and adding it to the variable total_price to access later
        $item_total = $row['item_price'] * $cart[$row['item_id']];
        $total_price = $total_price + $item_total;

        //formatting the total price to show decimal places
        $total_price = number_format($total_price, 2, '.');
    }

    ?>
</section>
<!--this area is for the totals-->
<section class='checkout'>
    <div class='total'>
        <h2>Total:</h2>
        <p>$<?= $total_price ?></p>
    </div>
    <a href='checkout.php?total_price=<?= $total_price ?>' class='checkoutBtn'>Checkout</a>
</section>
<?php
// include the header
include ('includes/footer.php');
