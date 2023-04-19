<?php
// include the header and database
include 'includes/header.php';
include 'includes/database.php';

// check to see if the user has permission to access this page
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] !== 2) {
        include 'includes/permissionerror.php';
        include 'includes/footer.php';
        exit();
    }
} else {
    include 'includes/permissionerror.php';
    include 'includes/footer.php';
    exit();
}

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

$item_id = $name = $category_name = $category_id = $price = $description = $image = '';
while ($row = $query->fetch_assoc()) {
    $item_id = $row['item_id'];
    $name = $row['item_name'];
    $category_id = $row['category_id'];
    $category_name = $row['category_name'];
    $price = $row['item_price'];
    $description = $row['description'];
    $image = $row['image'];

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
            // getting the categories to display in the select element
            $sql2 = "SELECT * FROM categories";
            $query2 = @$conn->query($sql2);

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
include 'includes/footer.php';