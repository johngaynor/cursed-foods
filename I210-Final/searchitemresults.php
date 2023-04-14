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