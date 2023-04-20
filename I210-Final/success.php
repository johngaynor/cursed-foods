<?php
//include header
include 'includes/header.php';

//check to see if a success message exists and, if so, setting it to the variable, if not, setting a default message
$message = '';
if (filter_has_var(INPUT_GET, 'm')) {
    $message = trim(filter_input(INPUT_GET, 'm', FILTER_UNSAFE_RAW));
} else {
    $message = "Your action was successful. Feel free to continue using our site!";
}
?>
    <h1 style="color: green"><?= $message ?></h1>
<?php
//include footer
include 'includes/footer.php';
