<?php

// include the header and database
include 'includes/header.php';
include 'includes/database.php';

// define & execute the query
$sql = "
SELECT i.item_id, i.item_name, i.item_price, i.image, i.description, c.category_name 
FROM items as i
INNER JOIN categories as c
ON i.category_id = c.category_id
";
$query = $conn->query($sql);

// Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}

?>
    <h1 id="menuHeader">Take a look at our most cursed menu items!</h1>
    <section class="menu-display">
        <div class="food-wrapper">
            <?php
            // while loop to show all items
            while (($row = $query->fetch_assoc()) !== null) {
                echo "<div class='food'>";
                echo "<img src='images/", $row['image'], "' alt='' />";
                echo "<div class='food-text'>";
                echo "<h2>", $row['item_name'], "</h2>";
                echo "<p>", $row['description'], "</p>";
                echo "</div>";
                echo "<a href='menu-details.php?id=", $row['item_id'], "'>View Details</a>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

<?php

// close the query and connection
$query->close();
$conn->close();

// include the footer
include 'includes/footer.php'

?>
