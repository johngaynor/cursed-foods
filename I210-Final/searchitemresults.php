<?php

// this is the file for searching items and returning results

// include header and database
include 'includes/header.php';
include 'includes/database.php';

// checking to see if any keywords exist in GET and handling errors accordingly
if (!filter_has_var(INPUT_GET, 'terms')) {
    echo "Error: no search terms were found.";
    require_once ('includes/footer.php');
    exit();
}

// retrieve search keywords from GET and sanitizing it
$user_terms = filter_input(INPUT_GET, 'terms', FILTER_UNSAFE_RAW);

// $delimiter denotes what to separate a string by, explode returns an array of values separated by the delimiter
$delimiter = ' ';
$terms = explode($delimiter, $user_terms);