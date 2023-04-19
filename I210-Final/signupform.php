<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';
?>

<section class="create">
    <h1 class="createHeader">Create your account ;)</h1>
    <h2>Create your account to order food.</h2>
    <div class="create-form">
        <div class="login-inputs">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Username or Email" />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" placeholder="Email" />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-lock"></i>
            <input type="password" placeholder="Password" />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-calendar-days"></i>
            <input type="text" placeholder="Birthday" />
        </div>
        <button class="signUpBtn">Sign Up</button>
    </div>
</section>

<?php
include 'includes/footer.php';