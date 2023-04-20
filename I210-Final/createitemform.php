<?php
// include the header and database
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

//$img_thumb ="";
?>
<script type="text/javascript">
    $img_thumb = "";
    function show_thumb() {
        $img_thumb = document.getElementById('thumb-input').value;
        // alert("this has been clicked: ");
        // alert($img_thumb);
    }
</script>

    <!--this is the form for creating an item. It will submit to createitem.php and pass variables through POST.-->
    <div class="product-form-wrapper">
        <h1>Create Product</h1>
        <form action="createitem.php" method="post" class="add-product">
            <div class="add-holder">
                <i class="fa-solid fa-pen"></i>
                <input type="text" placeholder="Product Name">
            </div>
            <div class="prod-desc">
                <i class="fa-solid fa-scroll"></i>
                <textarea name="" id="" placeholder="Product Description"></textarea>
            </div>
            <div class="add-holder">
                <i class="fa-solid fa-image"></i>
                <input type="text" placeholder="Product Image" id="thumb-input" >
                <button onclick='show_thumb()' type="button">Preview</button>
                <img id="create-thumb" src=$img_thumb width="400px" />
            </div>
            <div class="add-holder">
                <i class="fa-solid fa-tags"></i>
                <input type="text" placeholder="Product Price">
            </div>
            <div class="prod-button-wrapper">
                <button class="item-submit">Submit</button>
                <button class="item-cancel">Cancel</button>
            </div>
        </form>
    </div>
<?php
//include the footer
include 'includes/footer.php';
