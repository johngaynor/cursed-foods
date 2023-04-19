<?php
//start session if it has not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//if someone is not logged in, make sure they can't access logout.php
if (!isset($_SESSION['login'])) {
    $error = "You do not have permission to access this page.";
    header("Location: error.php?m=$error");
    die();
}

//unset all the session variables
$_SESSION = array();

//delete the session cookie
setcookie(session_name(), "", time() - 3600);

//destroy the session
session_destroy();

//include the header
include ('includes/header.php');
?>

    <h2>Logout</h2>
    <p>Thank you for your visit. You are now logged out.</p>

<?php
// include the footer
include ('includes/footer.php');
