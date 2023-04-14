<?php
// starting the session if it doesn't exist already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// retrieving session sort_by and storing it, if it doesn't exist creating an empty array
if (isset($_SESSION['sort_by'])) {
    $sort_by = $_SESSION['sort_by'];
} else {
    $sort_by = "";
}

// setting $sort_by. if sort_by cannot be found, terminate script.
if(isset($_POST["sort_by"])){
    $sort_method = $_POST["sort_by"];
} else {
    $error = "Filter not found. Operation cannot proceed.<br><br>";
    header("Location: error.php?m=$error");
    die();
}

// updating the session variable
$_SESSION['sort_by'] = $sort_method;

header('Location: menu.php');
?>

