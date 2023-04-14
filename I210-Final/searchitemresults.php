<?php
// include header and database
include 'includes/header.php';
include 'includes/database.php';

// retrieve keywords from GET, if none exist throw an error message
if (filter_has_var(INPUT_GET, "terms")) {
    $user_terms = filter_input(INPUT_GET, 'terms', FILTER_UNSAFE_RAW);
} else {
    echo "Error: no search terms were found.";
    include ('includes/footer.php');
    exit;
}

// $delimiter denotes what to separate a string by, explode returns an array of values separated by the delimiter
$delimiter = ' ';
$terms = explode($delimiter, $user_terms);

// defining the query
$sql = "SELECT * FROM items WHERE item_id>0";
foreach ($terms as $term) {
    $sql .= " AND item_name LIKE '%$term%'";
}

//execute the query
$query = $conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg.";
    $conn->close();
    include ('includes/footer.php');
    exit;
}

//insert a row into the table for each row of data
while (($row = $query->fetch_assoc()) !== NULL) {
    echo "<p>", $row['item_name'], "</p><br>";
}




