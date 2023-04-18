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

$name = $category_name = $category_id = $price = $description = $image = '';
while ($row = $query->fetch_assoc()) {
    $name = $row['item_name'];
    $category_id = $row['category_id'];
    $category_name = $row['category_name'];
    $price = $row['item_price'];
    $description = $row['description'];
    $image = $row['image'];

//    echo $description;
}

?>

<section class="details">
    <div class='item-desc'>
        <input class="edit-name" id="detailHeader" type="text" name="name" value="<?= $name ?>" />
        <p class='category' style='color: red'><span style='color: black'>Category: </span></p>
        <p class='price'><span>Price: </span><input type="number" name="price" value="<?= $price ?>" /></p>
        <p class="desc"><span>Description: </span></p>
        <textarea name="description" rows="7" cols="70"><?= $description ?></textarea>
        <div class="item-quantity">
            <form action='addtocart.php?id=5' method='get'>
                <button class='addBtn' type='submit'>+ Save</button>
                <button class="addBtn" type="button" onclick='window.location.href="menu-details.php?id=<?=$item_id?>"'>Cancel</button>
            </form>
        </div>
    </div>
    <img src='images/snickles.jpeg' />
</section>

<?php
include 'includes/footer.php';