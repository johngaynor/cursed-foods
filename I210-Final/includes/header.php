<?php

// start session if one doesn't exist already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// retrieve cart content
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,600;0,700;1,300&display=swap"
            rel="stylesheet"
    />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Cursed Foods</title>
</head>
<body>
<div class="site-wrapper">
    <header>
        <nav>
            <a id="menu" href="menu.php">Menu</a>
            <a id="logo" href="index.php">cursed<span>foods</span></a>
            <a href="">About Us</a>
            <a href="">Contact Us</a>
            <form action="searchitemresults.php" method="get">
                <input type="text" name="terms" size="40" required />&nbsp;&nbsp;
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <?php
            if (isset($_SESSION['login_status'])) {
                if ($_SESSION['login_status'] == 1) {
                    echo "<div class='profile-container'>";
                    echo "<a href='loginform.php'><img src='images/account-placeholder.png'' alt=''/></a>";
                    echo "<div class='profile-dropdown'>";
                    echo "<a href='userprofile.php'>Profile Settings</a>";
                    echo "<a href='logout.php'>Logout</a>";

                    $username = $_SESSION['login'];
                    $sql = "SELECT role FROM users WHERE user_name='$username'";
                    $query = @$conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                        $role = $row['role'];

                        if ($role == 2) {
                            echo "<a href='createitem.php'>Add an Item</a>";
                        }
                    }
                    echo "</div></div>";
                } else {
                    echo "<a href='loginform.php'>Login</a>";
                }
            } else {
                echo "<a href='loginform.php'>Login</a>";
            }
            ?>
<!--            <div class="profile-container">-->
<!--                <a href='loginform.php'><img src='images/account-placeholder.png'' alt=''/></a>-->
<!--                <div class='profile-dropdown'>-->
<!--                    <a href='userprofile.php'>Profile Settings</a>-->
<!--                    <a href='logout.php'>Logout</a>-->
<!--                    <a href='additem.php'>Add an Item</a>-->
<!--                </div>-->
<!--            </div>-->
        </nav>
    </header>

