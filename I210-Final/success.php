<?php
//include header
include 'includes/header.php';

//check to see if a success message exists and, if so, setting it to the variable, if not, setting a default message
$message = '';
if (filter_has_var(INPUT_GET, 'm')) {
    $message = trim(filter_input(INPUT_GET, 'm', FILTER_UNSAFE_RAW));
} else {
    $error = "You are not logged into an account. Please login before attempting to access your profile.";
    header("Location: error.php?m=$error");
    die();
}
?>
    <div class="site-wrapper">
        <div class="success-wrapper">
            <p>cursed<span>foods</span></p>
            <i class="fa-regular fa-circle-check"></i>
            <h1><?= $message ?></h1>
            <h2>Success!</h2>
            <a href="index.php">Return Home</a>
        </div>

    </div>
<?php
//include footer
include 'includes/footer.php';
