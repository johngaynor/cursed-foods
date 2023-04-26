<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';

//start session if one doesn't exist already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//check to see if user has access
if (isset($_SESSION['login'])) {
    $username = $_SESSION['login'];
} else {
    $error = "You do not have permission to access this page.";
    header("Location: error.php?m=$error");
    die();
}

//defining and executing query to retrieve current user information
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

//retrieving all user information
$user_id = $username = $firstname = $lastname = $email = $password = $image = '';
while ($row = $query->fetch_assoc()) {
    $user_id = $row['user_id'];
    $username = $row['user_name'];
    $firstname = $row['first_name'];
    $lastname = $row['last_name'];
    $email = $row['user_email'];
    $password = $row['password'];
    $image = $row['profile_picture'];
}

?>
    <section class="create">
        <h1 class="createHeader">Edit your account information:</h1>
        <form action='edituser.php' method="post">
            <div class="create-form">
                <div class="login-inputs">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Username" name="username" value="<?= $username ?>" required />
                </div>
                <div class="login-inputs">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="First Name" name="fname" value="<?= $firstname ?>" required />
                </div>
                <div class="login-inputs">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Last Name" name="lname" value="<?= $lastname ?>" required />
                </div>
                <div class="login-inputs">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" value="<?= $email ?>" required />
                </div>
                <div class="login-inputs">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" value="<?= $password ?>" required />
                </div>
                <div class="login-inputs">
                    <i class="fa-solid fa-image"></i>
                    <input type="text" placeholder="Profile Picture (url)" name="profile_picture" value="<?= $image ?>" />
                </div>
                <div>
                <button class="signUpBtn" type="submit">Save Changes</button>
                <button class="signUpBtn" type="button" onclick="window.location.href='userprofile.php'">Cancel</button>
                </div>
            </div>
        </form>
    </section>

<?php
include 'includes/footer.php';