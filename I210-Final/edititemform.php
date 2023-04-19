<?php
//include the header and database
include 'includes/header.php';
include 'includes/database.php';

//check to see if the user has permission to access this page
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 2) {
        $error = "You do not have permission to access this page (not admin).";
        header("Location: error.php?m=$error");
        die();
    }
} else {
    $error = "You do not have permission to access this page (not signed in).";
    header("Location: error.php?m=$error");
    die();
}

//if id cannot be found, terminate script.
if (!filter_has_var(INPUT_GET, 'id')) {
    $error = "ID not found. Operation cannot proceed.";
    header("Location: error.php?m=$error");
    die();
}

//retrieve id and make sure it is a numeric, positive value.
$item_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!is_numeric($item_id) || $item_id < 0) {
    $error = "Invalid ID. Operation cannot proceed.";
    header("Location: error.php?m=$error");
    die();
}

//define & execute the query
$sql1 = "
SELECT i.item_id, i.item_name, i.item_price, i.description, i.image, c.category_name, c.category_id
FROM items as i
INNER JOIN categories as c
ON i.category_id = c.category_id
WHERE i.item_id = $item_id
";
$query1 = $conn->query($sql1);

//Handle selection errors
if (!$query1) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    $error = "Selection failed with: ($errno) $errmsg";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

//initializing and setting variables for all item information
$item_id = $name = $category_name = $category_id = $price = $description = $image = '';
while ($row = $query1->fetch_assoc()) {
    $item_id = $row['item_id'];
    $name = $row['item_name'];
    $category_id = $row['category_id'];
    $category_name = $row['category_name'];
    $price = $row['item_price'];
    $description = $row['description'];
    $image = $row['image'];
}

//getting the categories to display in the select element
$sql2 = "SELECT * FROM categories";
$query2 = @$conn->query($sql2);

//Handle selection errors
if (!$query2) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    $error = "Selection failed with: ($errno) $errmsg";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}
?>
    <form action="edititem.php" method="post">
        <input hidden="hidden" name="item_id" value="<?= $item_id ?>" />
<section class="details">
    <div class='item-desc'>
        <input class="edit-name" id="detailHeader" type="text" name="name" value="<?= $name ?>" style="min-width: 500px" />
        <p class='price'><span>Item ID: </span><input type="number" name="price" style="color: grey; width: 60px" readonly value="<?= $item_id ?>" /></p>
        <p class='category' style='color: red'>
            <span style='color: black'>Category: </span>
            <select class='edit-select' name='category'>
            <?php
            // looping through and displaying categories
            while ($row = $query2->fetch_assoc()) {
                if ($row['category_id'] == $category_id) {
                    echo "<option style='color: red' value='", $row['category_id'], "' selected='selected'>", $row['category_name'], "</option>";
                } else {
                    echo "<option value='", $row['category_id'], "'>", $row['category_name'], "</option>";
                }
            }
            ?>
            </select>
        </p>
        <p class='price'><span>Price: </span><input type="number" step=.01 min=0 name="price" value="<?= $price ?>" /></p>
        <p class="desc"><span>Description: </span></p>
        <textarea name="description" rows="6" cols="70" style="margin-bottom: 60px"><?= $description ?></textarea>
        <div class="item-quantity">
                <button class='addBtn' type='submit' style="margin-right: 10px">+ Save</button>
                <button class="addBtn" type="button" onclick='window.location.href="menu-details.php?id=<?=$item_id?>"'>Cancel</button>
        </div>
    </div>
    <img src="<?= $image ?>" />
</section>
    </form>
<?php
//include the footer and close queries/connections
include 'includes/footer.php';
$query1->close();
$query2->close();
$conn->close();

// finished except working on the images
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////