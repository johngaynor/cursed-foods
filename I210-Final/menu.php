<?php

// include the header and database
include 'includes/header.php';
include 'includes/database.php';

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

// define the basic query
$sql = "
SELECT i.item_id, i.item_name, i.item_price, i.image, i.description, c.category_name, c.category_id 
FROM items as i
INNER JOIN categories as c
ON i.category_id = c.category_id
";

if ($sort_by == "cursed_asc") {
    $sql .= "ORDER BY c.category_id ASC";
    $select_filler = "Least to Most Cursed";
} else if ($sort_by == "cursed_desc") {
    $sql .= "ORDER BY c.category_id DESC";
    $select_filler = "Most to Least Cursed";
} else if ($sort_by == "price_asc") {
    $sql .= "ORDER BY i.item_price ASC";
    $select_filler = "Price Low to High";
} else if ($sort_by == "price_desc") {
    $sql .= "ORDER BY i.item_price DESC";
    $select_filler = "Price High to Low";
} else {
    $select_filler = "--select filter--";
}


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
    <form method="POST" action="sortmenu.php" style="padding-top: 20px">
        Sort by:
        <select name="sort_by" onchange="this.form.submit()">
            <option value="" disabled selected><?= $select_filler ?></option>
            <option value="cursed_asc">Least to Most Cursed</option>
            <option value="cursed_desc">Most to Least Cursed</option>
            <option value="price_asc">Price Low to High</option>
            <option value="price_desc">Price High to Low</option>
        </select>
    </form>
    <section class="menu-display">
        <div class="food-wrapper">
            <?php
            // while loop to show all items
            while (($row = $query->fetch_assoc()) !== null) {
                // setting category color
                $category = $row['category_id'];
                if ($category == 1) {
                    $category_color = "#69B34C";
                } else if ($category == 2) {
                    $category_color = "#FAB733";
                } else if ($category == 3) {
                    $category_color = "#FF8E15";
                } else if ($category == 4) {
                    $category_color = "#FF4E11";
                } else if ($category == 5) {
                    $category_color = "#FF0D0D";
                }

                echo "<div class='food'>";
                echo "<img src='images/", $row['image'], "' alt='' />";
                echo "<div class='food-text'>";
                echo "<h2>", $row['item_name'], "</h2>";
                echo "<h3 style='color: $category_color'>", $row['category_name'], "</h3>";
                echo "<h4>$", $row['item_price'], "</h4>";
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
