<?php

//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'category_id') ||
    !filter_has_var(INPUT_POST, 'item_name') ||
    !filter_has_var(INPUT_POST, 'item_price') ||
    !filter_has_var(INPUT_POST, 'description')) {
    $error = "This service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}