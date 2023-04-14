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
$sql = "
SELECT i.item_id, i.item_name, i.item_price, i.image, i.description, c.category_name 
FROM items as i
INNER JOIN categories as c
ON i.category_id = c.category_id
WHERE i.item_id>0
";
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

    //display results in a table
    if ($query->num_rows == 0)
    echo "<p style='font-size:30px; padding:50px'>Your search <strong>'$user_terms'</strong> did not match any items in our inventory.</p><br>";

    else {
    ?>
        <section class="menu-display">
            <div class="food-wrapper">
        <?php
        //insert a food item for each row in the query
            while (($row = $query->fetch_assoc()) !== null) {
                echo "<div class='food'>";
                echo "<img src='images/", $row['image'], "' alt='' />";
                echo "<div class='food-text'>";
                echo "<h2>", $row['item_name'], "</h2>";
                echo "<h4>", $row['category_name'], "</h4>";
                echo "<p>", $row['description'], "</p>";
                echo "</div>";
                echo "<a href='menu-details.php?id=", $row['item_id'], "'>View Details</a>";
                echo "</div>";
            }
        ?>
            </div>
        </section>
<?php
}

// clean up results and close the connection
$query->close();
$conn->close();
include 'includes/footer.php';
