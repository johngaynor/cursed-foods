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
$sql = "SELECT * FROM users WHERE user_name=$username";
$query = @$conn->query($sql);


?>

<section class="user-profile">
    <div class="profile-info">
        <div class="profile-icon"><i class="fa-solid fa-user"></i></div>
        <div class="profile-details">
            <i class="fa-solid fa-pen-to-square"></i>
            <h2>John Doe</h2>
            <p class="email">johndoe123@gmail.com</p>
            <p>User ID: 1</p>
        </div>
    </div>
    <div class="rewards">
        <h2>My Cursed Food Rewards</h2>
        <a href="aboutus.php">About cursed food rewards</a>
        <div class="reward-bar-holder">
            <div class="reward-bar"></div>
        </div>
        <h4>You're on your way!</h4>
        <h6>YOU’RE ON YOUR WAY! You have spent $33.00. Spend another $50.00 to claim your reward</h6>
    </div>
</section>
<hr>
<h1 class="history-header">Order History</h1>
<hr>
<section class="history">
    <table class="history">
        <thead>
        <tr>
            <th class="table-header empty"></th>
            <th class="table-header">Item</th>
            <th class="table-header">Category</th>
            <th class="table-header">Quantity</th>
            <th class="table-header">Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><img src="" alt=""></td>
            <td>Anti-Sanwich</td>
            <td>Cursed</td>
            <td>2</td>
            <td><p><span>$</span>22</p></td>
        </tr>
        <tbody>
    </table>
    <hr class="history-divider">
</section>