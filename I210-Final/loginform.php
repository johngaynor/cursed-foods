<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';

//check the login status
$login_status = '';
if (isset($_SESSION['login_status'])) {
    $login_status = $_SESSION['login_status'];
}

// if successful login
if ($login_status == 1) {
    $username = $_SESSION['login'];
    $success = "You have successfully logged in as $username.";
    header("Location: success.php?m=$success");
    exit();
}

// if new user
if ($login_status == 3) {
    $success = "You have successfully registered your account!";
    header("Location: success.php?m=$success");
    exit();
}

//the user's last login attempt failed
if($login_status == 2) {
    echo "Username or password invalid. Please try again.";
}

?>

<h1 class="loginHeader">Welcome back! Please login to your account.</h1>

<section class="login">
    <form class="login-form" method="post" action="login.php">
        <div class="login-inputs">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Username" name="username" />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-lock"></i>
            <input type="password" placeholder="Password" name="password" />
        </div>
        <div class="login-buttons">
            <button class="loginBtn" type="submit">Login</button>
            <a href="signupform.php" class="signup-link">Sign Up</a>
        </div>
    </form>
    <div class="img-holder"><img src="images/login.png" alt="" /></div>
</section>
