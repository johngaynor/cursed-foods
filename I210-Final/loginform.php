<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';

?>

<h1 class="loginHeader">Welcome back! Please login to your account.</h1>

<section class="login">
    <form class="login-form" method="post" action="loginform.php">
        <div class="login-inputs">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Username or Email" />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-lock"></i>
            <input type="password" placeholder="Password" />
        </div>
        <div class="login-buttons">
            <button class="loginBtn" type="submit">Login</button>
            <a href="create.html" class="signup-link">Sign Up</a>
        </div>
    </form>
    <div class="img-holder"><img src="images/login.png" alt="" /></div>
</section>
