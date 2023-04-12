<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';

// checking to see if cart is empty.
if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    echo "Your shopping cart is empty.<br><br>";
    include ('includes/footer.php');
    exit();
}

//proceed since the cart is not empty--store all session data in cart variable
$cart = $_SESSION['cart'];
?>

<h1 class="cartHeader">Cart</h1>
<section class="cart">
    <?php

    // building and executing sql statement
    $sql = "SELECT item_id, item_name, item_price, image FROM items WHERE 0";
    foreach(array_keys($cart) as $id) {
        $sql .= " OR item_id=$id";
    }
    $query = $conn->query($sql);

    foreach(array_keys($cart) as $id) {
        $sql .= " OR item_id=$id";
    }

    $total_price = 0;

    while($row = $query->fetch_assoc()) {
        echo "<div class='cart-item'>";
        echo "<div class='cart-desc'>";
        echo "<img src='images/", $row['image'], "' alt='' />";
        echo "<div class='cart-item-total'>";
        echo "<h2>", $row['item_name'], "</h2>";
        echo "<h3><span>$</span>", $row['item_price'], "</h3>";
        echo "</div>";
        echo "</div>";
        echo "<div class='amount'>";
        echo "<a class='delete' href='editcart.php?type=decrement&id=", $row['item_id'], "'>-</a>";
        echo "<input class='number' type='number' readonly value='", $cart[$row['item_id']], "' />";
        echo "<a class='add' href='editcart.php?type=increment&id=", $row['item_id'], "'>+</a>";
        echo "</div>";
        echo "<a href='editcart.php?type=delete&id=", $row['item_id'], "'><i class='fa-regular fa-trash-can'></i></a>";
        echo "</div>";

        $item_total = $row['item_price'] * $cart[$row['item_id']];
        $total_price = $total_price + $item_total;
    }
    ?>
</section>

<!--this area is for the totals-->
<section class='checkout'>
    <div class='total'>
        <h2>Total:</h2>
        <p>$<?= $total_price ?></p>
    </div>
    <a href='checkout.php' class='checkoutBtn'>Checkout</a>
</section>
