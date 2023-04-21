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
            <div class="reward-bar"></div>
        </div>
        <h4>You're on your way!</h4>
        <h6>YOU’RE ON YOUR WAY! You have spent $33.00. Spend another $50.00 to claim your reward</h6>
    </div>
</section>
<h1 class="history-header">Order History</h1>
<section class="history">
    <hr>
    <?php ?>
    <table class="history">
        <thead>
        <tr>
            <th class="table-header" style="text-align: left; padding-left: 50px; font-size: 30px; text-decoration: none">#ORDER NUMBER</th>
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
            <td style="width: 150px">Cursed very very very very </td>
            <td>2</td>
            <td><p><span>$</span>22</p></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" style="font-size: 25px; font-weight: bold; text-align: right; padding-right: 40px" >Total: $12.99</td>
        </tr>
        <tbody>
    </table>
</section>

<?php
include 'includes/footer.php';