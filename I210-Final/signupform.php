<?php


?>

<h1 class="loginHeader">Please create your account below!</h1>

<section class="login">
    <form class="login-form" method="post" action="signup.php">
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
            <a href="create.html" class="signup-link">Sign Up</a>
        </div>
    </form>
    <div class="img-holder"><img src="images/login.png" alt="" /></div>
</section>

