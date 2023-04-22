<?php
//include the header and database
include 'includes/header.php';
include 'includes/database.php';

//start session if one doesn't exist already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//retrieve username from session, if it's not set send to error page
if (isset($_SESSION['login'])) {
    $username = $_SESSION['login'];
} else {
    $error = "You are not logged into an account. Please login before attempting to access your profile.";
    header("Location: error.php?m=$error");
    die();
}

//define and execute sql data to retrieve user information
$sql = "SELECT * FROM users WHERE user_name='$username'";
$query = @$conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    $error = "Selection failed with: ($errno) $errmsg";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

// retrieving all user info
$user_id = $username = $fname = $lname = $email = $profile_image = '';
while ($row = $query->fetch_assoc()) {
    $user_id = $row['user_id'];
    $username = $row['user_name'];
    $fname = ucfirst($row['first_name']);
    $lname = ucfirst($row['last_name']);
    $email = $row['user_email'];
    $profile_image = $row['profile_picture'];
}

// retrieving all user orders
$sql2 = "SELECT * FROM orders WHERE user_id=$user_id";
$query2 = @$conn->query($sql2);

$total_spent = 0;
while ($row = $query2->fetch_assoc()) {
    $total_spent += $row['total_price'];
}


$total_remaining = ($total_spent - 50);
while ($total_remaining > 50) {
    $total_remaining -= 50;
}
?>

<section class="user-profile">
    <div class="profile-info">
        <div class="profile-icon"><img src="<?= $profile_image ?>" /></div>
        <div class="profile-details">
            <i class="fa-solid fa-pen-to-square"></i>
            <h2><?= $fname ?> <?= $lname ?></h2>
            <p><?= $username ?></p>
            <p class="email"><?= $email ?></p>
        </div>
    </div>
    <div class="rewards">
        <h2>My Cursed Food Rewards</h2>
        <a href="aboutus.php">About cursed food rewards</a>
        <div class="reward-bar-holder">
            <div style="background-color: #7371FC; width: <?= $total_remaining / 50 * 500 ?>px; height: 100%"></div>
        </div>
        <h4>You're on your way!</h4>
        <h6>YOU’RE ON YOUR WAY! You have spent $<?= $total_spent ?>. Spend another $<?= 50 - $total_remaining ?> to claim your reward</h6>
    </div>
</section>
<h1 class="history-header">Order History</h1>
<section class="history">
    <?php
    // retrieving all user orders
    $sql2 = "SELECT * FROM orders WHERE user_id=$user_id";
    $query2 = @$conn->query($sql2);

  // looping through all orders
    while ($row = $query2->fetch_assoc()) {
        $order_id = $row['order_id'];
        echo "<hr>";
        echo "<table class='history'><thead><tr>";
        echo "<th class='table-header' style='text-align: left; padding-left: 50px; font-size: 30px; text-decoration: none'>#", $row['order_id'], "</th>";
        echo "<th class='table-header'>Item</th><th class='table-header'>Category</th><th class='table-header'>Quantity</th><th class='table-header'>Price</th></tr></thead><tbody>";

        // insert code for individual rows
        $sql3 = "SELECT item_id, item_qty FROM orderDetails WHERE order_id=$order_id";
        $query3 = @$conn->query($sql3);

        while ($row2 = $query3->fetch_assoc()) {
            $item_id = $row2['item_id'];
            $sql4 = "SELECT item_name, item_price, image, category_id FROM items WHERE item_id=$item_id";
            $query4 = @$conn->query($sql4);

            echo "<tr>";
            $item_price = 0;
            while ($row3 = $query4->fetch_assoc()) {
                $item_price = $row3['item_price'];
                echo "<td><img src='", $row3['image'],  "' style='margin: 30px 0 30px 50px' /></td>";
                echo "<td>", $row3['item_name'], "</td>";
                echo "<td>", $row3['category_id'], "</td>";
            }
            echo "<td>", $row2['item_qty'], "</td>";
            $item_total = ($item_price * $row2['item_qty']);
            echo "<td>$", $item_total, "</td>";
            echo "</tr>";
        }

        echo "<tr><td></td><td></td><td></td>";
        echo "<td colspan='2' style='font-size: 25px; font-weight: bold; text-align: right; padding-right: 40px' >Total: $", $row['total_price'], "</td>";
        echo " </tr></tbody></table>";
    }
    ?>
<!--    <table class='history'>-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th class="table-header" style="text-align: left; padding-left: 50px; font-size: 30px; text-decoration: none">#ORDER NUMBER</th>-->
<!--            <th class='table-header'>Item</th>-->
<!--            <th class='table-header'>Category</th>-->
<!--            <th class='table-header'>Quantity</th>-->
<!--            <th class='table-header'>Price</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        <tr>-->
<!--            <td><img src="" alt=""></td>-->
<!--            <td>Anti-Sanwich</td>-->
<!--            <td style="width: 150px">Cursed very very very very </td>-->
<!--            <td>2</td>-->
<!--            <td>$22</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td colspan='2' style='font-size: 25px; font-weight: bold; text-align: right; padding-right: 40px' >Total: $12.99</td>-->
<!--        </tr>-->
<!--        <tbody>-->
<!--    </table>-->
</section>

<?php
include 'includes/footer.php';