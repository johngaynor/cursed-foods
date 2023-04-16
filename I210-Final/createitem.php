<?php

//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'firstname') ||
    !filter_has_var(INPUT_POST, 'lastname') ||
    !filter_has_var(INPUT_POST, 'username') ||
    !filter_has_var(INPUT_POST, 'password')) {
    $error = "The service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}