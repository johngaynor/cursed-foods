<?php

// include the header and database
include 'includes/header.php';
include 'includes/database.php';

// handling errors for id
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: item id was not found.";
    require_once ('includes/footer.php');
    exit();
}

// getting the id variable from the url and sanitizing it
$item_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// define & execute the query
$sql = "
SELECT i.item_id, i.item_name, i.item_price, i.description, i.image, c.category_name, c.category_id
FROM items as i
INNER JOIN categories as c
ON i.category_id = c.category_id
WHERE i.item_id = $item_id
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

<section class="details">
        <?php
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

            echo "<div class='item-desc'>";
            echo "<h1 id='detailHeader'>", $row['item_name'];
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 2) {
                    echo "<a href='edititemform.php?id=", $row['item_id'], "' style='color: #7371FC; margin-left: 10px'><i class='fa-solid fa-pen-to-square'></i></a>";
                }
            }
             echo "</h1>";
            echo "<p class='category' style='color: $category_color'><span style='color: black'>Category: </span>", $row['category_name'], "</p>";
            echo "<p class='price'><span>Price: </span>$", $row['item_price'], "</p>";
            echo "<p class='desc'>";
            echo "<span>Description: </span>", $row['description'], "</p>";
            echo "<div class='item-quantity'>";
            echo "<form action='addtocart.php?id=5' method='get'>";
            echo "<input type='hidden' name='id' value='", $row['item_id'], "' />";
            echo "<button class='addBtn' type='submit'>+ Add to Cart</button>";
            echo "<input class='item-number' name='qty' type='number' value='1' />";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "<img src='", $row['image'], "' alt='' />";
          }

        ?>
</section>

<?php

// close the query and connection
$query->close();
$conn->close();

// include the footer
include 'includes/footer.php'

?>


