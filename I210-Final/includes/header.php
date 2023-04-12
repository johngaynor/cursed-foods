<?php

// start session if one doesn't exist already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// retrieve cart content
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
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
            <a href="showcart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="login.php"
            ><img src="images/account-placeholder.png" alt=""
                /></a>
        </nav>
    </header>
