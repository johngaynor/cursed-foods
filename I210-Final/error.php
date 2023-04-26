<?php
//include header
include 'includes/header.php';

//check to see if an error message exists and, if so, setting it to the variable, if not, setting a default message
$message = '';
if (filter_has_var(INPUT_GET, 'm')) {
    $message = trim(filter_input(INPUT_GET, 'm', FILTER_UNSAFE_RAW));
} else {
    $message = "Sorry, we're not quite sure what happened. Try again at a later time.";
}
?>

    <div class="site-wrapper">
        <div class="error">
            <h1><?= $message ?></h1>
            <h2>Error Code Here</h2>
            <div class="error-images">
                <img class="rick" src="images/rick.png" alt="">
                <img class="qr" src="images/qr.png" alt="">
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
