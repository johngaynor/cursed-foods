<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';
?>

<section class="create">
    <h1 class="createHeader">Create your account ;)</h1>
    <h2>Create your account to order food.</h2>
    <form action="signup.php" method="post">
    <div class="create-form">
        <div class="login-inputs">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Username" name="username" required />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="First Name" name="fname" required />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Last Name" name="lname" required />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" placeholder="Email" name="email" required />
        </div>
        <div class="login-inputs">
            <i class="fa-solid fa-lock"></i>
            <input type="password" placeholder="Password" name="password" required />
        </div>
<!--        <div class="login-inputs">-->
<!--            <i class="fa-solid fa-calendar-days"></i>-->
<!--            <input type="text" placeholder="Birthday" />-->
<!--        </div>-->
        <div class="login-inputs">
            <i class="fa-solid fa-image"></i>
            <input type="text" placeholder="Profile Picture (url)" name="profile_picture" />
        </div>
        <button class="signUpBtn" type="submit">Sign Up</button>
    </div>
    </form>
</section>

<?php
include 'includes/footer.php';